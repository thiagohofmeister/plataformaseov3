<!DOCTYPE html>
<html>
<head>
	<title>Site em manutenção</title>

	<link rel="icon" href="{{ url(ASSET . 'images/favicon.ico') }}" type="image/x-icon"/>
	<link rel="shortcut icon" href="{{ url(ASSET . 'images/favicon.ico') }}" type="image/x-icon"/>

	<style type="text/css">
		body {
			font-family: sans-serif; background: #e1e1e1;
		}
		div {
			width: 400px; text-align: center; height: 120px; position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto;
		}
		h2 {
			text-transform: uppercase; margin: 30px 0 15px;
		}
		p {
			width: 220px; display: block; margin: 0 auto; font-size: 20px; position: relative;
		}
		p span {
			position: absolute; left: 100%;
		}
		small {
			margin: 20px 0; font-style: italic; display: block;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var cont = 0;
		setInterval(function(){
			var txt = $('span').html();
				
			if (cont % 3 == 0) {
				txt = '';
				$('span').text('');
			}
			if (cont == 20) {
				window.location.reload();
			}
			$('span').text(txt + '.');
			cont++;
		}, 1000);
		
		
	</script>
</head>
<body>
	<div>
		<img src="{{ url(ASSET . 'images/logotipo.png') }}" alt="Logotipo do Mago da Web">
		<h2>Em manutenção</h2>
		<p>Aguarde alguns minutos<span></span></p>

		<small>Obs: a página entrará automaticamente quando estiver disponível.</small>
	</div>
</body>
</html>