@extends(TM . 'layout.layout')

@section('conteudo')
<div class="header-page">
    <div class="center">
        <div class="titulo">
            <h1>Nossos Serviços</h1>
        </div>

        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}">{{ SITENAME }}<a></li>
                <li><a href="{{ url('/servicos') }}">Nossos Serviços</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="conteudo">
    <div class="center">
        <article class="texto-pagina">
            <p>O grupo Mago da Web, contém diversos serviços. Aqui você consegue ver todos os serviços que são prestados, para mais informações aconselhamos você a entrar em contato conosco através da página de <a href="{{ url('/contato') }}">"Fale Conosco"</a> ou pelas nossas redes sociais.</p>
        </article>

        <section class="servicos">
            @if ($Servicos)
                @foreach ($Servicos as $Servico)
                    <article>
                        <h3>{{ $Servico->titulo }}</h3>
                        @if ($Servico->imagem)
                            <img src="{{ url('/' . $Servico->imagem) }}">
                        @endif
                        <p>{{ $Servico->conteudo }}</p>
                    </article>
                @endforeach
            @endif
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
    "@id": "servicos",
    "name": "Serviços"
    }
    }]
    }
</script>
@stop