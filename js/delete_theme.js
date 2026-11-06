(function ($) {
    $(document).on('click', 'a.delete-theme', function (event) {
        event.preventDefault();
        var link = this;
        swal({
            title: link.getAttribute('data-confirm-title'),
            text: link.getAttribute('data-confirm-text'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: link.getAttribute('data-confirm-button'),
            closeOnConfirm: true,
            allowOutsideClick: true
        }, function (confirmed) {
            if (!confirmed) {
                return;
            }
            window.setTimeout(function () {
                link.blur();
                $.fancybox({
                    href: link.href,
                    type: 'iframe',
                    fitToView: true,
                    width: '640',
                    height: '480',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    afterClose: function () {
                        window.location.reload();
                    }
                });
            }, 0);
        });
    });
})(jQuery);
