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
            var stateStartedAt = startedAt;
            var receivedStatus = false;
            var maxExecutionTime = null;
            var timerElement = document.createElement('div');
            timerElement.className = 'tad-adm-progress-timer small text-muted mt-2';
            timerElement.setAttribute('role', 'timer');
            element.insertAdjacentElement('afterend', timerElement);

            function setStatus(message) {
                if (element.textContent !== message) {
                    element.textContent = message;
                    stateStartedAt = Date.now();
                }
            }

            function renderTimer() {
                var elapsed = Math.floor((Date.now() - stateStartedAt) / 1000);
                var elapsedText = element.getAttribute('data-progress-elapsed').replace('%s', elapsed);
                var limitText = element.getAttribute('data-progress-limit-unavailable');
                if (maxExecutionTime !== null) {
                    limitText = maxExecutionTime === 0
                        ? element.getAttribute('data-progress-unlimited')
                        : element.getAttribute('data-progress-limit').replace('%s', maxExecutionTime);
                }
                timerElement.textContent = elapsedText + '；' + limitText;
            }

            renderTimer();
            var timerInterval = window.setInterval(renderTimer, 1000);

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
                            if (typeof result.max_execution_time === 'number' && result.max_execution_time >= 0) {
                                maxExecutionTime = result.max_execution_time;
                                renderTimer();
                            }
                            if (typeof result.message === 'string') {
                                setStatus(result.message);
                                receivedStatus = true;
                            } else if (!receivedStatus && Date.now() - startedAt >= 15000) {
                                setStatus(element.getAttribute('data-progress-error'));
                            }
                        } catch (error) {
                            setStatus(element.getAttribute('data-progress-error'));
                        }
                    } else {
                        setStatus(element.getAttribute('data-progress-error'));
                    }
                    timer = window.setTimeout(poll, 800);
                };
                request.onerror = request.ontimeout = function () {
                    if (!stopped) {
                        setStatus(element.getAttribute('data-progress-error'));
                        timer = window.setTimeout(poll, 2000);
                    }
                };
                request.send();
            }
            poll();
            return function () {
                stopped = true;
                window.clearTimeout(timer);
                window.clearInterval(timerInterval);
                timerElement.remove();
                if (request) {
                    request.abort();
                }
            };
        }
    };
}());
