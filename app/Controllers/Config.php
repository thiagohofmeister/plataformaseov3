<?php
namespace App\Controllers;

use App\Enum\Status;
use App\Models\Categoria;
use App\Models\Conteudo;
use App\Models\PaginaSeo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagSeo;
use Illuminate\Http\Request;

/**
 * @todo Document class Config.
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Config
{
    /** @var TagSeo */
    private $tagSeo;

    /** @var Request */
    private $request;

    public function __construct(TagSeo $tagseo, Request $request) {
        $this->tagSeo = $tagseo;
        $this->request = $request;
    }

    public function router($url, $action = null, $data = null) {
        // Remover parâmetros
        $url = str_replace('&', '', urldecode($url));
        if (strpos($url, '?') !== false) {
            $url = substr($url, 0, strpos($url, '?'));
        }

        if ($this->isAdminUrl()) {
            return $this->routerAdmin($url);
        }

        /**
         * Categoria
         */
        $Categoria = new Categoria();
        $Categoria = $Categoria->where('slug', $url)->where('status', Status::ATIVO)->first();

        if (!empty($Categoria->nome)) {
            $Posts = (new Post)->getPostsCategory($Categoria->id, true);
            $Seo = $this->tagSeo->getSeo($Categoria);
            return view(TM . 'categoria', compact('Categoria', 'Posts', 'Seo'));
        }

        /**
         * Tags
         */
        $Tag = (new Tag)->where('slug', $url)->first();

        if (!empty($Tag->nome)) {
            $Seo = $this->tagSeo->getSeo($Tag);
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
            $Seo = $this->tagSeo->getSeo($Conteudo);
            return view(TM . 'conteudo', compact('Conteudo', 'Seo'));
        }

        return response()->view(TM . '404', [], 404);
    }

    public function getDatas($Pagina) {
        $Seo = $this->tagSeo->getSeo($Pagina);
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

    /**
     * Realiza as rotas do painel administrativo.
     *
     * @param string $controller
     * @param string|null $action
     * @param string|null $data
     *
     * @return mixed
     */
    public function routerAdmin($controller, $action = 'index', $data = null)
    {
        $controller = $this->getUrlFormat($controller);

        if (!empty($action)) {
            $action = $this->getUrlFormat($action, true);
        }

        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $controller . '.php')) {
            $class = "App\\Controllers\\" . $controller;

        } elseif (file_exists(__DIR__ . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . $controller . '.php')) {
            $class = "App\\Controllers\\" . $controller;
        }

        try {

            $class = new $class;

            if (!empty($data)) {
                return $class->$action($data);
            }

            return $class->$action();

        } catch (\Exception $e) {

            return response()->view(TM . '404', [], 404);
        }
    }

    /**
     * Retorna se a URL é do painel administrativo.
     *
     * @return bool
     */
    private function isAdminUrl()
    {
        if (strpos($this->request->getRequestUri(), 'admin') !== false) {
            return true;
        }
        return false;
    }

    /**
     * Retorna a URL formatada.
     *
     * @param $urlSegments
     * @param bool $action
     *
     * @return string
     */
    private function getUrlFormat($urlSegments, $action = false)
    {
        $return = str_replace(' ', '', ucwords(str_replace('_', ' ', $urlSegments)));
        if ($action) {
            $return = lcfirst($return);
        }

        return $return;
    }
}