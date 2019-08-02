
//短消息
jQuery(document).ready(function($)
{
    //页面中加载消息
    var friend_info_lists = sprintf("%s/account.php?mdu=sns&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Friend', 'getFriendsInfo');

    $.send(friend_info_lists, function (data)
    {
        if (data.status == 200)
        {/*
            var app6 = new Vue({
                el: '#mail_table_box',
                data: data.data
            });


            $.common.initEvent($('#mail_table'));*/
        }
        else
        {
            Public.tipMsg(data.msg || __('操作无法成功，请稍后重试！'));
        }
    });
});

