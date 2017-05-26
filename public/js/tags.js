var Tag = {
    init: function () {
        $("#ctrBuscarTags").keyup(Tag.buscarTags);
    },
    buscarTags: function () {
        var $inputTerm = $(this);

        $.ajax({
            url: '../functions/do_search_tags.php?term=' + $inputTerm.val(),
            type: 'JSON',
            beforeSend: function () {
            },
            success: function (data) {
                console.log(data[1]);
            }
        });
    },
    selecionarTag: function () {

    },
    removerTag: function () {

    }
};
$(Tag.init);