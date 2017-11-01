<?php

namespace App\Enum\Post;

use App\Enum\Label;

/**
 * Enum de status das postagens.
 *
 * @method static PossuiSeo NO()
 * @method static PossuiSeo YES()
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class PossuiSeo extends Label
{
    /** @var int Postagem rascunho. */
    const NO = 0;

    /** @var int Postagem publicada. */
    const YES = 1;

    /**
     * @inheritDoc
     */
    protected function getLabels()
    {
        return [
            self::NO => "Não",
            self::YES => "Sim"
        ];
    }

    /**
     * Retorna a classe para usar nas views.
     *
     * @return string
     */
    public function getClassStyle()
    {
        switch($this->value()) {

            case self::NO:
                return "danger";

            case self::YES:
                return "success";
        }
    }
}