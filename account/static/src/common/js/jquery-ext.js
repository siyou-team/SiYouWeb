

//jquery 方法自定义扩展
//判断:当前元素是否是被筛选元素的子元素
$.fn.isChildOf = function(b){
    return (this.parents(b).length > 0);
};

//判断:当前元素是否是被筛选元素的子元素或者本身
$.fn.isChildAndSelfOf = function(b){
    return (this.closest(b).length > 0);
};

//数字输入框
$.fn.digital = function() {
    this.each(function(){
        $(this).keyup(function() {
            this.value = this.value.replace(/\D/g,'');
        })
    });
};


$.fn.json = $.fn.serializeJSON = $.fn.serializeJson = $.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};


$.extend({
    getUrlVars: function () {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    },
    getUrlVar: function (name) {
        return $.getUrlVars()[name];
    }
});






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

    function get_ext(filename){
        var index1=filename.lastIndexOf(".");

        var index2=filename.length;
        var postf=filename.substring(index1,index2);//后缀名

        return postf;
    }


    function image_thumb(image_url, w, h) {
        if ('undefined' == typeof w) {
            w = 60;
        }

        if ('undefined' == typeof h) {
            h = 60;
        }


        $ext = get_ext(image_url);
        image_url = sprintf('%s!%sx%s%s', image_url, w, h, $ext);

        return image_url;
    }



//
/*
 This function will be called in the event when browser breakpoint changes
 */

var public_vars = public_vars || {};

jQuery.extend(public_vars, {

    breakpoints: {
        largescreen: 	[991, -1],
        tabletscreen: 	[768, 990],
        devicescreen: 	[420, 767],
        sdevicescreen:	[0, 419]
    },

    lastBreakpoint: null
});


/* Main Function that will be called each time when the screen breakpoint changes */
function resizable(breakpoint)
{
    var sb_with_animation;

    // Large Screen Specific Script
    if(is('largescreen'))
    {
    }


    // Tablet or larger screen
    if(ismdxl())
    {
    }


    // Tablet Screen Specific Script
    if(is('tabletscreen'))
    {
    }


    // Tablet device screen
    if(is('tabletscreen'))
    {
        public_vars.$sidebarMenu.addClass('collapsed');
        ps_destroy();
    }


    // Tablet Screen Specific Script
    if(isxs())
    {
    }


    // Trigger Event
    jQuery(window).trigger('qianyi.resize');
}



/* Functions  */
/* 窗口函数  */

// Get current breakpoint
function get_current_breakpoint()
{
    var width = jQuery(window).width(),
        breakpoints = public_vars.breakpoints;

    for(var breakpont_label in breakpoints)
    {
        var bp_arr = breakpoints[breakpont_label],
            min = bp_arr[0],
            max = bp_arr[1];

        if(max == -1)
            max = width;

        if(min <= width && max >= width)
        {
            return breakpont_label;
        }
    }

    return null;
}


// Check current screen breakpoint
function is(screen_label)
{
    return get_current_breakpoint() == screen_label;
}


// Is xs device
function isxs()
{
    return is('devicescreen') || is('sdevicescreen');
}

// Is md or xl
function ismdxl()
{
    return is('tabletscreen') || is('largescreen');
}


// Trigger Resizable Function
function trigger_resizable()
{
    if(public_vars.lastBreakpoint != get_current_breakpoint())
    {
        public_vars.lastBreakpoint = get_current_breakpoint();
        resizable(public_vars.lastBreakpoint);
    }


    // Trigger Event (Repeated)
    jQuery(window).trigger('qianyi.resized');
}