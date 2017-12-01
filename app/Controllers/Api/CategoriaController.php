<?php
namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Categoria;

/**
 * @todo Document class CategoriaController.
 *
 * @author Thiago Hofmeister <thiago.souza@moovin.com.br>
 */
class CategoriaController extends Controller
{
    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        return response()->json(Categoria::all());
    }
}