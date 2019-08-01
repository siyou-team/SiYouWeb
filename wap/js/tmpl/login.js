$(function(){
    var key = getLocalStorage('ukey');
    if (key) {
        if (window.parent!=window)
        {
            window.parent.location.reload();
        }

        window.location.href = WapSiteUrl+'/tmpl/seller/seller.html';
        return;
    }
    else
    {
        if (window.parent!=window)
        {
            $('#header').hide();
            $('#header').hide();
            $('#footer').hide();
            //$('body').css({height:'600px'})
        }
    }

    $.getJSON(SYS.URL.connect, function(result){
        var ua = navigator.userAgent.toLowerCase();
        var allow_login = 0;
        if (result.data.qq == '1') {
            allow_login = 1;
            $('.qq').removeClass('hide');
            $('.qq').attr('href', result.data.qq_url)

        }
        if (result.data.weibo == '1') {
            allow_login = 1;
            $('.weibo').removeClass('hide');
            $('.weibo').attr('href', result.data.weibo_url)
        }
        if ((ua.indexOf('micromessenger') > -1) && result.data.weixin == '1') {
            allow_login = 1;
	        $('#connect li').css("width","33.3%");//如果有微信登录插件功能，请把$前面的//去掉即可
            $('.weixin').removeClass('hide');
            $('.weixin').attr('href', result.data.weixin_url)
        }

        if (allow_login) {
            $('.joint-login').removeClass('hide');
        }
    });

	var referurl = document.referrer;//上级网址
	$.sValid.init({
        rules:{
            username:"required",
            userpwd:"required"
        },
        messages:{
            username:__("用户名必须填写！"),
            userpwd:__("密码必填!")
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide();
            }
        }  
    });
    var allow_submit = true;
	$('#loginbtn').click(function(){//会员登陆
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        if (allow_submit) {
            allow_submit = false;
        } else {
            return false;
        }
		var username = $('#username').val();
		var pwd = $('#userpwd').val();
		var client = 'wap';
		if($.sValid()){
	          $.request({
				type:'post',
				url: SYS.URL.login,
				data:{user_account:username,user_password:pwd,client:client},
				dataType:'json',
				success:function(result){
				    allow_submit = true;
					if(result.status==200){
						if(typeof(result.data.key)=='undefined'){
							return false;
						}else{
						    var expireHours = 0;
						    if ($('#checkbox').prop('checked')) {
						        expireHours = 188;
						    }
						    // 更新cookie购物车
						    updateCookieCart(result.data.key);

							setLocalStorage('username',result.data.user_nickname, expireHours);
							setLocalStorage('uid',result.data.user_id, expireHours);
							setLocalStorage('ukey',result.data.key, expireHours);
							setLocalStorage('rid',result.data.rid, expireHours);
                            if(result.data.rid ==  2){

                                //跳到选择门店页面
                                // location.href = '../seller/chain_list.php';
                                location.href = '../seller/seller.php';
                                return false;
                            }else if(result.data.rid ==  3){
                                location.href = '../seller/seller.php';
                                return false;

                            }else{
                                if (window.parent!=window)
                                {
                                    window.parent.location.reload();
                                }
                                else
                                {
                                    var callback = getQueryString('callback');
                                    if (callback)
                                    {
                                        location.href = decodeURIComponent(callback);
                                    }
                                    else
                                    {
                                        location.href = referurl;
                                    }

                                }
                            }
						}
		                errorTipsHide();
					}else{
		                errorTipsShow('<p>' + result.msg + '</p>');
					}
				}
			 });  
        }
	});
});