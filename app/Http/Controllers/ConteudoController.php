<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;

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
