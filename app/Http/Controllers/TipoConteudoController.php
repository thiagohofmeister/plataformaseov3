<?php

namespace App\Http\Controllers;

use App\TipoConteudo;

class TipoConteudoController extends Controller
{
    private $TipoConteudo;
    
    public function __construct(TipoConteudo $tc) {
        $this->TipoConteudo = $tc;
    }
    
    public function index()
    {
        $TipoConteudos = $this->TipoConteudo->getContentsType();
        return view(TM . 'admin/tipoconteudos/index', compact('TipoConteudos'));
    }
}
