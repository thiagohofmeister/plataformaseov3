<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'seo_title',
        'seo_description',
        'seo_spam_text',
        'seo_open_graph',
        'status'
    ];
    public $timestamps = false;
    public $fields_validator = [
        'nome' => 'required|min:5',
        'descricao' => 'required|min:10',
        'slug' => 'unique:categorias',
        'seo_title' => 'max:65',
        'seo_description' => 'max:150',
        'seo_spam_text' => 'max:180'
    ];
    public $msgs_validator = [
        'descricao.required' => 'O campo descrição é obrigatório.',
        'slug.unique' => 'Esta categoria já foi cadastrada.'
    ];

    public function getCats() {
        return $this->orderBy('nome', 'asc')->orderBy('status', 'asc')->get();
    }

}
