var page = pagesize;
var curpage = 1;
var hasMore = true;
var footer = false;
var reset = true;

$(function(){
    if (!ifLogin()){return}


    if (getQueryString('data-state') != '') {
        $('#filtrate_ul').find('li').has('a[data-state="' + getQueryString('data-state')  + '"]').addClass('selected').siblings().removeClass("selected");
    }

    $('#search_btn').click(function(){
        reset = true;
        initPage();
    });


    function initPage(){
        if (reset) {
            curpage = 1;
            hasMore = true;
        }
        $('.loading').remove();
        if (!hasMore) {
            return false;
        }
        hasMore = false;

        var state_type = $('#filtrate_ul').find('.selected').find('a').attr('data-state');

        var orderKey = $('#order_key').val();

        $.request({
            type:'post',
            url: SYS.URL.fx.lists_order,
            data:{ "state_type":state_type, "order_key" : orderKey, "kind_id":1201},
            dataType:'json',
            success:function(result){
                //checkLogin(result.login);//检测是否登录了
                curpage++;
                hasMore = result.hasmore;
                if (!hasMore) {
                    get_footer();
                }
                if (result.data.items.length <= 0) {
                    $('#footer').addClass('posa');
                } else {
                    $('#footer').removeClass('posa');
                }
                var data = result;

                data.WapSiteUrl = WapSiteUrl;//页面地址
                data.ApiUrl = ApiUrl;
                data.key = getLocalStorage('ukey');

                //console.log(data);
                template.helper('$getLocalTime', function (nS) {
                    var d = new Date(parseInt(nS) * 1000);
                    var s = '';
                    s += d.getFullYear() + '年';
                    s += (d.getMonth() + 1) + '月';
                    s += d.getDate() + '日 ';
                    s += d.getHours() + ':';
                    s += d.getMinutes();
                    return s;
                });
                template.helper('p2f', function(s) {
                    return (parseFloat(s) || 0).toFixed(2);
                });
                template.helper('parseInt', function(s) {
                    return parseInt(s);
                });
                var html = template.render('order-list-tmpl', data);
                if (reset) {
                    reset = false;
                    $("#order-list").html(html);
                } else {
                    $("#order-list").append(html);
                }
            }
        });

    }

    $('#filtrate_ul').find('a').click(function(){
        $('#filtrate_ul').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        reset = true;
        window.scrollTo(0,0);
        initPage();
    });

    //初始化页面
    initPage();
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            initPage();
        }
    });
});
function get_footer() {
    if (!footer) {
        footer = true;
        $.request({
            type:'get',
            url: WapSiteUrl+'/js/tmpl/footer.js',
            dataType: "script",
            type:'get',
            cache:true
        });
    }
}