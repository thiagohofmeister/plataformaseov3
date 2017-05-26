<?php
use App\TagSeo;

function createConstants()
{
    $enviroment = verifyEnviroment();

    if (Schema::hasTable('tag_seos')) {
    	$tmp = TagSeo::first();
    } else {
        return false;
    }

    /**
     * Constantes Padrões
     */
    define('DS', DIRECTORY_SEPARATOR);
    define('VIEWS', '..' . DS . 'resources' . DS . 'views' . DS);
    define('VIEWS_REF', 'resources' . DS . 'views' . DS);
    define('ASSET', ($enviroment == 1 ? 'public/' : ''));

	/**
	 * H1 - SITENAME
	 */
	$title = 'Title Default';
	if (!empty($tmp->seo_title)) {
        $title = $tmp->seo_title;
    }    
    define('SITENAME', $title);

    /**
     * Slogan
     */
    $slogan = 'Slogan Default';
	if (!empty($tmp->slogan)) {
        $slogan = $tmp->slogan;
    }    
    define('SLOGAN', $slogan);

	/**
	 * Tema
	 */
    define('TM_PATH', 'themes' . DS);
    $theme = 'default';
    if (!empty($tmp->tema) && findTheme($tmp->tema)) {
        $theme = $tmp->tema;
    }    
    define('TM', 'themes.' . $theme . '.'); 
}

function getThemes()
{
    if (File::exists(VIEWS . TM_PATH)) {
        $dir = File::directories(VIEWS . TM_PATH);
    } elseif (File::exists(VIEWS_REF . TM_PATH)) {
        $dir = File::directories(VIEWS_REF . TM_PATH);
    } else {
        $dir = [];
    }
    

    foreach ($dir as $key => $val) {
        $var = explode('/', $val);
        $dir[$key] = end($var);
    }

    sort($dir);

    return $dir;
}

function findTheme($file)
{
    if (File::exists(VIEWS . TM_PATH . $file) || File::exists(VIEWS_REF . TM_PATH . $file)) {
        return true;
    } else {
        return false;
    }
}

function findPage($page)
{
    $dir = str_replace('.', DS, substr(TM, 0, -1));
    $page = $dir . DS . $page .'.blade.php';
    if (File::exists(VIEWS . $page) || File::exists(VIEWS_REF . $page)) {
        return true;
    } else {
        return false;
    }
}

function limitText($text, $limit){
    $text = substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . '...';
    return $text;
}

function limitWords($text, $limit){
    $text_tmp = explode(' ', $text);
    if (count($text_tmp) > $limit) {
        $text = [];
        for ($i = 0; $i <= $limit; $i++) {
            $text[] = $text_tmp[$i];
        }
        $text = implode(' ', $text);
        $text .= '...';
    }
    return $text;
}

function verifyEnviroment() {
    $enviroment = 1;
    if (
        strstr(url('/'), 'localhost') || 
        strstr(url('/'), 'staging')
    ) {
        $enviroment = 0;
    }

    return $enviroment;
}
?>