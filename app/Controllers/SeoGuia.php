<?php

namespace App\Controllers;

use App\Models\Seo;

class SeoGuia extends Controller {
    private $SeoGuia;

    public function __construct(Seo $seo = null) {
    	$this->SeoGuia = $seo;
    }

    public function index() {
    	return view(TM . 'admin/seo/index');
    }
}
