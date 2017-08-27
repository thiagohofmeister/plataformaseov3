<?php

namespace App\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Post;
use Illuminate\View\View;

class CategoriaController extends Controller {
    /** @var Categoria */
    private $categoria;

    public function __construct(Categoria $categoria = null) {
        $this->categoria = $categoria;
        if (empty($categoria)) {
            $this->categoria = new Categoria();
        }
    }

    /**
     * Lista de Categorias
     * 
     * @return View com uma listagem das categorias
     */
    public function index() {
        $Categorias = $this->categoria->getCats();

        return view(TM . 'admin/categorias/index', compact('Categorias'));
    }

    /**
     * Retorna a view de cadastro
     * 
     * @return View Cadastro
     */
    public function add() {
        return view(TM . 'admin/categorias/add');
    }

    public function postAdd(Request $request) {
        $req = $request->except('_token');

        if (!empty($req['nome'])) {
            // Criar slug
            $req['slug'] = $this->makeSlug($req['nome']);
        }

        $validator = validator($req, $this->categoria->fields_validator, $this->categoria->msgs_validator);
        if ($validator->fails()) {
            return redirect('admin/categorias/add')->withErrors($validator)->withInput();
        }

        $file = $request->file('seo_open_graph');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['nome']);
            $file_path = 'uploads/categoria/';

            $req['seo_open_graph'] = $this->upload($file, $file_path, $file_name);
        }

        $save = $this->categoria->create($req);

        if ($save) {
            return redirect('admin/categorias/add')->with('msg', 'Categoria cadastrada com sucesso!');
        } else {
            return redirect('admin/categorias/add')->withErrors('Erro ao cadastrar a categoria')->withInput();
        }
    }

    /**
     * Retorna a view de edição
     * 
     * @param int $id
     * @return View Edição
     */
    public function edit($id) {
        $Categoria = $this->categoria->find($id);

        return view(TM . 'admin/categorias/edit', compact('Categoria'));
    }

    /**
     * Faz a edição da categoria.
     *
     * @param $id
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function postEdit($id, Request $request) {
        $req = $request->except('_token', 'url');

        if (!empty($req['nome'])) {
            // Criar slug
            $req['slug'] = $this->makeSlug($req['nome']);
        }
        
        $fields = $this->categoria->fields_validator;
        unset($fields['seo_open_graph']);
        
        $fields['slug'] = 'unique:categorias,slug,' . $id;
        
        
        $validator = validator($req, $fields, $this->categoria->msgs_validator);
        if ($validator->fails()) {
            return redirect('admin/categorias/edit/' . $id)->withErrors($validator)->withInput();
        }

        $file = $request->file('seo_open_graph');
        if (!empty($file)) {
            $file_name = $this->makeFileName($file, $req['nome']);
            $file_path = 'uploads/categoria/';

            $req['seo_open_graph'] = $this->upload($file, $file_path, $file_name);;
        }

        $upload = $this->categoria->where('id', $id)->update($req);

        if ($upload) {
            return redirect('admin/categorias/edit/'.$id)->with('msg', 'Categoria modificada com sucesso!');
        } else {
            return redirect('admin/categorias/edit/'.$id)->withErrors('Erro ao modificar a categoria')->withInput();
        }
    }

    /**
     * Remove uma categoria.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete($id) {        
        $PostsVinculados = new Post();
        $PostsVinculados = $PostsVinculados->where('id_categoria', $id)->get();
        
        if (count($PostsVinculados) > 0) {
            $up = ['status' => 0];
            $this->categoria->find($id)->update($up);
            return redirect('admin/categorias/')->with('msg', 'Existem postagens vinculadas com essa categoria, então a categoria foi apenas inativada e não excluída.');
        }
        
        $delete = $this->categoria->find($id)->delete();
        
        if ($delete) {
            return redirect('admin/categorias/')->with('msg', 'Categoria excluída com sucesso!');
        } else {
            return redirect('admin/categorias/')->withErrors('Erro ao excluir a categoria')->withInput();
        }
    }

    /**
     * Altera o status da categoria.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function status($id) {
        $Categoria = $this->categoria->find($id);
        
        $up['status'] = 1;
        $msg = 'A categoria ' . $Categoria->nome . ' foi ';
        
        if ($Categoria->status) {
            $up['status'] = 0;
        }
        
        $msg .= ($up['status'] == 1 ? 'ativada' : 'desativada') . ' com sucesso!';
        
        $update = $Categoria->update($up);
        if ($update) {
            return redirect('admin/categorias/')->with('msg', $msg);
        } else {
            return redirect('admin/categorias/')->withErrors('Erro ao alterar o status da categoria.')->withInput();
        }
    }
}
