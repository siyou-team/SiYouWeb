var page = pagesize;
var curpage = 1;
var hasmore = true;
var footer = false;
var firstRow = 0;
$(function ()
{      
    get_list();
    $(window).scroll(function ()
    {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1)
        {
            get_list()
        }
    });
});
//获取砍价列表
function get_list()
{
    $(".loading").remove();
    if (!hasmore)
    {
        return false
    }
    hasmore = false;
    param = {};
    param.rows     = page;
    param.page     = curpage;
    param.firstRow = firstRow;
    $.request({
        url    : SYS.URL.user.homeCutPriceActivity,
        data   : param,
        success: function (e)
        {   
            if( e.status == 200 ){
                curpage++; 
                var r = template.render("cutprice_main", e);
                $("#cutprice_list").append(r);

                if(e.data.page < e.data.total)
                {
                    firstRow = e.data.page*pagesize;
                    hasmore = true;
                }
                else
                {
                   hasmore = false;
                }
            }
            
        }
    });
}
