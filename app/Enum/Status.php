<?php

namespace App\Enum;

/**
 * Enum para os status.
 *
 * @method static Status INATIVO()
 * @method static Status ATIVO()
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Status extends Label
{
    /** @var int Status inativo. */
    const INATIVO = 0;

    /** @var int Status ativo. */
    const ATIVO = 1;

    /**
     * @inheritDoc
     */
    protected function getLabels()
    {
        return [
            self::INATIVO => "Inativo",
            self::ATIVO => "Ativo",
        ];
    }
}