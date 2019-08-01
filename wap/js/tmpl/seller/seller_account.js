$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}
	//取数据 
     
    $.request({
        type: "post",
        url: SYS.CONFIG.URL.seller.get_store_info,
        data: {},
        dataType: "json",
        success: function(res) {
            if(res.status==250){

               /* $.sDialog({
                    skin: "red",
                    content: res.msg,
                    okBtn: true,
                    okFn: function () {
                        window.location.href = WapSiteUrl + "/tmpl/seller/store_goods_list.html";
                    },
                    cancelBtn: false
                });*/
                return;
            }
            //checkLogin(a.login);
            $("#store_qq").val(res.data.info.store_qq);
            $("#store_ww").val(res.data.info.store_ww);
            $("#store_name").val(res.data.store_name);
            $("#store_keywords").val(res.data.info.store_keywords);
            $("#store_tel").val(res.data.info.store_tel);
            $("#store_banner").val(res.data.info.store_banner);

            $("#store_logo").val(res.data.store_logo).prev('a').append('<div class="pic-thumb"><img src="'+res.data.store_logo+'"/></div>');
            $("#store_banner").val(res.data.info.store_banner).prev('a').append('<div class="pic-thumb"><img src="'+res.data.info.store_banner+'"/></div>');
        }
    });
			 
        $('input[name="upfile"]').ajaxUploadImage({
            url : SYS.URL.upload,
            data:{},
            start :  function(element){
                element.parent().after('<div class="upload-loading"><i></i></div>');
                element.parent().siblings('.pic-thumb').remove();
            },
            success : function(element, result){
                //checkLogin(result.login);
                if (result.status != 200) {
                    element.parent().siblings('.upload-loading').remove();
                    $.sDialog({
                        skin:"red",
                        content:__('图片尺寸过大！'),
                        okBtn:false,
                        cancelBtn:false
                    });
                    return false;
                }
                element.parent().after('<div class="pic-thumb"><img src="'+result.data.url+'"/></div>');
                element.parent().siblings('.upload-loading').remove();
                element.parents('a').next().val(result.data.url);
            }
        });
			 
    $("#header-nav").click(function() {
        $(".btn").click()
    });
    $(".btn").click(function() {
       
            var store_qq = $("#store_qq").val();
            var store_ww = $("#store_ww").val();
            var store_tel = $("#store_tel").val();
			var store_banner = $("#store_banner").val();
			var store_logo = $("#store_logo").val();
            $.request({
                type: "post",
                url: SYS.CONFIG.URL.seller.edit_store_info,
                data: {
                    store_qq: store_qq,
                    store_ww: store_ww,
                    store_tel: store_tel,
                    store_banner:store_banner,
                    store_logo: store_logo
                },
                dataType: "json",
                success: function(a) {
                    if (a&&a.status==200) {
						$.sDialog({
							skin: "red",
							content: __("编辑成功"),
							okBtn: true,
							okFn:function(){window.location.href = WapSiteUrl + "/tmpl/seller/seller_account.html";},
							cancelBtn: false
						 }); 
                    } else {
						$.sDialog({
							skin: "red",
							content: __("编辑失败")+JSON.stringify(a),
							okBtn: false, 
							cancelBtn: false
						 });  
                    }
                }
            })
         
    });
    
});