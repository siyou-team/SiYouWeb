function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

jQuery(document).ready(function ($)
{
	$("#user_account").focus();
	
    $("#login").bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon',
            invalid: 'glyphicon',
            validating: 'glyphicon'
        },
        fields: {
            user_account: {
                validators:
                    {
                        notEmpty: {
                            message: __("请输入账号")
                        },
                        stringLength: {
                            min: 1,
                            max: 50,
                            message: __('账号长度为1~50位')
                        }
                    }

            },
			user_password: {
                validators:
                    {
                        notEmpty: {
                            message: __("请输入密码")
                        }
                    }
            }
        }
    }).on("success.form.bv", function (e) {
        e.preventDefault();        
        $.ajax({
            url: SYS.URL.login,
            method: 'POST',
            dataType: 'json',
            data: {
                do_login: true,
                user_account: $("#login").find('#user_account').val(),
                user_password: $("#login").find('#user_password').val(),
                callback: $("#login").find('#callback').length>0 ? $("#login").find('#callback').val(): GetQueryString('callback'),
            },
            success: function (resp)
            {
                if (200 == resp.status)
                {
                    if (window.parent!=window)
                    {
                        if (resp.data.callback_url)
                        {
                            window.parent.location.href = decodeURIComponent(SYS.CONFIG.index_url);
                        }
                        else
                        {
                            window.parent.location.reload();
                        }
                    }
                    else
                    {
                        window.location.href = decodeURIComponent(SYS.CONFIG.index_url);
                    }
                }else{
					alert(resp.msg);
					if (window.parent!=window)
                    {
                        window.parent.location.reload();
                    }else{
						window.location.reload();
					}
				}
            }
        });
    });
	
	var i= 0;
	var n = $(".login-bg .item").length;
	function timeflex(){
		if(i >= n-1){
			i =- 1;
		};
		i++;
		$(".login-bg .item").css("opacity","0");
		$(".login-bg .item").eq(i).css("opacity","1");
	};
	setInterval(timeflex,4000)
});