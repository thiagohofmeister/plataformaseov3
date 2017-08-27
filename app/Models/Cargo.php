<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model {

    protected $fillable = [
        'descricao',
        'nivel'
    ];
    public $timestamps = false;

}
