;$(function () {
    $(document).on('click', '#J_certification', function ()
    {

        $.ajax({
            type: "POST",
            url: SYS.URL.account.commit_certificate,
            data:$('#manage-form').serialize(),
            dataType:'json',
            async: false,
            error: function() {
                alert("failure");
            },
            success: function() {
                Public.tipMsg(__('提交成功'));
                $('#certification_no').addClass('hide');
                $('#certification_verify').removeClass('hide');
                window.location.reload();
            }
        });

        return false;
    })
})