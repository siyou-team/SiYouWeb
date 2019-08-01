$(function(){
    var page_id = getQueryString('page_id');
    if (page_id)
    {
        loadSpecial(page_id);
    }
})

function loadSpecial(page_id){
    $.request({
        url: SYS.URL.page,
        data: {page_id: page_id},
        type: 'post',
        dataType: 'json',
        ajaxCache: {
            cacheValidate: function (res, options) {
                return res.status === 200;
            },

            timeout: SYS.CACHE_EXPIRE
        },
        success: function(result) {
            if (result.data.page_name)
            {
                $('title,h1').html(result.data.page_name);
            }
            var data = result.data.items;
            var html = '';

            $.each(data, function(k, v) {
                $.each(v, function(kk, vv) {
                    switch (kk) {
                        case 'adv_list':
                        case 'swipe_list':
                        case 'home3':
                        case 'item3':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                            });
                            break;

                        case 'home1':
                            vv.url = buildUrl(vv.type, vv.data);
                            break;

                        case 'home2':
                        case 'home4':
                            vv.square_url = buildUrl(vv.square_type, vv.square_data);
                            vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                            vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                            break;
                        case 'entrance':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                                vv.item[k3].image = v3.image;
                                vv.item[k3].name = v3.name;
                            });
                            break;
                    }
                    html += template.render(kk, vv);
                    return false;
                });
            });

            $("#main-container").html(html);

            $('.adv_list, .swipe-container').each(function() {
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

}
