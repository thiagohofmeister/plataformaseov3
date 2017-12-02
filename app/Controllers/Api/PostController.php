<?php

namespace App\Controllers\Api;

/**
 * @todo Document class PostController.
 *
 * @author Thiago Hofmeister <thiago.souza@moovin.com.br>
 */
class PostController
{
    public function getPosts()
    {
        return response()->json($this->Post->getPosts());
    }
}