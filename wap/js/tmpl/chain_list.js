$(function(){
    var key = getLocalStorage('ukey');
    if (!key) {
        window.location.href = '../member/login.html';
    }else{
        $.request({
            type:'post',
            url: SYS.CONFIG.index_url+'?ctl=Store&met=chainLists&typ=json',
            data:{},
            dataType:'json',
            success:function(result){
                if(result.status==200){
                    //没有门店的直接去店铺页面
                    
                    if(result.data.items.length == 0){

                        location.href='./seller.html';
                        return false;
                    }else{
                        var html = template.render('chain_list_tmp', result.data);
                        $('#categroy-child-list').html(html);
                    }
                }else{
                    sweetAlert(result.msg, "","error");
                }
            }
        });
    }

});