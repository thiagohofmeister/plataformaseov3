<?php

namespace App\Controllers;

use App\Models\TagSeo as Model;

class TagSeo extends Controller {
    /** @var Model */
    private $TagSeo;

    public function __construct(Model $tagseo) {
        $this->TagSeo = $tagseo;
    }
    
    public function index() {
        $Seo = $this->TagSeo->getTagSeos();
        $Themes = getThemes();

        return view(TM . 'admin/tagseos/index', compact('Seo', 'Themes'));
    }
}
