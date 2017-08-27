<?php

namespace App\Controllers;

use App\Models\PaginaSeo;

class PaginaSeoController extends Controller {
    /** @var PaginaSeo */
    private $PaginaSeo;

    public function __construct(PaginaSeo $ps = null) {
        parent::__construct();

    	$this->PaginaSeo = $ps;
    }

    public function index() {
    	$PaginasSeo = $this->PaginaSeo->getPages();

    	return view(TM . 'admin/paginaseo/index', compact('PaginasSeo'));
    }
}
