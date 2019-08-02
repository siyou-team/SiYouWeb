/* Count It Up */
function countUp(a,b,c,d,e,f){for(var g=0,h=["webkit","moz","ms","o"],i=0;i<h.length&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[h[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[h[i]+"CancelAnimationFrame"]||window[h[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(a){var c=(new Date).getTime(),d=Math.max(0,16-(c-g)),e=window.setTimeout(function(){a(c+d)},d);return g=c+d,e}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)}),this.options=f||{useEasing:!0,useGrouping:!0,separator:",",decimal:"."},""==this.options.separator&&(this.options.useGrouping=!1),null==this.options.prefix&&(this.options.prefix=""),null==this.options.suffix&&(this.options.suffix="");var j=this;this.d="string"==typeof a?document.getElementById(a):a,this.startVal=Number(b),this.endVal=Number(c),this.countDown=this.startVal>this.endVal?!0:!1,this.startTime=null,this.timestamp=null,this.remaining=null,this.frameVal=this.startVal,this.rAF=null,this.decimals=Math.max(0,d||0),this.dec=Math.pow(10,this.decimals),this.duration=1e3*e||2e3,this.version=function(){return"1.3.1"},this.printValue=function(a){var b=isNaN(a)?"--":j.formatNumber(a);"INPUT"==j.d.tagName?this.d.value=b:this.d.innerHTML=b},this.easeOutExpo=function(a,b,c,d){return 1024*c*(-Math.pow(2,-10*a/d)+1)/1023+b},this.count=function(a){null===j.startTime&&(j.startTime=a),j.timestamp=a;var b=a-j.startTime;if(j.remaining=j.duration-b,j.options.useEasing)if(j.countDown){var c=j.easeOutExpo(b,0,j.startVal-j.endVal,j.duration);j.frameVal=j.startVal-c}else j.frameVal=j.easeOutExpo(b,j.startVal,j.endVal-j.startVal,j.duration);else if(j.countDown){var c=(j.startVal-j.endVal)*(b/j.duration);j.frameVal=j.startVal-c}else j.frameVal=j.startVal+(j.endVal-j.startVal)*(b/j.duration);j.frameVal=j.countDown?j.frameVal<j.endVal?j.endVal:j.frameVal:j.frameVal>j.endVal?j.endVal:j.frameVal,j.frameVal=Math.round(j.frameVal*j.dec)/j.dec,j.printValue(j.frameVal),b<j.duration?j.rAF=requestAnimationFrame(j.count):null!=j.callback&&j.callback()},this.start=function(a){return j.callback=a,isNaN(j.endVal)||isNaN(j.startVal)?(console.log("countUp error: startVal or endVal is not a number"),j.printValue()):j.rAF=requestAnimationFrame(j.count),!1},this.stop=function(){cancelAnimationFrame(j.rAF)},this.reset=function(){j.startTime=null,j.startVal=b,cancelAnimationFrame(j.rAF),j.printValue(j.startVal)},this.resume=function(){j.stop(),j.startTime=null,j.duration=j.remaining,j.startVal=j.frameVal,requestAnimationFrame(j.count)},this.formatNumber=function(a){a=a.toFixed(j.decimals),a+="";var b,c,d,e;if(b=a.split("."),c=b[0],d=b.length>1?j.options.decimal+b[1]:"",e=/(\d+)(\d{3})/,j.options.useGrouping)for(;e.test(c);)c=c.replace(e,"$1"+j.options.separator+"$2");return j.options.prefix+c+d+j.options.suffix},j.printValue(j.startVal)}


/**
 *	Qianyi Widgets
 *
 **/

;(function($, window, undefined){
	
	"use strict";


})(jQuery, window);


var setupWidgets = function()
{
    // Count Anything
    $("[data-from][data-to]").each(function(i, el)
    {
        var $el = $(el),
            sm = scrollMonitor.create(el);

        sm.fullyEnterViewport(function()
        {
            var opts = {
                    useEasing: 		attrDefault($el, 'easing', true),
                    useGrouping:	attrDefault($el, 'grouping', true),
                    separator: 		attrDefault($el, 'separator', ','),
                    decimal: 		attrDefault($el, 'decimal', '.'),
                    prefix: 		attrDefault($el, 'prefix', ''),
                    suffix:			attrDefault($el, 'suffix', ''),
                },
                $count		= attrDefault($el, 'count', 'this') == 'this' ? $el : $el.find($el.data('count')),
                from        = attrDefault($el, 'from', 0),
                to          = attrDefault($el, 'to', 100),
                duration    = attrDefault($el, 'duration', 2.5),
                delay       = attrDefault($el, 'delay', 0),
                decimals	= new String(to).match(/\.([0-9]+)/) ? new String(to).match(/\.([0-9]+)$/)[1].length : 0,
                counter 	= new countUp($count.get(0), from, to, decimals, duration, opts);

            setTimeout(function(){ counter.start(); }, delay * 1000);

            sm.destroy();
        });
    });


    // Fill Anything
    $("[data-fill-from][data-fill-to]").each(function(i, el)
    {
        var $el = $(el),
            sm = scrollMonitor.create(el);

        sm.fullyEnterViewport(function()
        {
            var fill = {
                    current: 	null,
                    from: 		attrDefault($el, 'fill-from', 0),
                    to: 		attrDefault($el, 'fill-to', 100),
                    property: 	attrDefault($el, 'fill-property', 'width'),
                    unit: 		attrDefault($el, 'fill-unit', '%'),
                },
                opts 		= {
                    current: fill.to, onUpdate: function(){
                        $el.css(fill.property, fill.current + fill.unit);
                    },
                    delay: attrDefault($el, 'delay', 0),
                },
                easing 		= attrDefault($el, 'fill-easing', true),
                duration 	= attrDefault($el, 'fill-duration', 2.5);

            if(easing)
            {
                opts.ease = Sine.easeOut;
            }

            // Set starting point
            fill.current = fill.from;

            TweenMax.to(fill, duration, opts);

            sm.destroy();
        });
    });


    // Todo List
    $(".xe-todo-list").on('change', 'input[type="checkbox"]', function(ev)
    {
        var $cb = $(this),
            $li = $cb.closest('li');

        $li.removeClass('done');

        if($cb.is(':checked'))
        {
            $li.addClass('done');
        }
    });


    $(".xe-status-update").each(function(i, el)
    {
        var $el          	= $(el),
            $nav            = $el.find('.xe-nav a'),
            $status_list    = $el.find('.xe-body li'),
            index           = $status_list.filter('.active').index(),
            auto_switch     = attrDefault($el, 'auto-switch', 0),
            as_interval		= 0;

        if(auto_switch > 0)
        {
            as_interval = setInterval(function()
            {
                goTo(1);

            }, auto_switch * 1000);

            $el.hover(function()
                {
                    window.clearInterval(as_interval);
                },
                function()
                {
                    as_interval = setInterval(function()
                    {
                        goTo(1);

                    }, auto_switch * 1000);;
                });
        }

        function goTo(plus_one)
        {
            index = (index + plus_one) % $status_list.length;

            if(index < 0)
                index = $status_list.length - 1;

            var $to_hide = $status_list.filter('.active'),
                $to_show = $status_list.eq(index);

            $to_hide.removeClass('active');
            $to_show.addClass('active').fadeTo(0,0).fadeTo(320,1);
        }

        $nav.on('click', function(ev)
        {
            ev.preventDefault();

            var plus_one = $(this).hasClass('xe-prev') ? -1 : 1;

            goTo(plus_one);
        });
    });
}


if($('.page-loading-overlay').length)
{
    setTimeout(setupWidgets, 200);
}
else
{
    setupWidgets();
}
