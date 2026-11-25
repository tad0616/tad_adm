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
                var dirname = link.getAttribute('data-dirname') || '';
                var token = link.getAttribute('data-token') || '';
                var frameName = 'tad_adm_del_theme_frame_' + Date.now();
                $.fancybox({
                    content: '<iframe name="' + frameName + '" style="width:100%;height:100%;border:0;"></iframe>',
                    type: 'html',
                    fitToView: true,
                    width: '640',
                    height: '480',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    afterShow: function () {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = 'main.php';
                        form.target = frameName;
                        form.style.display = 'none';
                        var fields = {
                            op: 'delete_theme',
                            dirname: dirname,
                            tad_adm_tpl: 'clean',
                            XOOPS_TOKEN_REQUEST: token
                        };
                        Object.keys(fields).forEach(function (k) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = k;
                            input.value = fields[k];
                            form.appendChild(input);
                        });
                        document.body.appendChild(form);
                        form.submit();
                        document.body.removeChild(form);
                    },
                    afterClose: function () {
                        window.location.reload();
                    }
                });
            }, 0);
        });
    });
})(jQuery);
