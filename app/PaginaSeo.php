<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaginaSeo extends Model {

    protected $fillable = [
        'url',
        'seo_title',
        'seo_description',
        'seo_spam_text',
        'seo_open_graph'
    ];
    public $timestamps = false;

    public function getPages()
    {
    	$result = $this->get();

    	return $result;
    }
}
