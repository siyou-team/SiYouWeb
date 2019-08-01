

function getSearchHistory(refresh)
{
    if (typeof refresh == 'undefined')
    {
        refresh = false
    }

    $.getJSON(SYS.URL.search_hot_info, function(result) {

        var data = {};
        data.WapSiteUrl = WapSiteUrl;
        data.hot_list = result.data.search_hot_words;
        data.search_his_list = result.data.search_history_words;



        $('#hot_list_container').html(template.render('hot_list',data));
        $('#search_his_list_container').html(template.render('search_his_list',data));
    })

}


$(function(){
    Array.prototype.unique = function()
    {
        var n = [];
        for(var i = 0; i < this.length; i++)
        {
            if (n.indexOf(this[i]) == -1) n.push(this[i]);
        }
        return n;
    }
    var keyword = decodeURIComponent(getQueryString('keyword'));
    if (keyword) {
        $('#keyword').val(keyword);writeClear($('#keyword'));
    }
    $('#keyword').on('input',function(){
        var value = $.trim($('#keyword').val());
        if (value == '') {
            $('#search_tip_list_container').hide();
        } else {
            $.getJSON(SYS.URL.product.auto_complete,{term:$('#keyword').val()}, function(result) {
                if (result.status==200) {
                    var data = result.data;
                    data.WapSiteUrl = WapSiteUrl;
                    if (data.list.length > 0) {
                        $('#search_tip_list_container').html(template.render('search_tip_list_script',data)).show();
                    } else {
                        $('#search_tip_list_container').hide();
                    }
                }
            })
        }
    });

    $('.input-del').click(function(){
        $(this).parent().removeClass('write').find('input').val('');
    });

    template.helper('$buildUrl',buildUrl);

    getSearchHistory();

    $('#header-nav').click(function(){
        if ($('#keyword').val() == '') {
            window.location.href = buildUrl('keyword',getLocalStorage('deft_key_value') ? getLocalStorage('deft_key_value') : '');
        } else {
            window.location.href = buildUrl('keyword',$('#keyword').val());
        }
    });
});