$(function(){
    if (!ifLogin()){return}


    //初始化列表
		function initPage(){
			$.request({
				type:'post',
				url: SYS.URL.supplier.lists,
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

        // 取消
    $('#address_list').on('click','.oper', function(){
        var store_distributor_id = $(this).data('id');
        var distributor_enable   = $(this).data('status');
        verify(store_distributor_id,distributor_enable);
    });

     $('#address_list').on('click','.del', function(){
        var store_distributor_id = $(this).data('id');
        del(store_distributor_id);
    });


     //通过
    function verify( i, t ){
        var store_distributor_id = i;
        var distributor_enable   = t;
        $.sDialog({
            content: __('确定审核吗？'),
            okFn: function() { 
                $.request({
                    type:"post",
                    url: SYS.CONFIG.URL.supplier.verify,
                    data:{store_distributor_id:store_distributor_id,distributor_enable:distributor_enable},
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


      //通过
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