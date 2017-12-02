<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Post as Model;

/**
 * @todo Document class PostController.
 *
 * @author Thiago Hofmeister <thiago.souza@moovin.com.br>
 */
class PostController extends Controller
{
    /** @var Model */
    private $Post;

    public function __construct(Model $post = null) {
        parent::__construct();

        $this->Post = $post;
    }

    public function getPosts()
    {
        return response()->json($this->Post->getPosts());
    }
}