<?php

namespace App\Controllers;

use App\Models\Conteudo as Model;

class Conteudo extends Controller {
    /** @var Model */
    private $Conteudo;
    
    public function __construct(Model $cont) {
        $this->Conteudo = $cont;
    }
    
    public function index() {
        $Conteudos = $this->Conteudo->getContents();
        return view(TM . 'admin/conteudos/index', compact('Conteudos'));
    }
}
