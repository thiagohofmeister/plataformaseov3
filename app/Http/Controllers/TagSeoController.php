<?php

namespace App\Http\Controllers;

use App\TagSeo;
use App\Tag;
use App\Categoria;
use App\Post;
use App\PaginaSeo;
use App\Conteudo;

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

    public function router($url) {
        // Remover parâmetros
        $url = str_replace('&', '', urldecode($url));
        if (strpos($url, '?') !== false) {
	        $url = substr($url, 0, strpos($url, '?'));
        }
        
        /**
         * Categoria
         */
        $Categoria = new Categoria;
        $Categoria = $Categoria->where('slug', $url)->where('status', 1)->first();

        if (!empty($Categoria->nome)) {
            $Posts = new Post;
            $Posts = $Posts->getPostsCategory($Categoria->id, true);
            $Seo = $this->TagSeo->getSeo($Categoria);
            return view(TM . 'categoria', compact('Categoria', 'Posts', 'Seo'));
        }
        
        /**
         * Tags
         */
        $Tag = new Tag;
        $Tag = $Tag->where('slug', $url)->first();

        if (!empty($Tag->nome)) {
            $Seo = $this->TagSeo->getSeo($Tag);
            return view(TM . 'tag', compact('Tag', 'Seo'));
        }

        /**
         * P�ginas Normais
         */
        $Pagina = new PaginaSeo;
        $Pagina = $Pagina->where('url', $url)->first();

        if (!empty($Pagina->url)) {
            return $this->getDatas($Pagina);
        }

        /**
         * Conte�dos
         */
        $Conteudo = new Conteudo;
        $Conteudo = $Conteudo->where('slug', $url)->first();

        if (!empty($Conteudo->slug)) {
            $Seo = $this->TagSeo->getSeo($Conteudo);
            return view(TM . 'conteudo', compact('Conteudo', 'Seo'));
        }

        return response()->view(TM . '404', [], 404);
    }

    public function getDatas($Pagina) {
        $Seo = $this->TagSeo->getSeo($Pagina);
        switch ($Pagina->url) {
            case 'servicos':
                $Servicos = new Conteudo;
                $Servicos = $Servicos->getContentsType('servicos');

                return view(TM . 'servicos', compact('Servicos', 'Seo'));
                break;

            case 'blog':
                $Posts = new Post;
                $Posts = $Posts->getPosts(null, true);

                return view(TM . 'blog', compact('Posts', 'Seo'));
                break;

            default:
                if (findPage($Pagina->url)) {
                    return view(TM . $Pagina->url, compact('Seo'));
                } else {
                    return view(TM . 'pagina', compact('Pagina', 'Seo'));
                }
                break;
        }
    }

}
