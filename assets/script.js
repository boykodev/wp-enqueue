(function($) {
    $(function () {
        $('.wpenq-scripts-wrap').on('click', '.wpenq-remove', function (e) {
            e.preventDefault();
            $(this).closest('.wrap').fadeOut(400, function () {
                $(this).remove()
            });
        });

        $('.wpenq-add-script').on('click', function (e) {
            e.preventDefault();
            var scriptTpl = $('.wpenq-scripts-tpl').html();
            $(scriptTpl).hide().appendTo('.wpenq-scripts-wrap').fadeIn(400);
        })
    });

})(jQuery);