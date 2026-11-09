(function () {
    'use strict';

    var script = document.currentScript;
    var waitMessage = script.getAttribute('data-wait-message');

    function bindUpdateForm(frame) {
        var doc;
        try {
            doc = frame.contentDocument;
        } catch (error) {
            if (error.name !== 'SecurityError') {
                throw error;
            }
            return;
        }
        if (!doc) {
            return;
        }
        var forms = doc.querySelectorAll('form');
        Array.prototype.forEach.call(forms, function (form) {
            var operation = form.querySelector('input[name="op"]');
            var functionField = form.querySelector('input[name="fct"]');
            var button = form.querySelector('[name="confirm_submit"][type="submit"]');
            var action = new URL(form.action, doc.location.href);
            if (!operation || operation.value !== 'update_ok' ||
                !functionField || functionField.value !== 'modulesadmin' ||
                !button || action.origin !== window.location.origin ||
                !/\/modules\/system\/admin\.php$/.test(action.pathname) ||
                form.dataset.tadAdmUpdateGuard) {
                return;
            }
            form.dataset.tadAdmUpdateGuard = '1';
            var submitted = false;
            var originalLabel = button.tagName === 'INPUT' ? button.value : button.innerHTML;
            doc.defaultView.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    submitted = false;
                    button.disabled = false;
                    if (button.tagName === 'INPUT') {
                        button.value = originalLabel;
                    } else {
                        button.innerHTML = originalLabel;
                    }
                }
            });
            form.addEventListener('submit', function (event) {
                if (submitted) {
                    event.preventDefault();
                    return;
                }
                if (event.defaultPrevented) {
                    return;
                }
                submitted = true;
                window.setTimeout(function () {
                    if (event.defaultPrevented) {
                        submitted = false;
                        return;
                    }
                    button.disabled = true;
                    if (button.tagName === 'INPUT') {
                        button.value = waitMessage;
                    } else {
                        button.textContent = waitMessage;
                    }
                }, 0);
            });
        });
    }

    jQuery(document).on('afterShow.tadAdmModuleUpdateGuard', function () {
        var current = jQuery.fancybox.current;
        if (!current || current.type !== 'iframe' || !current.content || !current.content[0]) {
            return;
        }
        var frame = current.content[0];
        frame.addEventListener('load', function () {
            bindUpdateForm(frame);
        });
        bindUpdateForm(frame);
    });
}());
