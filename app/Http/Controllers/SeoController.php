<?php

namespace App\Http\Controllers;

use App\Seo;

class SeoController extends Controller
{
    private $SeoGuia;

    public function __construct(Seo $seo = null) {
    	$this->SeoGuia = $seo;
    }

    public function index() {
    	return view(TM . 'admin/seo/index');
    }
}
