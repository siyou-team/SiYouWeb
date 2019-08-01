$(function(){
    var key = getLocalStorage('ukey');
    var refund_id = getQueryString("refund_id");

    $.getJSON(ApiUrl + '/index.php?act=member_refund&op=get_refund_info', {refund_id:refund_id}, function(result){
            $('#refund-info-div').html(template.render('refund-info-script', result.data));
    });
});