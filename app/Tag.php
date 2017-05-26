<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = [
        'nome',
        'slug'
    ];
    public $timestamps = false;

}
