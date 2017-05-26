<?php 
define('PATH', $_SERVER['DOCUMENT_ROOT'].'plataforma/');
require_once(PATH."elements/head_default.php");

?>
<html>
    <head>
        <?php require_once(PATH."elements/tags.php"); ?>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <?php 
        if(strstr($_SERVER['SERVER_NAME'], 'localhost')):
        ?>
            <link rel="stylesheet/less" href="<?= $ss; ?>css/main.less" type="text/css">
            <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>
        <?php 
        else:
        ?>
            <link rel="stylesheet" href="<?= $ss; ?>css/main.css" type="text/css">
        <?php 
        endif;
        ?>
    </head>
    <body>
    	<?php require_once("header.php"); ?>
		
		<div class="header-page">
    		<div class="center">
    			<div class="titulo">
    				<h1>Modelo</h1>
    			</div>

    			<div class="breadcrumb">
    				<ul>
    					<li><a href="<?= $ss; ?>"><?= $empresa->nome; ?></a></li>
    					<li><a href="<?= $ss; ?>modelo">modelo</a></li>
    				</ul>
    			</div>
    		</div>
    	</div>

    	<div class="conteudo">
            <div class="center">
                <article class="texto-pagina">
                    <p>Está com dúvidas? Quer um orçamento? Entre em contato conosco. Estaremos sempre a disposição para qualquer forma de contato. Use e abuse, ficaremos contentes em poder ajudar.</p>
                </article>
            </div>
    	</div>

    	<?php require_once("footer.php"); ?>
        <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "modelo",
              "name": "Modelo"
            }
          }]
        }
        </script>
    </body>
</html>