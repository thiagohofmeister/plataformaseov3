<?php

namespace App\Controllers;

use App\Models\Conteudo;

class ConteudoController extends Controller {
    /** @var Conteudo */
    private $Conteudo;
    
    public function __construct(Conteudo $cont) {
        parent::__construct();

        $this->Conteudo = $cont;
    }
    
    public function index() {
        $Conteudos = $this->Conteudo->getContents();
        return view(TM . 'admin/conteudos/index', compact('Conteudos'));
    }
}
