
$(document).on('click', '.btn_back', function ()
{
    $.fancybox.close();
    return false;
})


$(document).on('click', '.bind-del ', function ()
{

    var that = $(this)

    var bind_type = that.data('bind_type');

    $('#bind_type').val(bind_type);

    var icon = [];
    icon[11] = 'icon_SINA_WEIBO';
    icon[12] = 'icon_OPEN_QQ';
    icon[13] = 'icon_WEIXIN';

    var html = [];
    html[11] = '新浪微博';
    html[12] = 'QQ';
    html[13] = '微信';


    $('.tip_thirdbind .img-avator').addClass(icon[bind_type]);
    $('.tip_thirdbind .bind-third-account').html(html[bind_type]);


    return false;
})

$(document).on('click', '#btn-status-del', function ()
{

    var bind_type = $(this).data('bind_type');
    Public.tipMsg(__("解除绑定,是否继续？"), function ()
    {
        $.request({
            type: "POST",
            url: SYS.CONFIG.index_url + "?ctl=User_Connect&met=remove&typ=json",
            data:{bind_type:bind_type},
            dataType:'json',
            async: false,
            error: function() {
            },
            success: function(data) {
                window.location.reload();
            }
        });
    })


    return false;
})