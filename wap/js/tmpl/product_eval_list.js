var item_id = getQueryString("item_id");
$(function(){

    //渲染list
    var load_class = new ssScrollLoad();
    load_class.loadInit({
        'url':SYS.URL.product.product_comment,
        'getparam':{item_id:item_id},
        'tmplid':'product_ecaluation_script',
        'containerobj':$("#product_evaluation_html"),
        'iIntervalId':true,
        callback:function(){
            callback();
        }
        });

    $('#goodsDetail').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_detail.html?item_id=' + item_id;
    });
    $('#goodsBody').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_info.html?item_id=' + item_id;
    });
    $('#goodsEvaluation').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_eval_list.html?item_id=' + item_id;
    });
    
    $('.sstouch-tag-nav').find('a').click(function(){
        var type = $(this).attr('data-state');
        load_class.loadInit({
            url:SYS.URL.product.product_comment,
            getparam:{item_id:item_id,comment_type:type},
            tmplid:'product_ecaluation_script',
            containerobj:$("#product_evaluation_html"),
            iIntervalId:true,
            callback:function(){
                callback();
            }
            });
        $(this).parent().addClass('selected').siblings().removeClass('selected');
    });

});

function callback(){
    $('.goods_geval').on('click', 'a', function(){
        var _this = $(this).parents('.goods_geval');
        _this.find('.sstouch-bigimg-layout').removeClass('hide');
        var picBox = _this.find('.pic-box');
        _this.find('.close').click(function(){
            _this.find('.sstouch-bigimg-layout').addClass('hide');
        });
        if (picBox.find('li').length < 2) {
            return;
        }
        Swipe(picBox[0], {
            speed: 400,
            auto: 3000,
            continuous: false,
            disableScroll: false,
            stopPropagation: false,
            callback: function(index, elem) {
                $(elem).parents('.sstouch-bigimg-layout').find('div').last().find('li').eq(index).addClass('cur').siblings().removeClass('cur');
            },
            transitionEnd: function(index, elem) {}
        });
    });
}
