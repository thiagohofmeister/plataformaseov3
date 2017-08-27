<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\TagSeo;
use App\Models\Conteudo;
use Illuminate\View\View;

class Site extends Controller {
    /**
     * Retorna a view inicial do site.
     *
     * @return View
     */
    public function index() {
        $Conteudo = new Conteudo;

        $Cases = $Conteudo->getContentsType('cases', 2);
        $CaseUm = !empty($Cases[0]) ? $Cases[0] : [];
        $CaseDois = !empty($Cases[1]) ? $Cases[1] : [];

        $Servicos = $Conteudo->getContentsType('servicos');

        $Posts = (new Post)->getPosts(5);
        $Seo = (new TagSeo)->getSeo();

        return view(TM . 'index', compact('Posts', 'Seo', 'CaseUm', 'CaseDois', 'Servicos'));
    }


}
