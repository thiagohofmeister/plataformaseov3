<?php
namespace App\Controllers\Action;

use App\Enum\Status;
use App\Models\Categoria;
use App\Models\Conteudo;
use App\Models\PaginaSeo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagSeo;

/**
 * @todo Document class Config.
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Config
{
    /** @var TagSeo */
    private $TagSeo;

    public function __construct(TagSeo $tagseo) {
        $this->TagSeo = $tagseo;
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
        $Categoria = new Categoria();
        $Categoria = $Categoria->where('slug', $url)->where('status', Status::ATIVO)->first();

        if (!empty($Categoria->nome)) {
            $Posts = (new Post)->getPostsCategory($Categoria->id, true);
            $Seo = $this->TagSeo->getSeo($Categoria);
            return view(TM . 'categoria', compact('Categoria', 'Posts', 'Seo'));
        }

        /**
         * Tags
         */
        $Tag = (new Tag)->where('slug', $url)->first();

        if (!empty($Tag->nome)) {
            $Seo = $this->TagSeo->getSeo($Tag);
            return view(TM . 'tag', compact('Tag', 'Seo'));
        }

        /**
         * P�ginas Normais
         */
        $Pagina = (new PaginaSeo)->where('url', $url)->first();

        if (!empty($Pagina->url)) {
            return $this->getDatas($Pagina);
        }

        /**
         * Conte�dos
         */
        $Conteudo = (new Conteudo)->where('slug', $url)->first();

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