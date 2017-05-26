<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\TagSeo;
use App\Conteudo;
use App\Mail\TesteEmail;
use Illuminate\Support\Facades\Mail;

class AppController extends Controller {

    public function index() {
        $Posts = new Post;
        $Seo = new TagSeo;
        $Conteudo = new Conteudo;

        $Cases = $Conteudo->getContentsType('cases', 2);
        $CaseUm = !empty($Cases[0]) ? $Cases[0] : [];
        $CaseDois = !empty($Cases[1]) ? $Cases[1] : [];
        
        $Servicos = $Conteudo->getContentsType('servicos');
        
        $Posts = $Posts->getPosts(5);
        $Seo = $Seo->getSeo();

        return view(TM . 'index', compact('Posts', 'Seo', 'CaseUm', 'CaseDois', 'Servicos'));
    }

    public function envia() {
        Mail::to('thiago.hofmeister@gmail.com')->send(new TesteEmail);
    }

}
