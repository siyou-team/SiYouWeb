$(function(){
    if (!ifLogin()){return}


    //初始化列表
		function initPage(){
			$.request({
				type:'post',
				url: SYS.URL.user.address_lists,
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
                                okBtnText: __("确定"), //确定按钮的文字
                                cancelBtnText: __("取消"), //取消按钮的文字
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
		//点击删除地址
		function delAddress(address_id){
			$.request({
				type:'post',
				url: SYS.URL.user.address_remove,
				data:{ud_id:address_id},
				dataType:'json',
				success:function(result){
					//checkLogin(result.login);
					if(result){
						initPage();
					}
				}
			});
		}

        // 地址列表
        $('#add_address_btn').click(function(e){

        	if (isWeixin())
			{
                e.preventDefault();

                wx.ready(function () {

                    wx.openAddress({
                        success : function(result){
                            alert(JSON.stringify(result));
                            //此处获取到地址信息，可做自己的业务操作
                            alert(__('收货人姓名') + result.userName);
                            alert(__('收货人电话') + result.telNumber);
                            alert(__('邮编') + result.postalCode);
                            alert(__('国标收货地址第一级地址') + result.provinceName);
                            alert(__('国标收货地址第二级地址') + result.cityName);
                            alert(__('国标收货地址第三级地址') + result.countryName);
                            alert(__('详细收货地址信息') + result.detailInfo);
                            alert(__('收货地址国家码') + result.nationalCode);
                        }
                    });
                })
			}
        });


});