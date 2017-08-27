<?php
namespace App\Repositories;

use App\Models\Categoria as Model;

/**
 * Repositório responsável pelas categorias.
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Categoria
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retorna uma lista com todas categorias.
     *
     * @return \App\Models\Categoria[]
     */
    public function findAll()
    {
        return $this->model->all();
    }
}