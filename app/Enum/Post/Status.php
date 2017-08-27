<?php

namespace App\Enum\Post;

use App\Enum\Label;

/**
 * Enum de status das postagens.
 *
 * @method static Status DRAFT()
 * @method static Status PUBLISHED()
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Status extends Label
{
    /** @var int Postagem rascunho. */
    const DRAFT = 0;

    /** @var int Postagem publicada. */
    const PUBLISHED = 1;

    /**
     * @inheritDoc
     */
    protected function getLabels()
    {
        return [
            self::DRAFT => "Rascunho",
            self::PUBLISHED => "Publicado"
        ];
    }
}