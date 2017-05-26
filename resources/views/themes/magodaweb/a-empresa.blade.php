@extends(TM . 'layout/layout')

@section('conteudo')
<div class="header-page">
	<div class="center">
		<div class="titulo">
			<h1>A Empresa {{ SITENAME }}</h1>
		</div>

		<div class="breadcrumb">
			<ul>
				<li><a href="{{ url('/') }}">{{ SITENAME }}</a></li>
				<li><a href="{{ url('/a-empresa') }}">A Empresa {{ SITENAME }}</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="conteudo">
    <div class="center">
        <article class="texto-pagina">
            <p>O Mago da Web, vem até a internet para expor seus conhecimentos de desenvolvimento, além de trazer serviços, como criação de sites, aplicativos, marketing digital, e-mail marketing, SEO avançado. Se você quer aprender a desenvolver com facilidade, clareza e competência, você precisa participar das aulas do Mago da Web. E, se sua ideia é ter um site próprio, um aplicativo para celular ou uma agência de SEO, você também está no lugar correto, temos todos esses serviços para você. Entre em contato conosco e saiba muito mais.</p>
        </article>
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
      "@id": "a-mago",
      "name": "A Mago"
    }
  }]
}
</script>
@stop