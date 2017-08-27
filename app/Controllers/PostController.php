<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\Post;
use App\Models\TagSeo;
use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\PostTag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller {
    /** @var Post */
    private $Post;

    public function __construct(Post $post = null) {
        parent::__construct();

        $this->Post = $post;
    }

    /**
     * Detalhe do Post
     *
     * @param string $categoria - slug da categoria
     * @param string $post - slug do post
     *
     * @return Response|View
     */
    public function single($categoria, $post) {
        // Post
        $Seo = new TagSeo;

        if (TM == 'default.') {
            return view(TM . 'index');
        }
        
        // Remover par�metros
        $post = str_replace('&', '', urldecode($post));
        if (strpos($post, '?') !== false) {
	        $post = substr($post, 0, strpos($post, '?'));
        }

        $this->Post = $this->Post->getPost($post);

        if (!empty($this->Post->titulo)) {
            $Seo = $Seo->getSeo($this->Post);
            $Comentario = new Comentario;
            $Comentarios = $Comentario->getCommentsSite($this->Post->id);
            $Post = $this->Post;
            $Post->comentarios = $Comentario->getTotal($this->Post->id);
            return view(TM . 'post', compact('Post', 'Seo', 'Comentarios'));
        }

        return response()->view(TM . '404', [], 404);
    }

    public function add() {
        $Categorias = new Categoria;
        $Categorias = $Categorias->getCats();
        return view(TM . 'admin/posts/add', compact('Categorias'));
    }

    public function postAdd(Request $request) {
        $req = $request->except('_token');

        if (!empty($req['titulo'])) {
            // Criar slug
            $req['slug'] = $this->makeSlug($req['titulo']);
        }

        $validator = validator($req, $this->Post->fields_validator, $this->Post->msgs_validator);
        if ($validator->fails()) {
            return redirect('admin/posts/add')->withErrors($validator)->withInput();
        }

        // Imagem Principal
        $file = $request->file('imagem');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['titulo']);
            $file_path = 'uploads/post/';
            
            $req['imagem'] = $this->upload($file, $file_path, $file_name);
        }

        // Open Graph
        $file = $request->file('seo_open_graph');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['titulo']);
            $file_path = 'uploads/seo/';

            $req['seo_open_graph'] = $this->upload($file, $file_path, $file_name);
        }

        // Autor
        if (!empty(auth('usuario')->user())) {
            $req['id_usuario'] = auth('usuario')->user()->id;
        } else {
            $req['id_usuario'] = 1;
        }

        // Validar SEO
        if (
            !empty($req['seo_title']) &&
            !empty($req['seo_description']) &&
            !empty($req['seo_spam_text']) &&
            !empty($req['seo_open_graph'])
        ) {
            $req['possui_seo'] = 1;
        } else {
            $req['possui_seo'] = 0;
        }

        $save = $this->Post->create($req);

        if ($save) {
            return redirect('admin/posts/add')->with('msg', 'Artigo cadastrado com sucesso!');
        } else {
            return redirect('admin/posts/add')->withErrors('Erro ao cadastrar o artigo')->withInput();
        }
    }

    public function edit($id) {
        $Post = $this->Post->find($id);
        $Autores = new Usuario;
        $Autores = $Autores->whereNotNull('imagem')->get();
        $Categorias = new Categoria;
        $Categorias = $Categorias->where('status', 1)->orWhere('id', $Post->id_categoria)->get();
        $CategoriaInativa = null;
        
        foreach ($Categorias as $Categoria) {
            if ($Categoria->id == $Post->id_categoria && $Categoria->status == 0) {
                $CategoriaInativa = $Categoria->nome;
                break;
            }
        }

        return view(TM . 'admin/posts/edit', compact('Post', 'Autores', 'Categorias', 'CategoriaInativa'));
    }

    public function postEdit($id, Request $request) {
        $req = $request->except('_token', 'url');

        if (!empty($req['titulo'])) {
            // Criar slug
            $req['slug'] = $this->makeSlug($req['titulo']);
        }

        $this->Post->fields_validator['slug'] = 'unique:posts,slug,' . $id;

        $validator = validator($req, $this->Post->fields_validator, $this->Post->msgs_validator);
        if ($validator->fails()) {
            return redirect('admin/posts/add')->withErrors($validator)->withInput();
        }

        // Imagem Principal
        $file = $request->file('imagem');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['titulo']);
            $file_path = 'uploads/post/';

            $req['imagem'] = $this->upload($file, $file_path, $file_name);
        }

        // Open Graph
        $file = $request->file('seo_open_graph');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['titulo']);
            $file_path = 'uploads/seo/';

            $req['seo_open_graph'] = $this->upload($file, $file_path, $file_name);
        }

        // Autor
        if (!empty(auth('usuario')->user())) {
            $req['id_usuario'] = auth('usuario')->user()->id;
        } else {
            $req['id_usuario'] = 1;
        }

        unset($req['Tags']);

        // Validar SEO
        if (
            !empty($req['seo_title']) &&
            !empty($req['seo_description']) &&
            !empty($req['seo_spam_text']) &&
            !empty($req['seo_open_graph'])
        ) {
            $req['possui_seo'] = 1;
        } else {
            $req['possui_seo'] = 0;
        }

        $upload = $this->Post->where('id', $id)->update($req);
        
        if ($upload) {
            return redirect('admin/posts/edit/' . $id)->with('msg', 'Artigo atualizado com sucesso!');
        } else {
            return redirect('admin/posts/edit/' . $id)->withErrors('Erro ao atualizar o artigo')->withInput();
        }
    }

    /**
     * [PAGE-ADMIN]
     * Lista de postagens
     *
     * @return view com um objeto de posts
     */
    public function index() {
        $Posts = $this->Post->getPosts();
        return view(TM . 'admin/posts/index', compact('Posts'));
    }

    /**
     * [PAGE-ADMIN]
     * Lista de postagens rascunhos
     *
     * @return view com um objeto de posts
     */
    public function drafts() {
        $Posts = $this->Post->getPostsDrafts();
        return view(TM . 'admin/posts/index', compact('Posts'));
    }

    public function delete($id, Request $req) {
        $Post = $this->Post->find($id);
        $redirect = $req->headers->get('referer');

        if (empty($Post)) {
            return redirect($redirect)->withErrors('Erro ao excluir a postagem')->withInput();
        }

        if ($Post->status) {
            $update = $this->Post->find($id)->update(['status' => 0]);
            if ($update) {
                return redirect($redirect)->with('msg', 'Postagem despublicada com sucesso!');
            } else {
                return redirect($redirect)->withErrors('Erro ao excluir a postagem')->withInput();
            }
        }

        // Apagar Coment�rios
        $ComentariosVinculados = new Comentario;
        $ComentariosVinculados->deleteRelation($id);

        // Apagar Tags
        $TagsVinculadas = new PostTag;
        $TagsVinculadas->deleteRelation($id);

        $delete = $this->Post->find($id)->delete();
        
        if ($delete) {
            return redirect($redirect)->with('msg', 'Postagem exclu�da com sucesso!');
        } else {
            return redirect($redirect)->withErrors('Erro ao excluir a postagem')->withInput();
        }
    }

    public function uploadImage(Request $request) {
        $req = $request->except('_token');
        $file = $request->file('imagem_upload');

        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['titulo']);
            $file_path = 'uploads/post/';

            $path = $this->upload($file, $file_path, $file_name);
            $imagem = url($path);

            return "<img src='{$imagem}' alt='{$req['titulo']}' title='{$req['titulo']}'>";
        }
    }

}
