<?php

namespace App\Controllers;

use App\Models\PaginaSeo as Model;

class PaginaSeo extends Controller {
    /** @var Model */
    private $PaginaSeo;

    public function __construct(Model $ps = null) {
    	$this->PaginaSeo = $ps;
    }

    public function index() {
    	$PaginasSeo = $this->PaginaSeo->getPages();

    	return view(TM . 'admin/paginaseo/index', compact('PaginasSeo'));
    }
}
