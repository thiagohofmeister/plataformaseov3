var Post = {
	init: function() {
		$('.btnResponderComentario').click(Post.responderComentario);
	},
	responderComentario: function() {
		var $this = $(this),
			$form = $('form[name=comentario-add]'),
			$id = $this.attr('data-ref'),
			$nome = $this.parent().find('.autor-comentario').text(),
			$texto = "<span class='reply'>Você está respondendo o comentário feito por <span class='reply-author'>" + $nome + "</span></span>";
			$texto += "<span class='reply'>Para apenas comentar, sem responder clique <a href='javascript:void(0)' class='btnApenasResponder'>aqui</a></span>";

		

		if ($form.find('input[name=id_comentario_parent]').length) {
			$form.find('input[name=id_comentario_parent]').val($id);
			$form.find('.reply-author').text($nome);
		} else {
			$form.append("<input type='hidden' name='id_comentario_parent' value='" + $id + "'>");
			$form.prepend($texto);
			$('.btnApenasResponder').click(Post.apenasResponder);
		}
	},
	apenasResponder: function() {
		$('.reply').remove();
		$('input[name=id_comentario_parent]').remove();
	}
};
$(Post.init);