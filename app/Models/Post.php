<?php

namespace App\Models;

use App\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model {

    protected $fillable = [
        'titulo',
        'imagem',
        'slug',
        'migalha',
        'conteudo',
        'data_postagem',
        'seo_title',
        'seo_description',
        'seo_spam_text',
        'seo_open_graph',
        'possui_seo',
        'status',
        'id_usuario',
        'id_categoria'
    ];
    public $timestamps = false;
    public $fields_validator = [
        'titulo' => 'required|min:5',
        'conteudo' => 'required|min:10',
        'slug' => 'unique:posts',
        'imagem' => 'file',
        'seo_title' => 'max:65',
        'seo_description' => 'max:150',
        'seo_spam_text' => 'max:180',
        'seo_open_graph' => 'file',
        'id_categoria' => 'required|not_in:-1'
    ];
    public $msgs_validator = [
        'titulo.required' => 'O campo título é obrigatório.',
        'conteudo.required' => 'O campo descrição é obrigatório.',
        'slug.unique' => 'Este artigo já existe.',
        'id_categoria.not_in' => 'A categoria selecionada é inválida.'
    ];

    public function getPost($slug) {
        return $this->select([
            'posts.*',
            'categorias.nome as categoria',
            'categorias.slug as categoria_slug',
            'usuarios.imagem as autor_imagem',
            'usuarios.nome as autor_nome',
            'usuarios.email as autor_email',
            'usuarios.genero as autor_genero',
            'usuarios.facebook as autor_facebook',
            'usuarios.googleplus as autor_googleplus',
            'usuarios.twitter as autor_twitter'
        ])
        ->join('categorias', 'posts.id_categoria', '=', 'categorias.id')
        ->join('usuarios', 'posts.id_usuario', '=', 'usuarios.id')
        ->where('posts.slug', $slug)
        ->where('posts.status', Enum\Post\Status::PUBLISHED)
        ->first();
    }

    public function getPosts($limit = null, $related = false, $valid_category = false) {
        $subSelect = "select count(*) from comentarios where id_post = posts.id and status = '" .
            Enum\Comentario\Status::APROVADO . "'";

        $Posts = $this->select(
            'posts.id',
            'posts.titulo',
            'posts.slug',
            'posts.imagem',
            'posts.conteudo',
            'posts.seo_open_graph',
            'posts.data_postagem',
            'posts.possui_seo',
            'categorias.nome as categoria',
            'categorias.slug as categoria_slug'
        )
            ->join('categorias', 'categorias.id', '=', 'posts.id_categoria')
            ->leftJoin('comentarios', ["comentarios.id_post" => 'posts.id'])
            ->selectSub($subSelect, 'comentarios')
            ->orderBy('data_postagem', 'desc')
            ->where('posts.status', Enum\Post\Status::PUBLISHED)
            ->groupBy(
                'comentarios.id_post',
                'posts.id',
                'posts.titulo',
                'posts.slug',
                'posts.imagem',
                'posts.conteudo',
                'posts.seo_open_graph',
                'posts.data_postagem',
                'posts.possui_seo',
                'categorias.nome',
                'categorias.slug'
            )
            ->limit($limit)
            ->get();

        if ($related) {
            $this->getRelatedPosts($Posts, $valid_category);
        }

        return $Posts;
    }

    public function getPostsDrafts($limit = null, $related = false, $valid_category = false) {
        $Posts = $this->select('posts.*', 'categorias.nome as categoria', 'categorias.slug as categoria_slug')
                ->join('categorias', 'categorias.id', '=', 'posts.id_categoria')
                ->orderBy('data_postagem', 'desc')
                ->where('posts.status', Enum\Post\Status::DRAFT)
                ->limit($limit)
                ->get();

        if ($related) {
            $this->getRelatedPosts($Posts, $valid_category);
        }

        return $Posts;
    }

    public function getPostsCategory($cat_id, $related = false) {
        $Posts = $this->select('posts.*', 'categorias.slug as categoria_slug')
            ->join('categorias', 'posts.id_categoria', '=', 'categorias.id')
            ->where('posts.id_categoria', $cat_id)->where('posts.status', Enum\Post\Status::PUBLISHED)->get();

        if ($related) {
            $this->getRelatedPosts($Posts, true);
        }

        return $Posts;
    }

    public function conteudo_resumido($words) {
        return limitWords($this->conteudo, $words);
    }

    private function getRelatedPosts(&$Posts, $valid_category) {
        foreach ($Posts as $key => $Post) {
            $Tags = $Post->select('tags.id')
                    ->join('post_tags', 'posts.id', '=', 'post_tags.id_post')
                    ->join('tags', 'post_tags.id_tag', '=', 'tags.id')
                    ->where('posts.id', '=', $Post->id)
                    ->inRandomOrder()
                    ->limit(10)
                    ->groupBy('tags.id')
                    ->get();

            $tagsIds = [];
            foreach ($Tags as $Tag) {
                $tagsIds[] = $Tag->id;
            }

            $Related = new Post;
            $Related = $Related->select(['posts.*', 'categorias.slug as categoria_slug'])
                    ->join('post_tags', 'posts.id', '=', 'post_tags.id_post')
                    ->join('tags', 'post_tags.id_tag', '=', 'tags.id')
                    ->join('categorias', 'posts.id_categoria', '=', 'categorias.id')
                    ->whereIn('tags.id', $tagsIds)
                    ->where('posts.id', '<>', $Post->id)
                    ->inRandomOrder()
                    ->distinct()
                    ->limit(2);

            if ($valid_category) {
                $Related->where('posts.id_categoria', $Post->id_categoria);
            }

            $Posts[$key]->posts_relacionados = $Related->get();
        }
    }

    /**
     * Retorna o total de posts por status.
     *
     * @param Enum\Post\Status $status
     *
     * @return int
     */
    public function getTotalPosts(Enum\Post\Status $status)
    {
        return $this->where('status', $status->value())->count();
    }
}
