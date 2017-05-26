<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conteudo;

class ConteudoController extends Controller
{
    private $Conteudo;
    
    public function __construct(Conteudo $cont) {
        $this->Conteudo = $cont;
    }
    
    public function index() {
        $Conteudos = $this->Conteudo->getContents();
        return view(TM . 'admin/conteudos/index', compact('Conteudos'));
    }
}
