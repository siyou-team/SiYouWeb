
    $(document).on('click', '.tip_btns .info', function ()
    {
        $.fancybox.close();
        return false;
    })

    $(document).on('click', '.btn_mod_close', function ()
    {
        $.fancybox.close();
        return false;
    })

    $(document).on('click', '.tip_btns .common-info', function ()
    {

        $.ajax({
            type: "POST",
            url: SYS.URL.account.edit_user_info,
            data:$('#manage-form').serialize(),
            dataType:'json',
            async: false,
            error: function() {
                alert("failure");
            },
            success: function(data) {
                var result = data.data;
                $('#user_nickname').val(result.user_nickname);
                $('#user_realname').val(result.user_realname);
                $('#user_mobile').val(result.user_mobile);
                $('#user_address').val(result.user_address);
                $('#user_qq').val(result.user_qq);
                $('#user_gender').val(result.user_gender);

                $('.framedatabox .user_nickname').html(result.user_nickname);
                $('.framedatabox .user_realname').html(result.user_realname);
                $('.framedatabox .user_mobile').html(result.user_mobile);
                $('.framedatabox .user_address').html(result.user_address);
                $('.framedatabox .user_qq').html(result.user_qq);

                var html = result.user_gender == 1?__('男'):__('女');

                $('.framedatabox .user_gender').html(html);

                $.fancybox.close();
            }
        });

        return false;
    })
    //上传头像


    $(document).on('click', '.tip_btns .photo', function ()
    {
        $.fancybox.close();

        return false;
    })

    $(document).on('click', '.tip_btns .common-photo', function ()
    {
        var user_nickname = $('#user_nickname').val();
        var user_realname = $('#user_realname').val();
        var user_mobile = $('#user_mobile').val();
        var user_address = $('#user_address').val();
        var user_qq = $('#user_qq').val();
        var user_gender = $('#user_gender').val();
        var user_id = $('#user_id').val();
        var user_avatar = $('#user_avatar').val();
        $.ajax({
            type: "POST",
            url: SYS.URL.account.edit_user_info,
            data:{user_avatar:user_avatar, user_nickname:user_nickname, user_realname:user_realname, user_mobile:user_mobile, user_address:user_address, user_qq:user_qq, user_gender:user_gender, user_id:user_id},
            dataType:'json',
            async: false,
            error: function() {
                alert("failure");
            },
            success: function(data) {
                var result = data.data;

                $('#user_avatar').val(result.user_avatar);
                $('#avatar').attr('src', result.user_avatar);

                $.fancybox.close();
            }
        });

        return false;
    })


    $(document).on('click', '#email-next', function ()
    {

        var user_nickname = $('#user_nickname').val();
        var user_realname = $('#user_realname').val();
        var user_mobile = $('#user_mobile').val();
        var user_address = $('#user_address').val();
        var user_qq = $('#user_qq').val();
        var user_gender = $('#user_gender').val();
        var user_id = $('#user_id').val();
        var user_avatar = $('#user_avatar').val();
        $.ajax({
            type: "POST",
            url: SYS.URL.account.edit_user_info,
            data:{user_avatar:user_avatar, user_nickname:user_nickname, user_realname:user_realname, user_mobile:user_mobile, user_address:user_address, user_qq:user_qq, user_gender:user_gender, user_id:user_id},
            dataType:'json',
            async: false,
            error: function() {
                alert("failure");
            },
            success: function(data) {
                var result = data.data;
                $('#user_avatar').val(result.user_avatar);
                $('#avatar').attr('src', result.user_avatar);
                $('#img-avatar').attr('src', result.user_avatar);
                $.fancybox.close();
            }
        });

        return false;
    })
