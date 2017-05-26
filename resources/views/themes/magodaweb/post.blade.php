@extends(TM . 'layout.layout')

@section('conteudo')
<div id="fb-root"></div>
<script>(function (d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id))
    return;
  js = d.createElement(s);
  js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=444626882285373";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="header-page">
  <div class="center">
    <div class="titulo">
      <h1>{{ $Post->titulo }}</h1>
    </div>

    <div class="breadcrumb">
      <ul>
        <li><a href="{{ url('/') }}">{{ SITENAME }}</a></li>
        <li><a href="{{ url('/' . $Post->categoria_slug) }}">{{ $Post->categoria }}</a></li>
        <li><a href="{{ url('/' . $Post->categoria_slug . '/' . $Post->slug) }}">{{ $Post->titulo }}</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="conteudo-post">
  <div class="cabecalho">
    <div class="center">
      <img src="{{ url('/'.$Post->imagem) }}" class="imagem-principal">

      <div class="titulo-post">
        <img src="{{ url('/'.$Post->autor_imagem) }}">
        <h1>{{ $Post->titulo }}</h1>
        <div class="infos">
          <span class="data">{{ date("d/m/Y", strtotime($Post->data_postagem)) }}</span>
          <span class="autor">Postado por <span class="nome">{{ $Post->autor_nome }}</span></span>
          <span class="comentarios">{{ $Post->comentarios }}</span>
          @if ($Post->tags)
          <span class="tags">{{ $Post->tags }}</span>                    
          @endif
        </div>                            
      </div> 
      <div class="clear"></div>                     
    </div>
  </div>
  <div class="clear"></div>

  <div class="center">
    <aside class="sidebar">
      <div class="redes-sociais">
        <span>Compartilhar</span>
        <ul>
          <li><div class="fb-share-button" data-href="{{ url('/' . $Post->categoria_slug . '/' . $Post->slug) }}" data-layout="button"></div></li>
          <li><a href="https://twitter.com/intent/tweet/?original_referer={{ url('/' . $Post->categoria_slug . '/' . $Post->slug) }}&amp;source=tweetbutton&amp;text={{ $Post->titulo }}&amp;url={{ url('/' . $Post->categoria_slug . '/' . $Post->slug) }}&amp;via={{ $Seo->twitter }}" target="_blank" class="tweet-button" data-url="{{ url('/' . $Post->categoria_slug . '/' . $Post->slug) }}" data-via="{{ $Seo->twitter }}" data-text="{{ $Post->titulo }}">
            <img src="{{ url('/public/uploads/diversos/icone-twitter.png') }}">
          </a></li>
          <?php /* ?>
          <li><a href="#"><img src="<?= $ss; ?>uploads/diversos/icone-google-plus.png"></a></li>
          <li><a href="#"><img src="<?= $ss; ?>uploads/diversos/icone-linkedin.png"></a></li>
          <?php */ ?>
        </ul>
      </div>
    </aside>
    <article>
      <div class="artigo-conteudo">
        {!! $Post->conteudo !!}
      </div>
    </article>

      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Mago da Web -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-7064663556810473"
           data-ad-slot="5580198749"
           data-ad-format="auto"></ins>
      <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
      </script>

    <section>
        <script>
            window.dna = {
                r:'52dd1f8722885',
                c:'hospedagem-de-sites',
                t:'300x250'
            };
        </script>
        <script type="text/javascript" src="//www.kinghost.com.br/dna.js"></script>
    </section>

    <section class="artigo-comentarios">
      <h2 class="title-comentarios">Comentários do Artigo</h2>
      <div class="comentarios">
        @if (count($Comentarios) > 0)
        <ul class = "list-comentarios">
          @foreach ($Comentarios as $Comentario)
          <li class="comentario{{ !empty($Comentario->id_comentario_parent) ? ' son' : '' }}">
            <h3 class="autor-comentario">{{ $Comentario->nome_autor }}</h3>
            <span class="data-comentario">
              {{ date('d/m/Y H:i', strtotime($Comentario->data_comentario)) }}
            </span>
            <a href="javascript:void(0);" class="btnResponderComentario" data-ref='{{ $Comentario->id }}'>responder</a>
            <p class="mensagem-comentario">{{ $Comentario->comentario_texto }}</p>
          </li>
          @endforeach
        </ul>
        @else
        <p class="nenhum-comentario">Ainda não foram realizados comentários, seja o primeiro a comentar!</p>
        @endif
      </div>

      <div class="novo-comentario">
        <h2 class="title-novo">Escreva seu comentário</h2>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
           @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
         </ul>
       </div>
       @endif

       @if (session('msg'))
       <div class="alert alert-success">
        <ul>      
         <li>{{ session('msg') }}</li>
       </ul>
     </div>
     @endif

     <form action="" method="post" name="comentario-add">
      <label class="label-comentario">
        <span class="txt-label">Seu nome:</span>
        <input type="text" name="nome_autor" class="field">  
      </label>

      <label class="label-comentario">
        <span class="txt-label">Seu e-mail:</span>
        <input type="text" name="email" class="field">
      </label>

      <label class="label-comentario">
        <span class="txt-label">Seu comentário:</span>
        <textarea name="comentario_texto" class="field-area"></textarea>
      </label>
      {{ CSRF_FIELD() }}
      <input type="submit" class="btn-enviar" value="Enviar comentário">
    </form>
  </div>
</section>

<div class="clear"></div>

<?php
        /* $LinksRelacionados = buscarLinksRelacionados($Post, 5, 5);
          if (count($LinksRelacionados) > 0):
          ?>
          <div class="outras-postagens">
            <div class="titulo-outras">
              <div class="line"></div>
              <h2>Posts Relacionados</h2>
            </div>

            <ul>
              @foreach ($LinksRelacionados as $link)
              <li><a href="#">{{ $link->titulo }} - {{ $link->categoria }}</a></li>
              @endforeach;
            </ul>
            <div class="clear"></div>
          </div>
          <?php
          endif; */
          ?>
        </div>              

      </div>

      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "{{ $Post->categoria_slug }}",
              "name": "{{ $Post->categoria }}"
            }
          },{
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ $Post->slug }}",
              "name": "{{ $Post->titulo }}"
            }
          }]
        }
      </script>

      @stop

      @section('js')
      <script type="text/javascript" src="{{ asset('js/post.js') }}"></script>
      @stop