<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaginaSeo;
use Illuminate\Support\Facades\DB;

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
