<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Post;

class ComentarioController extends Controller {
    /** @var Comentario */
    private $Comentario;

    public function __construct(Comentario $comentario) {
        parent::__construct();

        $this->Comentario = $comentario;
    }

    public function index() {
        $Comentarios = $this->Comentario->getComments();

        return view(TM . 'admin/comentarios/index', compact('Comentarios'));
    }

    /**
     * Cadastrar Comentário
     *
     * @param string $categoria - slug da categoria
     * @param string $post - slug do post
     * @param Request $request - inputs do formulário
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($categoria, $post, Request $request) {
        $req = $request->except('_token');
        $url = "{$categoria}/{$post}";

        $opts = [
            'nome_autor' => 'required|min:3',
            'email' => 'required|email',
            'comentario_texto' => 'required|min:5|max:250'
        ];

        $id_post = new Post;
        $id_post = $id_post->select('id')->where('slug', $post)->first();

        $req['id_post'] = $id_post->id;

        $validator = validator($req, $opts);

        if ($validator->fails()) {
            return redirect($url)->withErrors($validator)->withInput();
        }

        $add = $this->Comentario->create($req);

        if ($add) {
            return redirect($url)->with('msg', 'Comentário cadastrado com sucesso!');
        } else {
            return redirect($url)->with('msg', 'Erro ao cadastrar comentário!');
        }
    }
}
