if (!window.console){
    var names = ["log", "debug", "info", "warn", "error", "assert", "dir", "dirxml", "group", "groupEnd", "time", "timeEnd", "count", "trace", "profile", "profileEnd"];

    window.console = {};
    for (var i = 0; i < names.length; ++i)
        window.console[names[i]] = function() {}
}


var vars = vars || {};



//扩展函数,需要放入lib
function __($str)
{
    return $str;
}


function sprintf () {
    var regex = /%%|%(\d+\$)?([\-+'#0 ]*)(\*\d+\$|\*|\d+)?(?:\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g
    var a = arguments
    var i = 0
    var format = a[i++]

    var _pad = function (str, len, chr, leftJustify) {
        if (!chr) {
            chr = ' '
        }
        var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0).join(chr)
        return leftJustify ? str + padding : padding + str
    }

    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = _pad(value, minWidth, customPadChar, leftJustify)
            } else {
                value = [
                    value.slice(0, prefix.length),
                    _pad('', diff, '0', true),
                    value.slice(prefix.length)
                ].join('')
            }
        }
        return value
    }

    var _formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0
        prefix = (prefix && number && {
                '2': '0b',
                '8': '0',
                '16': '0x'
            }[base]) || ''
        value = prefix + _pad(number.toString(base), precision || 0, '0', false)
        return justify(value, prefix, leftJustify, minWidth, zeroPad)
    }

    // _formatString()
    var _formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision !== null && precision !== undefined) {
            value = value.slice(0, precision)
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar)
    }

    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, precision, type) {
        var number, prefix, method, textTransform, value

        if (substring === '%%') {
            return '%'
        }

        // parse flags
        var leftJustify = false
        var positivePrefix = ''
        var zeroPad = false
        var prefixBaseX = false
        var customPadChar = ' '
        var flagsl = flags.length
        var j
        for (j = 0; j < flagsl; j++) {
            switch (flags.charAt(j)) {
                case ' ':
                    positivePrefix = ' '
                    break
                case '+':
                    positivePrefix = '+'
                    break
                case '-':
                    leftJustify = true
                    break
                case "'":
                    customPadChar = flags.charAt(j + 1)
                    break
                case '0':
                    zeroPad = true
                    customPadChar = '0'
                    break
                case '#':
                    prefixBaseX = true
                    break
            }
        }

        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0
        } else if (minWidth === '*') {
            minWidth = +a[i++]
        } else if (minWidth.charAt(0) === '*') {
            minWidth = +a[minWidth.slice(1, -1)]
        } else {
            minWidth = +minWidth
        }

        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth
            leftJustify = true
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite')
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined
        } else if (precision === '*') {
            precision = +a[i++]
        } else if (precision.charAt(0) === '*') {
            precision = +a[precision.slice(1, -1)]
        } else {
            precision = +precision
        }

        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++]

        switch (type) {
            case 's':
                return _formatString(value + '', leftJustify, minWidth, precision, zeroPad, customPadChar)
            case 'c':
                return _formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad)
            case 'b':
                return _formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'o':
                return _formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'x':
                return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'X':
                return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
                    .toUpperCase()
            case 'u':
                return _formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'i':
            case 'd':
                number = +value || 0
                // Plain Math.round doesn't just truncate
                number = Math.round(number - number % 1)
                prefix = number < 0 ? '-' : positivePrefix
                value = prefix + _pad(String(Math.abs(number)), precision, '0', false)
                return justify(value, prefix, leftJustify, minWidth, zeroPad)
            case 'e':
            case 'E':
            case 'f': // @todo: Should handle locales (as per setlocale)
            case 'F':
            case 'g':
            case 'G':
                number = +value
                prefix = number < 0 ? '-' : positivePrefix
                method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())]
                textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2]
                value = prefix + Math.abs(number)[method](precision)
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]()
            default:
                return substring
        }
    }

    return format.replace(regex, doFormat)
}

//说明：paths是插件的实际位置，shim是为了使jquery插件兼容requireJS语法
require.config({
    paths: {
        "select2": "../../common/js/plugins/jquery.select2.min",
        "bxslider": "../../common/js/plugins/jquery.bxslider.min",
        "carousel": "../../common/js/plugins/jquery.owl.carousel.min",
        "countdown": "../../common/js/plugins/jquery.countdown.min",
        "actual": "../../common/js/plugins/jquery.actual.min",
        "fancybox": "../../common/js/plugins/jquery.fancybox-2.1.5",
        "elevatezoom": "../../common/js/plugins/jquery.elevatezoom",
        "pjax": "../../common/js/plugins/jquery.pjax",
        "jquery.ladda": "../../common/js/plugins/jquery.ladda",
        "ladda": "../../common/js/ladda",
        "spin": "../../common/js/spin",
        "lazyload": "../../common/js/plugins/jquery.lazyload",
        "cookie": "../../common/js/plugins/jquery.cookie",

        "jquery": "../../common/js/jquery-1.12.4.min",
        "jquery-ui": "../../common/js/jquery-ui.min",
        "zepto": "../../common/js/zepto",
        "jqueryext": "../../common/js/jquery-ext-re",
        "underscore": "../../common/js/underscore",
        "bootstrap": "../../common/js/bootstrap.min",
        "TweenLite": "../../common/js/TweenLite.min",
        "TweenMax": "../../common/js/TweenMax.min",
        "jquery.hoverIntent": "../../common/js/plugins/jquery.hoverIntent",
        "plupload": "../../common/js/plugins/plupload/plupload.full.min",
        "img-upload": "./img-upload",
        "text": "./text"  //用于requirejs导入html类型的依赖
    },
    shim: {                     //引入没有使用requirejs模块写法的类库。backbone依赖underscore
        'underscore': {
            exports: '_'
        },
        'jquery': {
            exports: '$'
        },
        'zepto': {
            exports: '$'
        },
        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },

        'jqueryext' : ["jquery"],
        'bootstrap' : ["jquery"],
        'elevatezoom' : ["jquery"],
        'plupload' : ["jquery"],
        'carousel' : ["jquery"],
        'fancybox' : ["jquery"],
        'jquery.hoverIntent': ['jquery'],
        'pjax': ['jquery'],
        'lazyload': ['jquery'],
        'cookie': ['jquery'],
        'qianyi-api': ['jquery.hoverIntent'],
        'qianyi-toggles': ['qianyi-api'],
        'img-upload': ['plupload'],

        //'default': ['jquery', 'config', 'jqueryext', "bootstrap", "select2", "bxslider", "carousel", "countdown", "actual", "fancybox", "elevatezoom", 'jquery-ui', 'jquery.ladda', 'pjax', 'lazyload', 'cart']
        'qianyi-custom': ['jquery', 'config', 'jqueryext', "bootstrap", 'jquery.hoverIntent', 'TweenMax', 'pjax', 'lazyload', 'qianyi-api', 'qianyi-toggles', 'img-upload']
    }
});



// Start the main app logic.
//requirejs(['jquery', 'config', 'theme-script'], function($, config, public) {
requirejs(['jquery', 'config'], function($, config, public) {

    console.info(config);

});

define(['jquery', 'qianyi-custom'], function ($){

});
/*
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

}));
*/
