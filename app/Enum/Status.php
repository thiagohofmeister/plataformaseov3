<?php

namespace App\Enum;

/**
 * Enum para os status.
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Status extends Label
{
    const INATIVO = 0;
    const ATIVO = 1;

    /**
     * Retorna array com todos os Labels.
     *
     * @return array
     */
    protected function getLabels()
    {
        return [
            self::INATIVO => "Inativo",
            self::ATIVO => "Ativo",
        ];
    }
}