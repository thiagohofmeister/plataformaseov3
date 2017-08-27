<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoConteudo extends Model {

    protected $fillable = [
        'descricao',
        'slug'
    ];
    public $timestamps = false;

    public function getContentsType()
    {
        $types = $this->get();
        
        return $types;
    }
}
