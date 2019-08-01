var key = getLocalStorage("ukey");
var myPoints = 0;
var myLevel = 0;

var rows = 6;
var page = 1;
var hasmore = true;

//获取列表
function get_list() {
    $('.loading').remove();
    if (!hasmore) {
        return false;
    }
    hasmore = false;
    var param = {};
    param.page = page;
    param.rows = rows;

    $.ajax({
        url: SYS.URL.point.product,
        data: param,
        dataType: 'json',
        success : function(result){
            if(!result && result.status == 250) {
                result = [];
                result.datas = [];
                result.datas.pointprod_list = [];
            }
            $('.loading').remove();
            page++;
            var html = template.render('pgoods_body', result);
            $(".integral-part").append(html);
            hasmore = result.total >result.page ? true : false;
        }
    });
}


$(function(){
    if (true) {
        $("#page_diy_contents").load('./diy.html',function(){
            var page_id = 2001;
            loadSpecial(page_id);

            $("#page_diy_contents").show();

            //
            get_list();

        });
    }
});