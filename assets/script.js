(function ($) {
    $(function () {
        // remove, up and down functionality
        $('.wpenq-wrap').on('click', '.wpenq-remove', function (e) {
            e.preventDefault();
            $(this).closest('.wrap').fadeOut(400, function () {
                $(this).remove()
            });
        }).on('click', '.wpenq-up', function (e) {
            e.preventDefault();
            var $wrap = $(this).closest('.wrap');
            $wrap.insertBefore($wrap.prev());
        }).on('click', '.wpenq-down', function (e) {
            e.preventDefault();
            var $wrap = $(this).closest('.wrap');
            $wrap.insertAfter($wrap.next());
        });

        // add new script
        $('.wpenq-add-script').on('click', function (e) {
            e.preventDefault();
            var scriptTpl = $('.wpenq-scripts-tpl').html();
            $(scriptTpl).hide().appendTo('.wpenq-scripts-wrap').fadeIn(400);
        });

        // add new style
        $('.wpenq-add-style').on('click', function (e) {
            e.preventDefault();
            var styleTpl = $('.wpenq-styles-tpl').html();
            $(styleTpl).hide().appendTo('.wpenq-styles-wrap').fadeIn(400);
        });
    });

})(jQuery);