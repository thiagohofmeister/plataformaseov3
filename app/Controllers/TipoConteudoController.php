<?php

namespace App\Controllers;

use App\Models\TipoConteudo;

class TipoConteudoController extends Controller {
    private $TipoConteudo;
    
    public function __construct(TipoConteudo $tc) {
        parent::__construct();

        $this->TipoConteudo = $tc;
    }
    
    public function index()
    {
        $TipoConteudos = $this->TipoConteudo->getContentsType();
        return view(TM . 'admin/tipoconteudos/index', compact('TipoConteudos'));
    }
}
