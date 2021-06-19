/****
 *
 * jQuery.fn.inc v0.0.1
 * - http://asiamoth.com/mt/archives/2009-01/17_0034.php
 *
 * Copyright (c) 2009 asiamoth
 * - http://asiamoth.com/
 * - asiamoth(at)gmail.com
 *
 * Licensed under the MIT licenses.
 * - http://www.opensource.org/licenses/mit-license.php
 * - http://sourceforge.jp/projects/opensource/wiki/licenses%2FMIT_license
 *
 * Date: 2009-01-15T20:31:15+09:00
 * Revision: 0001
 *
 ****/

/****
 *
 * usage:
 *   $({target}).inc({ url: {url}, selector: {selector}, option: {(child|replace)} });
 *   $('div.jquery_inc').inc({url: 'jquery_inc.html', selector: 'dd.recommended', option: 'child'});
 *   $('div.jquery_inc').inc();  //=> default settings.
 *
 ****/

/****
 * Original scripts:
 ****

 ****
 *
 * jQuery_inc.js
 *
 * Copyright (c) 2008 Tomohiro Okuwaki (http://www.tinybeans.net/blog/)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Modified: 2008-11-10
 * Document: http://www.tinybeans.net/blog/2008/11/10-173717.html
 *
 ****

 ****
 *
 * inc v5
 *
 * A super-tiny client-side include JavaScript jQuery plugin
 *
 * <http://johannburkard.de/blog/programming/javascript/inc-a-super-tiny-client-side-include-javascript-jquery-plugin.html>
 *
 * MIT license.
 *
 * Johann Burkard
 * <http://johannburkard.de>
 * <mailto:jb@eaio.com>
 *
 ****/

/****
 *
 * http://www.jslint.com/
 * [Goog Parts] <= Click!
 *
 ****/

/*jslint browser: true */
/*global jQuery, $ */
/*members ajax, browser, cache, clone, extend, find, fn, html, inc, load,
    match, msie, option, replace, replaceWith, selector, split, url
 */


(function () {

    jQuery.fn.inc = function (config) {
        var inc_url, inc_selector, replace_inc, file_inc, child_inc,
        matchStr, matchStr2,
        strRef = function strRef(text) {
            text = text.replace(/&amp;/g, '&');
            text = text.replace(/&lt;/g, '<');
            text = text.replace(/&gt;/g, '>');
            text = text.replace(/&quot;/g, '"');
            return text;
        };

        // Default values.
        config = jQuery.extend({
            url: 'jquery_inc.html',
            selector: '.jquery_inc',
            option: ''
        }, config);

        inc_url = strRef(config.url);
        inc_selector = config.selector;

        switch (config.option) {
        case 'child':
            child_inc = true;
            break;
        case 'replace':
            replace_inc = true;
            break;
        default:
            break;
        }

        if (jQuery.browser.msie) {
            /* for IE [start] */
            if (file_inc) {
                inc_selector = inc_selector.replace(/ ?/, ':');
                inc_selector = inc_selector.split(':');
                inc_url = inc_selector[0];
                inc_selector = inc_selector[1];
            }
            if (child_inc) {
                matchStr = inc_url.match(' ');
                if (matchStr) {
                    inc_selector = inc_selector + '>*';
                }
            }
            jQuery.ajax({cache: false});
            if (replace_inc) {
                jQuery(this).load(
                    inc_url,
                    function () {
                        var default_content, inc_content;
                        default_content = jQuery(this).clone();
                        inc_content = default_content.find(inc_selector);
                        jQuery(this).replaceWith(inc_content);
                    }
                    );
            } else {
                jQuery(this).load(
                    inc_url,
                    function () {
                        var default_content, inc_content;
                        default_content = jQuery(this).clone();
                        inc_content = default_content.find(inc_selector);
                        jQuery(this).html(inc_content);
                    }
                    );
            }
            /* for IE [ end ] */
        } else {
            if (file_inc) {
                inc_url = inc_selector;
            } else {
                inc_url = inc_url + ' ' + inc_selector;
            }
            if (child_inc) {
                matchStr2 = inc_url.match(' ');
                if (matchStr2) {
                    inc_url = inc_url + '>*';
                }
            }
            jQuery.ajax({cache: false});
            if (replace_inc) {
                jQuery(this).load(
                    inc_url,
                    function () {
                        var default_content, inc_content;
                        default_content = jQuery(this).clone();
                        inc_content = default_content.html();
                        jQuery(this).replaceWith(inc_content);
                    }
                    );
            } else {
                jQuery(this).load(inc_url);
            }
        }

    };

})(jQuery);