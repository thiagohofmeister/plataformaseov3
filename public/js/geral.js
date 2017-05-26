var Geral = {
    init: function () {
        Geral.activeMaskDate();
        Geral.activeMaskDateTime();
        Geral.activeMaskTime();
        Geral.activeMaskPhone();

        if ($('.confirm-delete').length) {
            $('.confirm-delete').click(Geral.confirmDelete);
        }
    },
    confirmDelete: function () {
        var $url = $(this).attr('data-ref');

        alertify.confirm(
                'Confirmação de Exclusão',
                'Você tem certeza de que quer excluir o registro?',
                function () {
                    window.location.href = $url;
                },
                function () {
                    alertify.error('Cancelado')
                }
        );
    },
    activeMaskDate: function() {
        var $input = $('.mask-date');
        
        if ($input.length > 0) {
            $input.each(function(){
                $input.mask('00/00/0000 00:00');
            });
        }
    },
    activeMaskDateTime: function() {
        var $input = $('.mask-date-time');
        
        if ($input.length > 0) {
            $input.each(function(){
                $input.mask('00/00/0000 00:00');
            });
        }
    },
    activeMaskTime: function() {
        var $input = $('.mask-time');
        
        if ($input.length > 0) {
            $input.each(function(){
                $input.mask('00:00');
            });
        }
    },
    activeMaskPhone: function() {
        var $input = $('.mask-phone-number');
        
        if ($input.length > 0) {
            $input.mask("(99) 9999-9999?9");


            $input.on("blur", function() {
                var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

                if( last.length == 5 ) {
                    var move = $(this).val().substr( $(this).val().indexOf("-") + 1, 1 );

                    var lastfour = last.substr(1,4);

                    var first = $(this).val().substr( 0, 9 );

                    $(this).val( first + move + '-' + lastfour );
                }
            })
        }
    }
};
$(Geral.init);