<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Categoria;

/**
 * Controlador responsável por operações de categorias na API.
 *
 * @author Thiago Hofmeister <thiago.souza@moovin.com.br>
 */
class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all());
    }
}
