<?php

namespace App\Http\Controllers;

use App\PaginaSeo;

class PaginaSeoController extends Controller
{
    private $PaginaSeo;

    public function __construct(PaginaSeo $ps = null) {
    	$this->PaginaSeo = $ps;
    }

    public function index() {
    	$PaginasSeo = $this->PaginaSeo->getPages();

    	return view(TM . 'admin/paginaseo/index', compact('PaginasSeo'));
    }
}
