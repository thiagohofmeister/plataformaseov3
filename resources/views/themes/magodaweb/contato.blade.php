@extends(TM . 'layout.layout')

@section('conteudo')
<div class="header-page">
	<div class="center">
		<div class="titulo">
			<h1>Fale Conosco</h1>
		</div>

		<div class="breadcrumb">
			<ul>
				<li><a href="{{ url('/') }}">{{ SITENAME }}</a></li>
				<li><a href="{{ url('/contato') }}">Fale Conosco</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="conteudo">
    <div class="center">
        <article class="texto-pagina">
            <p>Está com dúvidas? Quer um orçamento? Entre em contato conosco. Estaremos sempre a disposição para qualquer forma de contato. Use e abuse, ficaremos contentes em poder ajudar.</p>
        </article>
        <div class="clear"></div>
        <section class="formulario">
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
            <form method="POST" action="{{ url('/contato') }}" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="Seu nome" value="{{ old('nome') }}">
                <input type="email" name="email" placeholder="Seu E-mail" value="{{ old('email') }}">
                <input type="tel" class="mask-phone-number" name="telefone" placeholder="Seu Telefone" value="{{ old('telefone') }}">
                <select name="assunto">
                    <option value="-1" {{ old('assunto') == '-1' ? "selected='selected'" : '' }} >Escolha</option>
                    <option value="1" {{ old('assunto') == '1' ? "selected='selected'" : '' }} >Dúvidas</option>
                    <option value="2" {{ old('assunto') == '2' ? "selected='selected'" : '' }} >Orçamento</option>
                    <option value="3" {{ old('assunto') == '3' ? "selected='selected'" : '' }} >Sugestão</option>
                    <option value="4" {{ old('assunto') == '4' ? "selected='selected'" : '' }} >Criticas</option>
                </select>
                <textarea name="mensagem" placeholder="Sua Mensagem">{{ old('mensagem') }}</textarea>

                {{ CSRF_FIELD() }}

                <input type="submit" name="btn_enviar" class="btn_enviar" value="Enviar">
            </form>
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
      "@id": "contato",
      "name": "Contato"
    }
  }]
}
</script>
@stop