<?php 
require('../../_app/config.inc.php');

$upload = new Upload('post');
$upload->Image($_FILES['imagem_upload'], $_GET['titulo']);
$imagem = $upload->getResult();

echo "<img src='".BASE."$imagem' alt='Imagem de ".$_GET['titulo']."'>";
?>