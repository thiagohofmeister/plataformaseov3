var Upload = {
    
    init: function() {
        var form;
        Upload.alterarArquivo();

        $('#ctrEnviarUpload').click(Upload.subirArquivo);

    },
    alterarArquivo: function() {
        $('input[name=imagem_upload]').change(function (event) {

            form = new FormData();
            form.append('imagem_upload', event.target.files[0]); // para apenas 1 arquivo
            //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
        });
    },
    subirArquivo: function() {
        var titulo = $('input[name=titulo_imagem_upload]'),
            file = $('input[name=imagem_upload]'),
            container = $('.cke_wysiwyg_frame').contents().find('.cke_editable_themed'),
            loader = $('.upload-container .loader'),
            botao = $('#ctrEnviarUpload');

        form.append('_token', $("input[name='_token']").val());
        form.append('titulo', titulo.val());

        if(titulo.val() == undefined || titulo.val() == '') {
            alert("Digite um título!");
            return false;
        }
        if(file.val() == undefined || file.val() == '') {
            alert("Selecione um arquivo!");
            return false;
        }
        $.ajax({
            url: '/admin/posts/upload_arquivo',
            type: 'POST',
            data: form,
            beforeSend: function() {
                loader.fadeIn();
            },
            success: function (data) {
                alert("Upload efetuado com sucesso!\nSua imagem será anexada automaticamente à Postagem.");

                titulo.val('');
                file.val('');
                container.html(container.html() + data);
                loader.fadeOut();
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
            return myXhr;
            }
        });        
    },
    preencherSlug: function() {
        var nomeCategoria = $('input[name=upload_titulo]').val(),
            campoSlug     = $('input[name=upload_slug]'),
            slug          = undefined;

        slug = nomeCategoria.toLowerCase();

        slug = slug.split(' ');
        slug = slug.join('-');

        slug = Plataforma.removerAcentos(slug);

        campoSlug.val(slug);
    }
};
$(Upload.init);
