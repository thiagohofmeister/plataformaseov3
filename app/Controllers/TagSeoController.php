<?php

namespace App\Controllers;

use App\Models\TagSeo;
use App\Models\Tag;
use App\Models\Categoria;
use App\Models\Post;
use App\Models\PaginaSeo;
use App\Models\Conteudo;

class TagSeoController extends Controller {
    private $TagSeo;

    public function __construct(TagSeo $tagseo) {
        $this->TagSeo = $tagseo;
    }
    
    public function index() {
        $Seo = $this->TagSeo->getTagSeos();
        $Themes = getThemes();

        return view(TM . 'admin/tagseos/index', compact('Seo', 'Themes'));
    }
}
