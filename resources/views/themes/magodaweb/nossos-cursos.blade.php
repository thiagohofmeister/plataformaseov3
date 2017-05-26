@extends(TM . 'layout.layout')

@section('conteudo')
<div class="header-page">
    <div class="center">
        <div class="titulo">
            <h1>Nossos Cursos</h1>
        </div>

        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}"><?= SITENAME; ?></a></li>
                <li><a href="{{ url('/nossos-cursos') }}">Nossos Cursos</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="conteudo">
    <div class="center">
        <article class="texto-pagina">
            <p>Em breve, iremos ter cursos para vender, fiquem ligados nas nossas redes sociais para ficar sabendo quando disponibilizarmos os cursos. Mais informações, entre em contato <a href="{{ url('/contato') }}">aqui.</a></p>
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
    "@id": "nossos-cursos",
    "name": "Nossos Cursos"
    }
    }]
    }
</script>
@stop