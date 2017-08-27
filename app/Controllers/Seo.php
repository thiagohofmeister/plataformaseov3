<?php
namespace App\Controllers;

use App\Models\TagSeo;

/**
 * @todo Document class Seo.
 *
 * @author Thiago Hofmeister <thiago.hofmeister@gmail.com>
 */
class Seo extends Controller
{
    public $Seo;

    public function __construct() {
        $this->Seo = (new TagSeo)->getSeo();
    }
}