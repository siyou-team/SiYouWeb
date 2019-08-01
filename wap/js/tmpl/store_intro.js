$(function() {
    var store_id = getQueryString("store_id");
    var key = getLocalStorage('ukey');

    // 初始化页面
    $.request({
        type: 'post',
        url: SYS.URL.store.info,
        data: {store_id: store_id,action:'intro'},
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            //渲染店铺分类
            var html = template.render('store_intro_tpl', data);
            $("#store_intro").html(html);


            //显示收藏按钮
            if (data.analytics.store_collect) {
                $("#store_notcollect").hide();
                $("#store_collected").show();
            }else{
                $("#store_notcollect").show();
                $("#store_collected").hide();
            }

            $('.store-banner-list').each(function() {
                if ($(this).find('.item').length < 2) {
                    return;
                }

                Swipe(this, {
                    startSlide: 2,
                    speed: 400,
                    auto: 3000,
                    continuous: true,
                    disableScroll: false,
                    stopPropagation: false,
                    callback: function(index, elem) {},
                    transitionEnd: function(index, elem) {}
                });
            });
        }
    });

    //收藏店铺
    $(document).on('click', "#store_notcollect", function() {
        //添加收藏
        var f_result = favoriteStore(store_id);
        if (f_result) {
            $("#store_notcollect").hide();
            $("#store_collected").show();
            var t;
            var favornum = (t = parseInt($("#store_favornum_hide").val())) > 0?t+1:1;
            $('#store_favornum').html(favornum);
            $('#store_favornum_hide').val(favornum);
        }
    });
    //取消店铺收藏
    $(document).on('click',"#store_collected",function() {
        //取消收藏
        var f_result = dropFavoriteStore(store_id);
        if (f_result) {
            $("#store_collected").hide();
            $("#store_notcollect").show();
            var t;
            var favornum = (t = parseInt($("#store_favornum_hide").val())) > 1?t-1:0;
            $('#store_favornum').html(favornum);
            $('#store_favornum_hide').val(favornum);
        }
    });
});
