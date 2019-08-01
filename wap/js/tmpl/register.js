$(function(){
    var key = getLocalStorage('ukey');
    if (key) {
        window.location.href = WapSiteUrl+'/tmpl/member/member.html';
        return;
    }
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    
	$.sValid.init({//注册验证
        rules:{
        	username:"required",
            userpwd:"required",            
            password_confirm:"required",
            district_info:"required",
            email:{
            	required:true,
            	email:true
            }
        },
        messages:{
            username:"用户名必须填写！",
            userpwd:"密码必填!", 
            password_confirm:"确认密码必填!",
            district_info:"所属地区必须填写!",
            email:{
            	required:"邮件必填!",
            	email:"邮件格式不正确"
            }
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
	
	$('#registerbtn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var username = $("input[name=username]").val();
        var pwd = $("input[name=pwd]").val();
        var password_confirm = $("input[name=password_confirm]").val();
        var email = $("input[name=email]").val();
        var client = 'wap';
        var rand_key = $('#codekey').val();
        var verify_code = $('#captcha').val();


        var user_province_id = $('#user_province_id').val();
        var user_city_id = $('#user_city_id').val();
        var user_county_id = $('#user_county_id').val();



        if ($.sValid()) {
            $.request({
                type    : 'post',
                url     : SYS.URL.register,
                data    : {
                    user_account    : username,
                    user_password   : pwd,
                    password_confirm: password_confirm,
                    client          : client,
                    user_province_id          : user_province_id,
                    user_city_id          : user_city_id,
                    user_county_id          : user_county_id,
                    rand_key        : rand_key,
                    verify_code     : verify_code
                },
                dataType: 'json',
                success : function (result) {
                    if (result.status == 200) {
                        if (typeof(result.data.key) == 'undefined') {
                            return false;
                        } else {
                            // 更新cookie购物车
                            updateCookieCart(result.data.key);
                            setLocalStorage('username', result.data.user_nickname);
                            setLocalStorage('ukey', result.data.key);
                            location.href = WapSiteUrl + '/tmpl/member/member.html';
                        }
                        errorTipsHide();
                    } else {
                        errorTipsShow("<p>" + result.msg + "</p>");
                    }
                }
            });
        }
    });

    // 选择地区
    $('#district_info').on('click', function(){
        $.areaSelected({
            success : function(data){
                $('#district_info').val(data.district_info).attr({'data-areaid':data.district_id, 'data-areaid1':data.district_id_1,  'data-areaid2':data.district_id_2});

                $('#user_province_id').val(data.district_id_1)
                $('#user_city_id').val(data.district_id_2)
                $('#user_county_id').val(data.district_id_3)

                writeClear($('#district_info'));
            }
        });
    });
});