<?php

namespace App\Models;

use App\Enum\Comentario\Status;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model {

    protected $fillable = [
        'nome_autor',
        'email',
        'comentario_texto',
        'status',
        'data_comentario',
        'id_comentario_parent',
        'id_post'
    ];
    public $timestamps = false;

    public function getComments() {
        return $this->select(
                'comentarios.*',
                'posts.titulo as post_titulo',
                'posts.slug as post_slug',
                'categorias.slug as categoria_slug'
            )
            ->join('posts', 'posts.id', 'comentarios.id_post')
            ->join('categorias', 'posts.id_categoria', 'categorias.id')
            ->orderBy('data_comentario', 'desc')
            ->get();
    }

    public function getCommentsSite($post_id) {
        return $this->select('comentarios.*')
            ->where('comentarios.id_post', $post_id)
            ->where('comentarios.status', Status::APROVADO)
            ->leftJoin('comentarios as parent', 'parent.id', '=', 'comentarios.id_comentario_parent')
            ->orderBy('id_comentario_parent', 'asc')
            ->orderBy('data_comentario', 'desc')
            ->get();
    }

    public function getTotal($post_id = null) {
        if ($post_id != null) {
            $total = $this->where('status', '<>', Status::NOVO)->where('id_post', $post_id)->count();
        } else {
            $total = $this->where('status', '<>', Status::NOVO)->count();
        }
        
        return $total;
    }

    public function deleteRelation($post_id) {
        $parents = $this->select('id')
            ->where('id_post', $post_id)
            ->where('id_comentario_parent', null)
            ->get();

        $children = $this->select('id')
            ->where('id_post', $post_id)
            ->whereIn('id_comentario_parent', $parents)
            ->get();

        $grandsons = $this->select('id')
            ->where('id_post', $post_id)
            ->whereIn('id_comentario_parent', $children)
            ->get();

        // Delete Grandsons
        $this->select('id')
            ->whereIn('id', $grandsons)
            ->delete();

        // Delete Children
        $this->select('id')
            ->whereIn('id', $children)
            ->delete();

        // Delete Parents
        $this->select('id')
            ->whereIn('id', $parents)
            ->delete();

        return true;
    }

}
