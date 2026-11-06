(function () {
    'use strict';

    window.tadAdmUpgradeProgress = {
        token: function () {
            if (!window.crypto || !window.crypto.getRandomValues) {
                return '';
            }
            var bytes = new Uint8Array(16);
            window.crypto.getRandomValues(bytes);
            return Array.prototype.map.call(bytes, function (value) {
                return ('0' + value.toString(16)).slice(-2);
            }).join('');
        },
        bindSshForm: function (form, content, status, result, uncertain, endpoint, confirmedContent) {
            var submitted = false;
            var stopProgress;
            result.addEventListener('load', function () {
                if (!submitted) {
                    return;
                }
                var confirmed = false;
                var handoffContent;
                try {
                    if (result.contentWindow.location.href === 'about:blank') {
                        return;
                    }
                    confirmed = !!result.contentDocument.getElementById('tad-adm-upgrade-handoff');
                    handoffContent = result.contentDocument.getElementById('tad-adm-upgrade-handoff-content');
                } catch (error) {
                    confirmed = false;
                }
                submitted = false;
                if (confirmed && stopProgress) {
                    stopProgress();
                }
                content.hidden = true;
                status.hidden = confirmed;
                uncertain.hidden = confirmed;
                if (confirmed && handoffContent && confirmedContent) {
                    var copy = handoffContent.cloneNode(true);
                    copy.querySelectorAll('script').forEach(function (script) {
                        script.remove();
                    });
                    confirmedContent.appendChild(copy);
                    confirmedContent.hidden = false;
                    result.hidden = true;
                } else {
                    result.hidden = false;
                }
            });
            form.addEventListener('submit', function (event) {
                if (submitted) {
                    event.preventDefault();
                    return;
                }
                submitted = true;
                form.target = result.name;
                var token = window.tadAdmUpgradeProgress.token();
                form.elements.upgrade_progress_token.value = token;
                content.hidden = true;
                status.hidden = false;
                status.textContent = status.getAttribute(token ? 'data-progress-wait' : 'data-progress-error');
                status.focus();
                form.querySelector('button[type="submit"]').disabled = true;
                if (token) {
                    stopProgress = window.tadAdmUpgradeProgress.start(status, token, endpoint);
                }
            });
        },
        start: function (element, token, endpoint) {
            var stopped = false;
            var timer;
            var request;
            var startedAt = Date.now();
            var receivedStatus = false;
            function poll() {
                request = new XMLHttpRequest();
                request.open('GET', endpoint + '?token=' + encodeURIComponent(token), true);
                request.timeout = 10000;
                request.onload = function () {
                    if (stopped) {
                        return;
                    }
                    if (request.status === 200) {
                        try {
                            var result = JSON.parse(request.responseText);
                            if (typeof result.message === 'string') {
                                element.textContent = result.message;
                                receivedStatus = true;
                            } else if (!receivedStatus && Date.now() - startedAt >= 15000) {
                                element.textContent = element.getAttribute('data-progress-error');
                            }
                        } catch (error) {
                            element.textContent = element.getAttribute('data-progress-error');
                        }
                    } else {
                        element.textContent = element.getAttribute('data-progress-error');
                    }
                    timer = window.setTimeout(poll, 800);
                };
                request.onerror = request.ontimeout = function () {
                    if (!stopped) {
                        element.textContent = element.getAttribute('data-progress-error');
                        timer = window.setTimeout(poll, 2000);
                    }
                };
                request.send();
            }
            poll();
            return function () {
                stopped = true;
                window.clearTimeout(timer);
                if (request) {
                    request.abort();
                }
            };
        }
    };
}());
