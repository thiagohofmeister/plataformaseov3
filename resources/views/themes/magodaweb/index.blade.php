@extends(TM . 'layout/layout')

@section('conteudo')

<section class="banner-principal">
    <div class="center">
        <div class="texto">
            <h2>Quer aumentar o seu número de clientes?</h2>
            <p>Contate-nos e vamos ajudá-lo com seu Marketing Digital.</p>
            <small>contato@magodaweb.com.br</small>
            <a href="{{ url('contato') }}">Saiba Mais</a>
        </div>

        @if ($CaseUm)
          <div class="case-um">
              <article>
                  <img src="{{ $CaseUm->imagem }}" alt="Imagem do {{ $CaseUm->titulo }}">
              </article>
          </div>
        @endif
        
        @if ($CaseDois)
          <div class="case-dois">
              <article>
                  <img src="{{ $CaseDois->imagem }}" alt="Imagem do {{ $CaseDois->titulo }}">
              </article>
          </div>
        @endif
    </div>
</section>

<div class="clear"></div>

<div class="conteudo">
    @if (count($Servicos) > 0)
    <div class="center">
        <section class="servicos">
           
              @foreach ($Servicos as $Servico)
                <article>
                  <h3>{{ $Servico->titulo }}</h3>
                  <img src="{{ url($Servico->imagem) }}">
                  <p>{{ $Servico->conteudo }}</p>
                </article>
              @endforeach
            
        </section>
    </div>
    @endif

    @if ($Posts)
        <div class="ultimos-artigos">
            <div class="center">
                <h3>Últimos Artigos</h3>
                
                @foreach ($Posts as $Post)
                    <article>
                        <a href="{{ url($Post->categoria_slug . '/' . $Post->slug) }}">
                            <img src="{{ url($Post->seo_open_graph ? $Post->seo_open_graph : $Post->imagem) }}">
                            <div class="info">
                                <h3>{{ $Post->titulo }}</h3>
                                <span class="data">{{ date('d/m/Y', strtotime($Post->data_postagem)) }}</span>
                                <span class="comentarios hidden">{{ $Post->comentarios }} comentários</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</div>
@stop