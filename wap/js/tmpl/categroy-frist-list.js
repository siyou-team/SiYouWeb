$(function ()
{
    var myScroll;
    $("#header").on('click', '.header-inp', function ()
    {
        location.href = WapSiteUrl + '/tmpl/search.html';
    });

    $('#categroy-cnt').on('click', '.category', function ()
    {
        $('.pre-loading').show();
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        var category_id = $(this).attr('date-id');
        $.getJSON(SYS.URL.product.category, {category_id: category_id, recursive:1}, function (result)
        {
            var data = result.data;
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('category-two', data);
            $("#categroy-rgt").html(html);
            $('.pre-loading').hide();
            new IScroll('#categroy-rgt', {mouseWheel: true, click: true});
        }, {timeout: SYS.CACHE_EXPIRE});
        myScroll.scrollToElement(document.querySelector('.categroy-list li:nth-child(' + ($(this).parent().index() + 1) + ')'), 1000);
    });

    $('#categroy-cnt').on('click', '.brand', function ()
    {
        $('.pre-loading').show();
        get_brand_recommend();
    });


    $.getJSON(SYS.URL.product.category, function (result)
    {
        var data = result.data;
        data.WapSiteUrl = WapSiteUrl;
        var html = template.render('category-one', data);
        $("#categroy-cnt").html(html);
        $('.pre-loading').hide();
        myScroll = new IScroll('#categroy-cnt', {mouseWheel: true, click: true});


        $('#categroy-cnt .category:first').trigger('click');
    }, {timeout: SYS.CACHE_EXPIRE});

    //get_brand_recommend();
});

function get_brand_recommend()
{
    $('.category-item').removeClass('selected');
    $('.brand').parent().addClass('selected');
    $.getJSON(SYS.URL.product.brand, function (result)
    {
        var data = result.data;
        data.WapSiteUrl = WapSiteUrl;
        var html = template.render('brand-one', data);
        $("#categroy-rgt").html(html);
        $('.pre-loading').hide();
        new IScroll('#categroy-rgt', {mouseWheel: true, click: true});
    }, {timeout: SYS.CACHE_EXPIRE});
}