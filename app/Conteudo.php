<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model {

    protected $fillable = [
        'imagem',
        'titulo',
        'slug',
        'conteudo',
        'link',
        'id_tipo_conteudo'
    ];
    public $timestamps = false;

    public function getContentsType($slug, $limit = null) {
        $content = $this->join('tipo_conteudos', 'conteudos.id_tipo_conteudo', '=', 'tipo_conteudos.id')
                ->where('tipo_conteudos.slug', $slug)
                ->orderBy('conteudos.titulo', 'asc');

        $content = $content->limit($limit)->get();

        return $content;
    }
    
    public function getContents()
    {
        $content = $this->select('conteudos.*', 'tc.descricao as area')
                ->join('tipo_conteudos as tc', 'conteudos.id_tipo_conteudo', '=', 'tc.id')
                ->orderBy('conteudos.titulo', 'asc')->get();
        
        $this->fixLinkContents($content);
        
        return $content;
    }
    
    private function fixLinkContents(&$contents)
    {
        foreach ($contents as $content) {
            if (!empty($content->link)) {
                $content->link_url = url($content->link);
            }
        }
    }

}
