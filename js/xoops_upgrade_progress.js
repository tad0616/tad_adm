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
        start: function (element, token, endpoint) {
            var stopped = false;
            var timer;
            var request;
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
