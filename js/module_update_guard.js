(function () {
    'use strict';

    var script = document.currentScript;
    var waitMessage = script ? (script.getAttribute('data-wait-message') || '') : '';

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

    function attachFrameGuard(frame) {
        if (!frame || frame.dataset.tadAdmGuardListener === '1') {
            return;
        }
        frame.dataset.tadAdmGuardListener = '1';
        frame.addEventListener('load', function () {
            bindUpdateForm(frame);
        });
        bindUpdateForm(frame);
    }

    function scanGLightboxFrames() {
        var modal = document.getElementById('glightbox-body');
        if (!modal) {
            return;
        }
        var frames = modal.querySelectorAll('iframe');
        Array.prototype.forEach.call(frames, attachFrameGuard);
    }

    if (typeof window.MutationObserver === 'function') {
        var observer = new window.MutationObserver(function () {
            scanGLightboxFrames();
        });
        var startObserve = function () {
            if (document.body) {
                observer.observe(document.body, { childList: true, subtree: true });
                scanGLightboxFrames();
            }
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', startObserve);
        } else {
            startObserve();
        }
    }
}());
