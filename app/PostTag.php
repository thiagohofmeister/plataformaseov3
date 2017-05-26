<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model {

    protected $fillable = [
        'id_post',
        'id_tag'
    ];
    public $timestamps = false;

    public function deleteRelation($post_id) {
    	$delete = $this->where('id_post', $post_id)->delete();

    	return $delete;
    }

}
