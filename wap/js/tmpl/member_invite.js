//by qianyistore invite
$(function(){
    if (!ifLogin()){return}

    $.request({
			type:'post',
			url:SYS.URL.fx.invite,
			data:{},
			dataType:'json',
			//jsonp:'jsonp_callback',
			success:function(result){
				if (result.status == 200)
				{
                    $('#username').html(result.data.invite_info.user_nickname);
                    $('#invite_url').val(result.data.invite_info.invite_url);
                    $('#qrcode').attr("src",result.data.invite_info.qrcode);
                    $('#download_url').attr("href",result.data.invite_info.download_url);
				}

				return false;
			}
	});

/*
    var uid = getLocalStorage('uid');

    $.request({
        type:'post',
        url:SYS.URL.wx.getQRCode,
        data:{'scene_id':uid},
        dataType:'json',
        //jsonp:'jsonp_callback',
        success:function(result){
            if (result.status == 200)
            {
                //$('#username').html(result.data.invite_info.user_nickname);
                //$('#invite_url').val(result.data.invite_info.invite_url);
                $('#qrcode').attr("src",result.data.url);
                $('#download_url').attr("href",result.data.url);
            }

            return false;
        }
    });
 */
});