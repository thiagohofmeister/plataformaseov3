@extends(TM . 'layout/layout')

@section('conteudo')
<div class="header-page">
	<div class="center">
		<div class="titulo">
			<h1>Nosso Blog</h1>
		</div>

		<div class="breadcrumb">
			<ul>
				<li><a href="{{ url('/') }}"><?= SITENAME; ?></a></li>
				<li><a href="{{ url('/blog') }}">Nosso Blog</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="conteudo-categoria">
    <div class="center">
        <article class="texto-pagina">
            <p>Venha conhecer nossos artigos e posts sobre Desenvolvimento, SEO e dicas.</p>
        </article>
    </div>
	
	<div class="artigos">
		<div class="center">
			@if(count($Posts) > 0)
				@foreach ($Posts as $Post)
				<article>
					<div class="thumb">
						<img src="{{ url($Post->seo_open_graph ? $Post->seo_open_graph : $Post->imagem) }}">
						<div class="titulo">
							<h3>{{ $Post->titulo }}</h3>
							<span>{{ date("d/m/Y", strtotime($Post->data_postagem)) }}</span>
						</div>
					</div>
					<a href="{{ url($Post->categoria_slug . '/' . $Post->slug) }}" class="btn-ler">Ler este post</a>
					<p>{!! $Post->conteudo_resumido(30) !!}</p>

					<div class="clear"></div>
					
					@if (count($Post->posts_relacionados) > 0)
						@foreach ($Post->posts_relacionados as $pr)
						<div class="relacionado">
							<h4>Você vai gostar também de:</h4>
							<h3><?= $pr->titulo; ?></h3>
							<a href="{{ url($pr->categoria_slug . '/' . $pr->slug) }}">magodaweb/{{ $pr->categoria_slug . '/' . $pr->slug }}</a>
						</div>
						@endforeach
					@endif
				</article>
				@endforeach
			@endif
		</div>
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
      "@id": "blog",
      "name": "Blog"
    }
  }]
}
</script>
@stop