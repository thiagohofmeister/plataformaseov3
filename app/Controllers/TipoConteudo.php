<?php

namespace App\Controllers;

use App\Models\TipoConteudo as Model;

class TipoConteudo extends Controller {
    /** @var Model */
    private $TipoConteudo;
    
    public function __construct(Model $tc) {
        $this->TipoConteudo = $tc;
    }
    
    public function index()
    {
        $TipoConteudos = $this->TipoConteudo->getContentsType();
        return view(TM . 'admin/tipoconteudos/index', compact('TipoConteudos'));
    }
}
