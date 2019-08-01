$(function(){
    if (!ifLogin()){return}


    //初始化列表
    function initPage(){
        $.request({
            type:'post',
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=userBank&typ=json',
            data:{},
            dataType:'json',
            success:function(result){

                if (result.status == 200)
                {
                    var data = result.data;
                    var html = template.render('_userbank_list', data);
                    $("#userbank_list").empty();
                    $("#userbank_list").append(html);

                    //点击删除地址
                    $('.deluserbank').click(function(){
                        var userbank_id = $(this).attr('userbank_id');
                        $.sDialog({
                            skin:"block",
                            content:__('确认删除吗？'),
                            okBtn:true,
                            cancelBtn:true,
                            okFn: function() {
                                delUserBank(userbank_id);
                            }
                        });
                    });
                }
            }
        });
    }
    initPage();
    //点击删除地址

    function delUserBank(userbank_id){

        $.request({
            type:'post',
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=removeUserBank&typ=json',
            data:{id:userbank_id},
            dataType:'json',
            success:function(result){
                if(result.status==200){
                    initPage();
                } else {
                    alert(__('该卡已绑定'));
                }
            }
        });
    }

});