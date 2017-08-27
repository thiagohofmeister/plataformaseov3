<?php

namespace App\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Controller extends BaseController {
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * Método Genérico para Upload de arquivos
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $name
     *
     * @return string
     */
    public function upload($file, $path, $name) {
        $path = 'public/' . $path;
    
        $file->move($path, $name);
        
        return $path . $name;
    }

    /**
     * Cria um slug através de um texto
     *
     * @param string $text
     * @return string
     */
    public function makeSlug($text) {
        return $this->removeSpecialCharacters($text, true);
    }

    /**
     * Remove os caractéres especiais e cria slug
     * 
     * @param string $string
     * @param boolean $slug
     * @return string
     */
    public function removeSpecialCharacters($string, $slug = false) {
	    $string = strtolower($string);
	
	    $string = preg_replace('/[áàãâä]/ui', 'a', $string);
        $string = preg_replace('/[éèêë]/ui', 'e', $string);
        $string = preg_replace('/[íìîï]/ui', 'i', $string);
        $string = preg_replace('/[óòõôö]/ui', 'o', $string);
        $string = preg_replace('/[úùûü]/ui', 'u', $string);
        $string = preg_replace('/[ç]/ui', 'c', $string);
	    $string = preg_replace('/[^a-z0-9]/i', ' ', $string);
	    $string = trim($string);
	
	    // Slug?
	    if ($slug) {
		    $charNew = '-';
		    // Troca tudo que não for letra ou número por um caractere (-)
		    $string = preg_replace('/[^a-z0-9]/i', $charNew, $string);
		    // Tira os caracteres (-) repetidos
		    $string = preg_replace('/' . $charNew . '{2,}/i', $charNew, $string);
		    $string = trim($string, $charNew);
	    }
	
	    return $string;
    }

    /**
     * Retorna o nome do arquivo.
     *
     * @param UploadedFile $file
     * @param string|null $name
     *
     * @return string
     */
    public function makeFileName($file, $name = null) {
        if ($name != null) {
            $file_name = $this->makeSlug($name);
            $file_name .= '.' . $file->getClientOriginalExtension();

            return $file_name;
        }

        $file_name = $file->getClientOriginalName();

        return $file_name;
    }

    /**
     * Corrige as datas para o formato correto.
     *
     * @param $req
     * @param array $datas
     * @param bool $sem_hora
     */
    public function setDatas(&$req, $datas = [], $sem_hora = false) {
        foreach ($datas as $key => $date) {

            if (is_array($date)) {
                if (!empty($req[$date])) {
                    $req[$date] = $this->arrumarDatas($req[$date], $sem_hora);
                } else {
                    $req[$key][$date] = $this->arrumarDatas($req[$key][$date], $sem_hora);
                }
            } else {
                if (!empty($req->$date)) {
                    $req->$date = $this->arrumarDatas($req->$date, $sem_hora);
                } else {
                    $req[$key]->$date = $this->arrumarDatas($req[$key]->$date, $sem_hora);
                }
            }
        }
    }

    /**
     * Retornas as datas no formato correto.
     *
     * @param string $data
     * @param bool $sem_hora
     *
     * @return string
     */
    public function arrumarDatas($data, $sem_hora = false) {
        if ($sem_hora) {
            if (count(explode("/", $data)) > 1) {
                return date('Y-m-d', strtotime(str_replace('/', '-', $data)));
            } else {
                return date('d/m/Y', strtotime(str_replace('/', '-', $data)));
            }
        }
        if (count(explode("/", $data)) > 1) {
            return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data)));
        } else {
            return date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $data)));
        }
    }
}
