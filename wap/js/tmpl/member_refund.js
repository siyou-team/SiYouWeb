$(function(){
    var key = getLocalStorage('ukey');
    //渲染list
    var load_class = new ssScrollLoad();
    load_class.loadInit({
        'url':ApiUrl + '/index.php?act=member_refund&op=get_refund_list',
        'getparam':{},
        'tmplid':'refund-list-tmpl',
        'containerobj':$("#refund-list"),
        'iIntervalId':true,
        'data':{WapSiteUrl:WapSiteUrl}
    });
});