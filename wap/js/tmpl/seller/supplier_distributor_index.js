$(function(){
    if (!ifLogin()){return}


    //初始化列表
		function initPage(){
			$.request({
				type:'post',
				url: SYS.URL.supplier.distributor,
				data:{},
				dataType:'json',
				success:function(result){
					if (result.status == 200)
					{
                        var data = result.data;
                        var html = template.render('saddress_list', data);
                        $("#address_list").empty();
                        $("#address_list").append(html);
                        //点击删除地址
                        $('.deladdress').click(function(){
                            var address_id = $(this).attr('address_id');
                            $.sDialog({
                                skin:"block",
                                content:__('确认删除吗？'),
                                okBtn:true,
                                cancelBtn:true,
                                okFn: function() {
                                    delAddress(address_id);
                                }
                            });
                        });
					}
				}
			});
		}
		initPage();

    $('#address_list').on('click','.del', function(){
        var store_distributor_id = $(this).data('id');
        del(store_distributor_id);
    });
    
    //删除
    function del( i ){
        var store_distributor_id = i;
        $.sDialog({
            content: __('确定删除吗？'),
            okFn: function() { 
                $.request({
                    type:"post",
                    url: SYS.CONFIG.URL.supplier.remove,
                    data:{store_distributor_id:store_distributor_id},
                    dataType:"json",
                    success:function(result){
                        if(result.status == 200 ){
                            reset = true;
                            initPage();
                        } else {
                            $.sDialog({
                                skin:"red",
                                content:result.msg,
                                okBtn:false,
                                cancelBtn:false
                            });
                        }
                    }
                });
            }
        });
    }
});