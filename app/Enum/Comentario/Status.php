<?php
namespace App\Enum\Comentario;

use App\Enum\Label;

/**
 * Enum dos status dos comentários.
 *
 * @method static Status NOVO()
 * @method static Status APROVADO()
 * @method static Status REPROVADO()
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Status extends Label
{
    /** @var string Comentário novo. */
    const NOVO = 'n';

    /** @var string Comentário aprovado. */
    const APROVADO = 'a';

    /** @var string Comentário reprovado. */
    const REPROVADO = 'r';

    /**
     * @inheritDoc
     */
    protected function getLabels()
    {
        return [
            self::NOVO => 'Novo',
            self::APROVADO => 'Aprovado',
            self::REPROVADO => 'Reprovado'
        ];
    }
}