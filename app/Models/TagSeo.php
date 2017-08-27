<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class TagSeo extends Model {

    protected $fillable = [
        'slogan',
        'seo_title',
        'seo_description',
        'seo_spam_text',
        'seo_open_graph',
        'tema',
        'email',
        'base_url',
        'facebook',
        'twitter',
        'googleplus',
        'youtube',
        'tags_head',
        'tags_body',
        'tags_foot'
    ];
    public $timestamps = false;

    public function getTagSeos() {
        return $this->first();
    }

    public function getSeo($seo_tmp = null, $full = true) {
        $seo = TagSeo::first();

        if (empty($seo)) {
            return redirect('/');
        }

        if (!empty($seo->slogan)) {
            $seo->seo_title .= ' - ' . $seo->slogan;
        }

        if ($seo_tmp != null) {

            $tmp = array_values(reset($seo));
            
            // Post
            if (!empty($seo_tmp->data_postagem)) {
                foreach ($tmp as $t) {
                    if (!empty($seo_tmp->$t)) {
                        $seo->$t = $seo_tmp->$t;
                    } elseif ($t == 'seo_title' && !empty($seo_tmp->titulo)) {
                        $seo->$t = $seo_tmp->titulo;
                    } elseif ($t == 'seo_description' && !empty($seo_tmp->conteudo)) {
                        $seo->$t = limitText($seo_tmp->conteudo, 150);
                    } elseif ($t == 'seo_open_graph' && !empty($seo_tmp->imagem)) {
                        $seo->$t = $seo_tmp->imagem;
                    }
                }
            } else {
                foreach ($tmp as $t) {
                    if (!empty($seo_tmp->$t)) {
                        $seo->$t = $seo_tmp->$t;
                    }
                }
            }

            if (!empty($seo_tmp->categoria_slug)) {
                $seo->base_url = url($seo_tmp->categoria_slug . '/' . $seo_tmp->slug);
            } elseif (!empty($seo_tmp->slug)) {
                $seo->base_url = url($seo_tmp->slug);
            }

            if (!empty($seo_tmp)) {
                $seo->seo_title .= ' - ' . SITENAME;
            }

            if (empty($seo_tmp->seo_open_graph) && !empty($seo_tmp->imagem)) {
                $seo->seo_open_graph = $seo_tmp->imagem;
            }            
        }
        
        if (!empty($seo->seo_description)) {
            $seo->seo_description = strip_tags($seo->seo_description);
        }

        $meta_tags = [];

        // NORMAL PAGE
        $meta_tags[] = '<meta charset="utf-8">' . "\n";
        $meta_tags[] = '<title>' . $seo->seo_title . '</title> ' . "\n";
        $meta_tags[] = '<link rel="icon" href="' . url('public/images/favicon.ico') . '" type="image/x-icon"/>' . "\n";
        $meta_tags[] = '<link rel="shortcut icon" href="' . url('public/images/favicon.ico') . '" type="image/x-icon"/>' . "\n";
        $meta_tags[] = '<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">' . "\n";

        if ($full) {
            $meta_tags[] = '<meta name="description" content="' . $seo->seo_description . '"/>' . "\n";
            $meta_tags[] = '<meta name="robots" content="index, follow">' . "\n";
            $meta_tags[] = '<link rel="canonical" href="' . $seo->base_url . '" />' . "\n";
            $meta_tags[] = '<base href="' . url('/') . '" />' . "\n";
            $meta_tags[] = '<link rel="publisher" href="' . $seo->googleplus . '"/>' . "\n";
            $meta_tags[] = '<meta property="article:publisher" content="' . $seo->facebook . '" />' . "\n";
            $meta_tags[] = '<meta property="article:section" content="Geral" />' . "\n";
            $meta_tags[] = "\n";

            // FACEBOOK E GOOGLE PLUS
            $meta_tags[] = '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
            $meta_tags[] = '<meta property="og:locale" content="pt_BR" />' . "\n";
            $meta_tags[] = '<meta property="og:title" content="' . $seo->seo_title . '" />' . "\n";
            $meta_tags[] = '<meta property="og:description" content="' . $seo->seo_description . '" />' . "\n";
            $meta_tags[] = '<meta property="og:image" content="' . url($seo->seo_open_graph) . '" />' . "\n";
            $meta_tags[] = '<meta property="og:url" content="' . $seo->base_url . '" />' . "\n";
            $meta_tags[] = '<meta property="og:type" content="website" />' . "\n";
            $meta_tags[] = "\n";

            // ITEM GROUP (TWITTER)
            $meta_tags[] = '<meta name="twitter:card" content="summary_large_image"/>' . "\n";
            $meta_tags[] = '<meta name="twitter:description" content="' . $seo->seo_description . '"/>' . "\n";
            $meta_tags[] = '<meta name="twitter:title" content="' . $seo->seo_title . '"/>' . "\n";
            $meta_tags[] = '<meta name="twitter:site" content="' . $seo->twitter . '"/>' . "\n";
            $meta_tags[] = '<meta name="twitter:image" content="' . url($seo->seo_open_graph) . '"/>' . "\n";
            $meta_tags[] = '<meta name="twitter:creator" content="' . $seo->twitter . '"/>' . "\n";
        }

        $seo->meta_tags = $meta_tags;

        return $seo;
    }

}
