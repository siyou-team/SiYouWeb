/**
 * all shop qianyistore v4.2
 */

template.helper("distance", function (distance) {
    return Math.round(distance/1000).toFixed(2);
});




$(function ()
{
    var keyword = decodeURIComponent(getQueryString("keyword"));
    if (keyword != "")
    {
        $("#keyword").val(keyword);
    }
    

    $("input[name=store_category_id]").val(getQueryString('store_category_id'));
    $(".page-warp").click(function ()
    {
        $(this).find(".pagew-size").toggle();
    });

    get_store();


    function get_store()
    {   
        var data = {};
        data['store_category_id'] = $("input[name=store_category_id]").val();
        data['keyword'] = $("#keyword").val();
        data['district_info'] = $("#district_info").val();
        data['coordinate'] = window.coordinate;
       
        //渲染list
        var load_class = new ssScrollLoad();
        load_class.loadInit({'url':SYS.URL.supplier.store,'getparam':data,'tmplid':'category-one','containerobj':$("#categroy-cnt"),'iIntervalId':true});

        return;

        $.request({
            url: SYS.URL.supplier.store,
            data: data,
            type: 'get',
            dataType: 'json',
            success: function (result)
            {
                $("input[name=hasmore]").val(result.hasmore);
                if (!result.hasmore)
                {
                    $('.next-page').addClass('disabled');
                }

                var curpage = $("input[name=curpage]").val();//分页
                var page_total = result.data.total;
                var page_html = '';
                for (var i = 1; i <= result.data.total; i++)
                {
                    if (i == curpage)
                    {
                        page_html += '<option value="' + i + '" selected>' + i + '</option>';
                    }
                    else
                    {
                        page_html += '<option value="' + i + '">' + i + '</option>';
                    }
                }

                $('select[name=page_list]').empty();
                $('select[name=page_list]').append(page_html);

                var html = template.render('category-one', result.data);
                $("#categroy-cnt").append(html);

                $(window).scrollTop(0);
            }
        });
    }


    var data = {}

    data['page'] = 1;
    data['rows'] = pagesize;


    $('#serach_store').click(function ()
    {
        get_store(data);
        return;

        var keyword = encodeURIComponent($('#keyword').val());
        var district_info = encodeURIComponent($('#district_info').val());
        var store_category_id = encodeURIComponent($('#store_category_id').val());
        location.href = WapSiteUrl + '/shop.html?keyword=' + keyword + '&district_info=' + district_info + '&store_category_id=' + store_category_id;
    });
});