<?php

/**
 * Imagefields plugin for Adminer.
 *
 * @link https://github.com/vlgalik/adminer-imagefields
 * @author Ladislav Galik, https://galik.it
 */

class AdminerImagefields
{
    private $width, $height, $url;

    function __construct($width = 200, $height = 200, $url = false) {
        $this->width = $width;
        $this->height = $height;
        $this->url = $url;
    }

    function head(?bool $dark = null): bool {

        echo sprintf('<script %s>', Adminer\nonce());
        echo sprintf("        
            (function () {
                document.addEventListener('DOMContentLoaded', function (e) {
                    const links = document.querySelectorAll('.scrollable table tbody a');
                    const re = /^.*\.(jpg|jpeg|png|gif)(\?.*)?$/
            
                    for (let i = 0; i < links.length; i++) {
                        if (re.test(links[i].href)) {
                            const img = document.createElement('img');
                            img.src = links[i].href;
                            img.alt = links[i].href;
                            img.style.display = 'block';
                            img.style.maxWidth = '%spx';
                            img.style.maxHeight = '%spx';
            
                            img.addEventListener('load', function (image) {
                                %s
                                links[this].insertBefore(image, links[this].firstChild);
                            }.bind(i, img));
                        }
                    }
                });
            })();
        ", $this->width, $this->height, $this->url ? '' : "links[this].innerHTML = '';");
        echo '</script>';

        return true;
    }
}
