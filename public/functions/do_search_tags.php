<?php 
require('../../_app/config.inc.php');

$term = $_GET['term'];

$tags = new Tag;
$tag = $tags->getTagsForName($term);

if ($tags->getResult()):
    echo json_encode($tag, JSON_FORCE_OBJECT);
endif;
?>