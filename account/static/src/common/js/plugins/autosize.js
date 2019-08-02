/*!
 Autosize 3.0.15
 license: MIT
 http://www.jacklmoore.com/autosize
 */
(function (global, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['exports', 'module'], factory);
    } else if (typeof exports !== 'undefined' && typeof module !== 'undefined') {
        factory(exports, module);
    } else {
        var mod = {
            exports: {}
        };
        factory(mod.exports, mod);
        global.autosize = mod.exports;
    }
})(this, function (exports, module) {
    'use strict';

    var set = typeof Set === 'function' ? new Set() : (function () {
        var list = [];

        return {
            has: function has(key) {
                return Boolean(list.indexOf(key) > -1);
            },
            add: function add(key) {
                list.push(key);
            },
            'delete': function _delete(key) {
                list.splice(list.indexOf(key), 1);
            } };
    })();

    var createEvent = function createEvent(name) {
        return new Event(name);
    };
    try {
        new Event('test');
    } catch (e) {
        // IE does not support `new Event()`
        createEvent = function (name) {
            var evt = document.createEvent('Event');
            evt.initEvent(name, true, false);
            return evt;
        };
    }

    function assign(ta) {
        var _ref = arguments[1] === undefined ? {} : arguments[1];

        var _ref$setOverflowX = _ref.setOverflowX;
        var setOverflowX = _ref$setOverflowX === undefined ? true : _ref$setOverflowX;
        var _ref$setOverflowY = _ref.setOverflowY;
        var setOverflowY = _ref$setOverflowY === undefined ? true : _ref$setOverflowY;

        if (!ta || !ta.nodeName || ta.nodeName !== 'TEXTAREA' || set.has(ta)) return;

        var heightOffset = null;
        var overflowY = null;
        var clientWidth = ta.clientWidth;

        function init() {
            var style = window.getComputedStyle(ta, null);

            overflowY = style.overflowY;

            if (style.resize === 'vertical') {
                ta.style.resize = 'none';
            } else if (style.resize === 'both') {
                ta.style.resize = 'horizontal';
            }

            if (style.boxSizing === 'content-box') {
                heightOffset = -(parseFloat(style.paddingTop) + parseFloat(style.paddingBottom));
            } else {
                heightOffset = parseFloat(style.borderTopWidth) + parseFloat(style.borderBottomWidth);
            }
            // Fix when a textarea is not on document body and heightOffset is Not a Number
            if (isNaN(heightOffset)) {
                heightOffset = 0;
            }

            update();
        }

        function changeOverflow(value) {
            {
                // Chrome/Safari-specific fix:
                // When the textarea y-overflow is hidden, Chrome/Safari do not reflow the text to account for the space
                // made available by removing the scrollbar. The following forces the necessary text reflow.
                var width = ta.style.width;
                ta.style.width = '0px';
                // Force reflow:
				/* jshint ignore:start */
                ta.offsetWidth;
				/* jshint ignore:end */
                ta.style.width = width;
            }

            overflowY = value;

            if (setOverflowY) {
                ta.style.overflowY = value;
            }

            resize();
        }

        function resize() {
            var htmlTop = window.pageYOffset;
            var bodyTop = document.body.scrollTop;
            var originalHeight = ta.style.height;

            ta.style.height = 'auto';

            var endHeight = ta.scrollHeight + heightOffset;

            if (ta.scrollHeight === 0) {
                // If the scrollHeight is 0, then the element probably has display:none or is detached from the DOM.
                ta.style.height = originalHeight;
                return;
            }

            ta.style.height = endHeight + 'px';

            // used to check if an update is actually necessary on window.resize
            clientWidth = ta.clientWidth;

            // prevents scroll-position jumping
            document.documentElement.scrollTop = htmlTop;
            document.body.scrollTop = bodyTop;
        }

        function update() {
            var startHeight = ta.style.height;

            resize();

            var style = window.getComputedStyle(ta, null);

            if (style.height !== ta.style.height) {
                if (overflowY !== 'visible') {
                    changeOverflow('visible');
                }
            } else {
                if (overflowY !== 'hidden') {
                    changeOverflow('hidden');
                }
            }

            if (startHeight !== ta.style.height) {
                var evt = createEvent('autosize:resized');
                ta.dispatchEvent(evt);
            }
        }

        var pageResize = function pageResize() {
            if (ta.clientWidth !== clientWidth) {
                update();
            }
        };

        var destroy = (function (style) {
            window.removeEventListener('resize', pageResize, false);
            ta.removeEventListener('input', update, false);
            ta.removeEventListener('keyup', update, false);
            ta.removeEventListener('autosize:destroy', destroy, false);
            ta.removeEventListener('autosize:update', update, false);
            set['delete'](ta);

            Object.keys(style).forEach(function (key) {
                ta.style[key] = style[key];
            });
        }).bind(ta, {
            height: ta.style.height,
            resize: ta.style.resize,
            overflowY: ta.style.overflowY,
            overflowX: ta.style.overflowX,
            wordWrap: ta.style.wordWrap });

        ta.addEventListener('autosize:destroy', destroy, false);

        // IE9 does not fire onpropertychange or oninput for deletions,
        // so binding to onkeyup to catch most of those events.
        // There is no way that I know of to detect something like 'cut' in IE9.
        if ('onpropertychange' in ta && 'oninput' in ta) {
            ta.addEventListener('keyup', update, false);
        }

        window.addEventListener('resize', pageResize, false);
        ta.addEventListener('input', update, false);
        ta.addEventListener('autosize:update', update, false);
        set.add(ta);

        if (setOverflowX) {
            ta.style.overflowX = 'hidden';
            ta.style.wordWrap = 'break-word';
        }

        init();
    }

    function destroy(ta) {
        if (!(ta && ta.nodeName && ta.nodeName === 'TEXTAREA')) return;
        var evt = createEvent('autosize:destroy');
        ta.dispatchEvent(evt);
    }

    function update(ta) {
        if (!(ta && ta.nodeName && ta.nodeName === 'TEXTAREA')) return;
        var evt = createEvent('autosize:update');
        ta.dispatchEvent(evt);
    }

    var autosize = null;

    // Do nothing in Node.js environment and IE8 (or lower)
    if (typeof window === 'undefined' || typeof window.getComputedStyle !== 'function') {
        autosize = function (el) {
            return el;
        };
        autosize.destroy = function (el) {
            return el;
        };
        autosize.update = function (el) {
            return el;
        };
    } else {
        autosize = function (el, options) {
            if (el) {
                Array.prototype.forEach.call(el.length ? el : [el], function (x) {
                    return assign(x, options);
                });
            }
            return el;
        };
        autosize.destroy = function (el) {
            if (el) {
                Array.prototype.forEach.call(el.length ? el : [el], destroy);
            }
            return el;
        };
        autosize.update = function (el) {
            if (el) {
                Array.prototype.forEach.call(el.length ? el : [el], update);
            }
            return el;
        };
    }

    module.exports = autosize;
});




/*!
 Autosize v1.18.9 - 2014-05-27
 Automatically adjust textarea height based on user input.
 (c) 2014 Jack Moore - http://www.jacklmoore.com/autosize
 license: http://www.opensource.org/licenses/mit-license.php
 */
(function(e){var t,o={className:"autosizejs",id:"autosizejs",append:"\n",callback:!1,resizeDelay:10,placeholder:!0},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o=window.getComputedStyle?window.getComputedStyle(u,null):!1;o?(t=u.getBoundingClientRect().width,(0===t||"number"!=typeof t)&&(t=parseInt(o.width,10)),e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){t-=parseInt(o[i],10)})):t=p.width(),s.style.width=Math.max(t,0)+"px"}function a(){var a={};if(t=u,s.className=i.className,s.id=i.id,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a).attr("wrap",p.attr("wrap")),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=!u.value&&i.placeholder?(p.attr("placeholder")||"")+i.append:u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width(),y=p.css("resize");p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word"}),"vertical"===y?p.css("resize","none"):"both"===y&&p.css("resize","horizontal"),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);
