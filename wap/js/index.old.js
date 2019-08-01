
$(function() {

    //if (!ifLogin()){return}

    var headerClone = $('#header').clone();
    $(window).scroll(function(){
        if ($(window).scrollTop() <= $('#main-container1').height()) {
        /*if ($(window).scrollTop() <= '50') {*/
            headerClone = $('#header').clone();
            $('#header').remove();
            headerClone.addClass('transparent').removeClass('');
            headerClone.prependTo('.sstouch-home-top');
        } else {
            headerClone = $('#header').clone();
            $('#header').remove();
            headerClone.addClass('').removeClass('transparent');
            headerClone.prependTo('body');
        }
    });

    if (false)
    {
        $('.logo').addClass('chose-city');
        $('.header-inp').addClass('chose-city');

        $('#subsite_dev').removeClass('hide');
    }
    else
    {
        //logo
        $('.logo').css("background-image", "url(" + WapSiteLogo + ")");
    }

    $.request({
        url: SYS.URL.index,
        type: 'get',
        dataType: 'json',

        // ajaxCache: {
        //     cacheValidate: function (res, options) {
        //         return res.status === 200;
        //     },

        //     timeout: SYS.CACHE_EXPIRE
        // },

        success: function(result) {
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
                        case 'home5':
                            vv.square_url = buildUrl(vv.square_type, vv.square_data);
                            vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                            vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                            vv.rectangle3_url = buildUrl(vv.rectangle3_type, vv.rectangle3_data);
                            break;
                        case 'entrance':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                                vv.item[k3].image = v3.image;
                                vv.item[k3].name = v3.name;
                            });
                            break;
                    }


                    if (k == 0) {
                        $("#main-container1").html(template.render(kk, vv));
                    } else {
                        // if ('entrance' == kk)
                        // {
                        //     $("#entrance_container").html(template.render(kk, vv));
                        // }
                        // else
                        // {
                        //     $("#entrance_container").removeClass('hide');
                        //     html += template.render(kk, vv);
                        // }
                    }
                    return false;
                });
            });

            $("#main-container2").html(html);
            var mySwiper = new Swiper ('.swiper-container', {
                direction: 'horizontal',
                loop: true,
                autoplay: 5000,
                slidesPerView: "auto",
                centeredSlides:true,
                spaceBetween: 15    ,
            })

            var suggesition = result.data.suggesition;
            if( suggesition.length > 0 ){
               
                var apx = new Vue({
                    el     : '#app',
                    data(){
                        return{
                            suggesition
                        }
                    }
                });
                 var ele = $(".suggest");
                ele.width((ele.find("li").length + 1) * (ele.find("li").width()+20));
                var myScroll = new IScroll('#app', {eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false});
            }

            var topdeals = result.data.topdeals;
            if( topdeals ){
                var top = new Vue({
                    el     : '#topd',
                    data(){
                        return{
                            topdeals
                        }
                    }
                });
                 var ele = $(".top-deals");
                ele.width((ele.find("li").length + 1) * (ele.find("li").width()+20));
                var myScroll = new IScroll('#topd', {eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false});
            }
        }
    });
    $('.plantform-notice-body').hide();
});

