<?php 
$Cases = new Read;
$Cases->FullRead("SELECT c.* FROM Conteudo c INNER JOIN TipoConteudo tc ON (c.idTipoConteudo = tc.idTipoConteudo) WHERE tc.slug = :slug", "slug=cases");
$Cases = $Cases->getResult();
?>
<div class="header-page">
	<div class="center">
		<div class="titulo">
			<h1>Portfólio</h1>
		</div>

		<div class="breadcrumb">
			<ul>
				<li><a href="<?= BASE; ?>"><?= SITENAME; ?></a></li>
				<li><a href="<?= BASE; ?>portfolio">Portfólio</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="conteudo">
    <div class="center">
        <article class="texto-pagina">
            <p>Caso você ainda não se decidiu de como pode ficar seu serviço, você pode dar uma olhadinha nos nossos clientes atuais para ter uma pequena ideia do serviço que prestamos e da qualidade dele.</p>
        </article>

        <section class="cases">
            <?php 
            if($Cases):
            foreach ($Cases as $case):
            extract($case);
            ?>
            <article>
                <h3><?= $titulo; ?></h3>
                <img src="<?= BASE . $imagem; ?>">
                <p><?= $conteudo; ?></p>
            </article>
            <?php 
            endforeach;
            endif;
            ?>
        </section>
    </div>
</div>


<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "item": {
      "@id": "portfolio",
      "name": "Portfólio"
    }
  }]
}
</script>