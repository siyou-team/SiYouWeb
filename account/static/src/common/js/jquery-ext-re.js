if (!window.console){
    var names = ["log", "debug", "info", "warn", "error", "assert", "dir", "dirxml", "group", "groupEnd", "time", "timeEnd", "count", "trace", "profile", "profileEnd"];

    window.console = {};
    for (var i = 0; i < names.length; ++i)
        window.console[names[i]] = function() {}
}



var vars = vars || {};
var G = G || {};

var Public = Public || {};

Public.showErrorModal = function ($msg, $title)
{
    swal({
        title: typeof $title == "undefined" ? '' : $title,
        text: $msg,
        confirmButtonText: "确定"
    });
}

Public.showInfoModal = function ($msg, $title)
{
    swal({
        title: typeof $title == "undefined" ? '' : $title,
        text: $msg,
        confirmButtonText: "确定"
    });
}



Public.tipMsg = function (msg, callback)
{
    var tpl =  '<div class="buy-box">\
                            <div class="row">\
                                <div class="buy-succ-box clearfix">\
                                    <div class="goods-content  col-xs-12" id="J_goodsBox">  <div class="text-center"> <span class="name h3"> %s  </span>     </div></div>\
                                    <div class="actions J_actBox  col-xs-12  text-center">\
                                        <p class="hide J_notic"></p>';
    if (typeof callback === 'function')
    {
        tpl +=  '<a href="javascript:$.fancybox.close();" class="btn btn-line-gray J_goBack " data-fancybox-close>取消</a>'
        tpl +=  '<a href="javascript:void(0);" class="btn btn-primary fancybox-item fancybox-confirm ">确定</a>'
    }
    else {

        tpl +=  '<a href="javascript:$.fancybox.close();" class="btn btn-primary fancybox-item J_goBack " data-fancybox-close>确定</a>'
    }
    tpl +=  '</div>\
                                </div>\
                            </div>\
                        </div>';

    $.fancybox.open(sprintf(tpl, msg), {
        beforeShow: function () {
        },
        afterShow: function () {

        },
        afterClose: function () {
        }
    });

    $(".fancybox-confirm").on("click", function (event) {
        typeof callback === 'function' && callback();
        $.fancybox.close();
    });
}



;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define([ "jquery" ], factory);
    } else {
        // 全局模式
        factory(jQuery);
    }
}(function ($) {

    /*
     //扩展对象方法
     $.fn.extend({
     //为对象新增ajaxPost方法
     request: function (ajaxOpts)
     {
     var $this = $(this);
     var loading;
     var myTimer;
     var preventTooFast = 'ui-btn-dis';


     var opts = {
     type: "POST",
     dataType: "json",
     timeout: 20000,

     beforeSend: function ()
     {
     $this.addClass(preventTooFast);
     myTimer = setTimeout(function ()
     {
     $this.removeClass(preventTooFast);
     }, 2000)

     loading = $.dialog.tips('提交中，请稍候...', 1000, 'loading.gif', true);
     },

     complete: function ()
     {
     loading.close();
     },

     success: function (data, status)
     {
     },

     error: function (err, status)
     {
     parent.Public.tips({type: 2, content: '操作无法成功，请稍后重试！'});
     }
     };

     $.extend(true, opts, ajaxOpts);

     var successCallback = opts.success;
     var errorCallback = opts.error;

     opts.success = function (data, status)
     {
     successCallback && successCallback(data, status);
     }

     opts.error = function (data, status)
     {
     errorCallback && errorCallback(data, status);
     }

     if ($this.hasClass(preventTooFast))
     {
     return;
     }

     $.ajax(opts);
     }
     });
     */


    //扩展对象方法
    $.extend({
        //为对象新增ajaxPost方法
        request: function (ajaxOpts)
        {
            var opts = {
                type: "POST",
                dataType: "json",
                timeout: 50000,
                loading: true,
                data: {typ:'json'},
                success: function (data, status)
                {
                },

                error: function (err, status)
                {
                    Public.tipMsg('操作无法成功，请稍后重试！');
                }
            };

            $.extend(true, opts, ajaxOpts);

            if (opts.loading)
            {    //loading
                //var $this = $(this);
                var loading;
                //var myTimer;
                //var preventTooFast = 'ui-btn-dis';

                $.extend(true, opts, {
                    beforeSend : function(){
                        //loading = $.dialog.tips('提交中，请稍候...', 1000, 'loading.gif', true);
                    },
                    complete : function(){
                        //loading.close();
                    }
                });

                /*
                 if ($this.hasClass(preventTooFast))
                 {
                 return;
                 }
                 */
            }


            var successCallback = opts.success;
            var errorCallback = opts.error;

            opts.success = function (data, status)
            {
                /*
                if (data.status == 250 && data.code == 30)
                {
                    $.fancybox.open({
                                        href  : SYS.URL.login_box,
                                        type : 'iframe',
                                        width:650,
                                        fitToView: true,
                                        opts : {
                                            afterShow : function( instance, current ) {
                                                console.info( 'done!' );
                                            }
                                        }
                                    });
                }
                else
                {
                }
                */
                
                /*if(data.status != 200){
                 var defaultPage = Public.getDefaultPage();
                 var msg = data.msg || '出错了=. =||| ,请点击这里拷贝错误信息 :)';
                 var errorStr = msg;
                 if(data.data.error){
                 var errorStr = '<a id="myText" href="javascript:window.clipboardData.setData("Text",data.error);alert("详细信息已经复制到剪切板，请拷贝给管理员！");"'+msg+'</a>'
                 }
                 defaultPage.Public.tips({type:1, content:errorStr});
                 return;
                 }*/
                successCallback && successCallback(data, status);
            }

            opts.error = function(err,ms){
                var content = '服务端响应错误！'
                if(ms === 'timeout'){
                    content = '请求超时！';
                }

                Public.tipMsg(content);
                errorCallback && errorCallback(err);
            }

            $.ajax(opts);
        }
    });



    $.extend({
        //为对象新增ajaxPost方法
        send: function (url, data, callback, type)
        {
            // shift arguments if data argument was omitted
            if ( jQuery.isFunction( data ) ) {
                type = type || callback;
                callback = data;
                data = undefined;
            }

            // The url can be an options object (which then must have .url)
            return $.request( jQuery.extend( {
                url: url,
                type: 'post',
                dataType: type,
                data: data,
                loading: false,
                success: callback
            }, jQuery.isPlainObject( url ) && url ) );
        }
    });


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

    (function ($) {
        $.getUrlParam = function (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
    })(jQuery);

    //函数扩展
    var bytesToSize = function(bytes) {
        if (bytes === 0) return '0 B';
        var k = 1000, // or 1024
            sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
            i = Math.floor(Math.log(bytes) / Math.log(k));
        return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
    }

    return {
        bytesToSize: bytesToSize
    };


}));



(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);


if (!window.console || !console.info)
{
    var names = ["log", "debug", "info", "warn", "error", "assert", "dir", "dirxml",
        "group", "groupEnd", "time", "timeEnd", "count", "trace", "profile", "profileEnd"];

    window.console = new Debug();

    for (var i = 0; i < names.length; ++i)
        window.console[names[i]] = function() {}
}

var Translate = {
    _:function(str)
    {
        if (Object.isUndefined(G[str]))
        {
            return str
        }
        else
        {
            return G[str];
        }

    },

    gettext:function(str)
    {
        if (Object.isUndefined(G[str]))
        {
            return str
        }
        else
        {
            return G[str];
        }

    }
};

function L() { return Translate.gettext.apply(this,arguments); }
function __() { return Translate.gettext.apply(this,arguments); }




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
