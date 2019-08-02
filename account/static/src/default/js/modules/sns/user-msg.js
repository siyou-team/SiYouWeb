
//消息时间初始化
function init_msg_event()
{

    var $state = $(".mail-table thead input[type='checkbox'], .mail-table tfoot input[type='checkbox']"),
        $chcks = $(".mail-table tbody input[type='checkbox']");

    // Script to select all checkboxes
    $state.on('change', function(ev)
    {
        if($state.is(':checked'))
        {
            $chcks.prop('checked', true).trigger('change');
        }
        else
        {
            $chcks.prop('checked', false).trigger('change');
        }
    });

    // Row Highlighting
    $chcks.each(function(i, el)
    {
        var $tr = $(el).closest('tr');

        $(this).on('change', function(ev)
        {
            $tr[$(this).is(':checked') ? 'addClass' : 'removeClass']('highlighted');




            var checked_flag = false;

            // Row Highlighting
            $chcks.each(function(i, el)
            {
                var $tr = $(el).closest('tr');

                $(this).is(':checked') ? checked_flag=true : ''
            });



            if (checked_flag)
            {
                $('#msg_remove_btn').removeClass('hide');
            }
            else
            {
                $('#msg_remove_btn').addClass('hide');
            }
        });
    });

    // Stars
    $(".mail-table .star").on('click', function(ev)
    {
        ev.preventDefault();

        if( ! $(this).hasClass('starred'))
        {
            $(this).addClass('starred').find('i').attr('class', 'fa-star');
        }
        else
        {
            $(this).removeClass('starred').find('i').attr('class', 'fa-star-empty');
        }
    });
}


//页面中加载消息
function load_msg(page)
{
    if ($('#mail_table_box').length > 0)
    {
        $('#mail_table_box').html($('#mail_table_tpl').html());

        $.send(SYS.CONFIG.index_url + '?mdu=sns&ctl=User_Message&met=lists&typ=json', 'page=' + page, function (data)
        {
            if (data.status == 200)
            {
                var app6 = new Vue({
                    el: '#mail_table_box',
                    data: data.data
                });


                $.common.initEvent($('#mail_table'));

                init_msg_event();
            }
            else
            {
                Public.tipMsg(data.msg || __('操作无法成功，请稍后重试！'));
            }
        });

    }
}


//短消息
jQuery(document).ready(function($)
{
    //页面中加载消息
    load_msg(1)
});





//删除操作
function remove_msg(message_id)
{
    Public.tipMsg('确定要删除吗？',function(){
        $.fancybox.close();

        $.request({
            type: "POST",
            url:SYS.CONFIG.index_url + "?mdu=sns&ctl=User_Message&met=remove&typ=json",
            data:{ message_id: message_id},
            dataType:'json',
            async: false,
            error: function() {
                Public.tipMsg(__('删除短信发生错误!'))
            },
            success: function() {

                $.fancybox.close();
                Public.tipMsg('删除成功!')
                load_msg(1);
            }
        });

    })
}





//点击删除事件：点击删除按钮  删除相应选项
$(document).on('click', '#msg_remove_btn', function ()
{
       //定义两个空字符串
       var message_ids = [];

    //遍历所有被选中的ID
    $("input[name='message_id']:checked").each(function()
    {
        id= $(this).val();
        message_ids.push(id);
    })

    //判断字符串是否为空
    if(message_ids.length == 0){
        Public.tipMsg('请勾选选项')
        return false;
    }else{
        remove_msg(message_ids.join(','))
    }
})


//详情删除页面
$(document).on('click','#msg-delete-btn',function()
{
      var message_id = $('#mail_message_id').val();
      remove_msg(message_id)
})


//回复操作
$(document).on('click', '#btn-reply-btn',function()
{
    $.fancybox.close();
    var user_nickname = $('#mail-other').html();                   //收件人昵称
    $('#user_nickname').val(user_nickname);

    $('#compose-msg-btn').trigger('click');
})


