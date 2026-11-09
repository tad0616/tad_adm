(function () {
    'use strict';

    function updateUpgradeDialog() {
        var frame = window.frameElement;
        if (!frame) {
            return;
        }
        var parentJQuery = window.parent.jQuery;
        var fancybox = parentJQuery && parentJQuery.fancybox;
        if (fancybox && fancybox.isOpen && fancybox.current &&
            fancybox.current.type === 'iframe' && fancybox.current.content &&
            fancybox.current.content[0] === frame) {
            fancybox.update();
        }
    }

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
                updateUpgradeDialog();
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
                updateUpgradeDialog();
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
            var stepsElement = document.createElement('div');
            stepsElement.className = 'tad-adm-progress-steps';
            stepsElement.hidden = true;
            var heading = document.createElement('strong');
            heading.textContent = element.getAttribute('data-progress-steps');
            var position = document.createElement('div');
            var bar = document.createElement('progress');
            bar.setAttribute('aria-label', heading.textContent);
            var list = document.createElement('ol');
            stepsElement.appendChild(heading);
            stepsElement.appendChild(position);
            stepsElement.appendChild(bar);
            stepsElement.appendChild(list);
            element.insertAdjacentElement('beforebegin', stepsElement);
            var lastSteps = '';
            var lastCurrent = -1;
            var timerElement = document.createElement('div');
            timerElement.className = 'tad-adm-progress-timer small text-muted mt-2';
            timerElement.setAttribute('role', 'timer');
            element.insertAdjacentElement('afterend', timerElement);

            function setStatus(message) {
                if (element.textContent !== message) {
                    element.textContent = message;
                    stateStartedAt = Date.now();
                    updateUpgradeDialog();
                }
            }

            function renderSteps(steps, current) {
                if (!Array.isArray(steps) || !steps.length ||
                    !steps.every(function (step) { return typeof step === 'string'; }) ||
                    !Number.isInteger(current) || current < 0 || current >= steps.length) {
                    return;
                }
                var serialized = JSON.stringify(steps);
                if (serialized !== lastSteps) {
                    list.textContent = '';
                    steps.forEach(function (step) {
                        var item = document.createElement('li');
                        item.textContent = step;
                        list.appendChild(item);
                    });
                    lastSteps = serialized;
                    lastCurrent = -1;
                }
                if (current !== lastCurrent) {
                    Array.prototype.forEach.call(list.children, function (item, index) {
                        item.className = index < current ? 'completed' : (index === current ? 'current' : '');
                        if (index === current) {
                            item.setAttribute('aria-current', 'step');
                        } else {
                            item.removeAttribute('aria-current');
                        }
                    });
                    var positionText = element.getAttribute('data-progress-position')
                        .replace('%1$s', current + 1).replace('%2$s', steps.length);
                    position.textContent = positionText;
                    bar.max = steps.length;
                    bar.value = current;
                    bar.setAttribute('aria-valuetext', positionText);
                    stepsElement.hidden = false;
                    var currentItem = list.children[current];
                    list.scrollTop = Math.max(0, currentItem.offsetTop - list.offsetTop - list.clientHeight / 2);
                    lastCurrent = current;
                    updateUpgradeDialog();
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
                            renderSteps(result.steps, result.current_step);
                            if (typeof result.max_execution_time === 'number' && result.max_execution_time >= 0 &&
                                result.max_execution_time !== maxExecutionTime) {
                                maxExecutionTime = result.max_execution_time;
                                renderTimer();
                                updateUpgradeDialog();
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
                stepsElement.remove();
                if (request) {
                    request.abort();
                }
            };
        }
    };
}());
