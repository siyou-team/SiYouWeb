if (getQueryString('ukey') != '')
{
    var key = getQueryString('ukey');
}
else
{
    var key = getLocalStorage('ukey');
}
var nodeSiteUrl = '';
var userInfo = {};
var resourceSiteUrl = '';
var smilies_array = new Array();
smilies_array[1] = [['1', ':smile:', 'smile.gif', '28', '28', '28', __('微笑')], ['2', ':sad:', 'sad.gif', '28', '28', '28', __('难过')], ['3', ':biggrin:', 'biggrin.gif', '28', '28', '28', '呲牙'], ['4', ':cry:', 'cry.gif', '28', '28', '28', '大哭'], ['5', ':huffy:', 'huffy.gif', '28', '28', '28', __('发怒')], ['6', ':shocked:', 'shocked.gif', '28', '28', '28', __('惊讶')], ['7', ':tongue:', 'tongue.gif', '28', '28', '28', __('调皮')], ['8', ':shy:', 'shy.gif', '28', '28', '28', __('害羞')], ['9', ':titter:', 'titter.gif', '28', '28', '28', __('偷笑')], ['10', ':sweat:', 'sweat.gif', '28', '28', '28', __('流汗')], ['11', ':mad:', 'mad.gif', '28', '28', '28', __('抓狂')], ['12', ':lol:', 'lol.gif', '28', '28', '28', __('阴险')], ['13', ':loveliness:', 'loveliness.gif', '28', '28', '28', __('可爱')], ['14', ':funk:', 'funk.gif', '28', '28', '28', __('惊恐')], ['15', ':curse:', 'curse.gif', '28', '28', '28', __('咒骂')], ['16', ':dizzy:', 'dizzy.gif', '28', '28', '28', __('晕')], ['17', ':shutup:', 'shutup.gif', '28', '28', '28', __('闭嘴')], ['18', ':sleepy:', 'sleepy.gif', '28', '28', '28', __('睡')], ['19', ':hug:', 'hug.gif', '28', '28', '28', __('拥抱')], ['20', ':victory:', 'victory.gif', '28', '28', '28', __('胜利')], ['21', ':sun:', 'sun.gif', '28', '28', '28', __('太阳')], ['22', ':moon:', 'moon.gif', '28', '28', '28', __('月亮')], ['23', ':kiss:', 'kiss.gif', '28', '28', '28', __('示爱')], ['24', ':handshake:', 'handshake.gif', '28', '28', '28', __('握手')]];
var user_other_id = getQueryString('user_other_id');
var chat_item_id = getQueryString('item_id');

$(function () {
    $.getJSON(SYS.URL.user.msg_config, {user_other_id: user_other_id, chat_item_id: chat_item_id}, function (result) {
        //checkLogin(result.login);
        connentNode(result.data);

        if (!$.isEmptyObject(result.data.chat_item_row))
        {
            var goods = result.data.chat_item_row;
            var html = '<div class="sstouch-chat-product"> <div class="goods-pic"><img src="' + goods.product_image + '" alt=""/></div><div class="goods-info"><div class="goods-name"><a href="' + WapSiteUrl + "/tmpl/product_detail.html?item_id=" + goods.item_id + '" target="_blank">' + goods.product_item_name + '</div></a><div class="goods-price">￥' + goods.item_unit_price + "</div><p><a href='javascript:;' class='send_goods_url'>" + __('发送链接') + "</a></p></div> </div>";
            $("#chat_msg_html").append(html);
        }
    });

    var connentNode = function (data) {
        nodeSiteUrl = data.node_site_url;
        userInfo = data.user_info;
        userOtherInfo = data.user_other_info;
        $('h1').html(userOtherInfo.store_name != '' ? userOtherInfo.store_name : userOtherInfo.member_name);
        resourceSiteUrl = data.resource_site_url;
        if (!data.im_chat)
        {
            $.sDialog({
                skin: "red",
                content: __('在线聊天系统暂时未启用'),
                okBtn: false,
                cancelBtn: false
            });
            return false;
        }
        var script = document.createElement("script");
        script.type = "text/javascript";
        //script.src = resourceSiteUrl+'/socket.io/socket.io.js';
        script.src = resourceSiteUrl + '/js/reconnecting-websocket.js';
        document.body.appendChild(script);
        checkIO();

        function checkIO()
        {
            setTimeout(function () {
                if (typeof ReconnectingWebSocket === "function")
                {
                    connect_node();
                }
                else
                {
                    checkIO();
                }
            }, 500);
        }

        function connect_node()
        {
            var connect_url = nodeSiteUrl;
            var connect = 0;//连接状态
            var member = {};

            member['user_other_id'] = userInfo.member_id;
            member['u_name'] = userInfo.member_name;
            member['avatar'] = userInfo.user_avatar;
            member['s_id'] = userInfo.store_id;
            member['s_name'] = userInfo.store_name;
            member['s_avatar'] = userInfo.store_avatar;


            socket = new ReconnectingWebSocket(connect_url);


            socket.onopen = function (event) {
                connect = 1;
                console.info('open');
                console.info(event);
            };

            socket.onconnecting = function (event) {
                console.info(event);
            };

            socket.onmessage = function (event) {
                console.info(event);
                get_msg(JSON.parse(event.data));
            };

            socket.onerror = function (event) {
                console.info(event);
            };
            socket.onclose = function (event) {
                console.info(event);
            };


            /*
             //socket = io(connect_url, { 'path': '/socket.io', 'reconnection': false });
             socket.on('connect', function () {
             connect = 1;
             socket.emit('update_user', member);
             // 在线状态
             //                        socket.on('get_state', function (data) {
             //                          get_state(data);
             //                        });
             socket.on('get_msg', function (data) {
             get_msg(data);
             });
             //                        socket.on('del_msg', function (data) {
             //                          del_msg(data);
             //                        });
             socket.on('disconnect', function () {
             connect = 0;
             // 重连
             //                          connect('0');
             });
             });
             */
            //                function node_get_state(data){
            //                    if(connect === 1) {
            //                        var myArray=new Array();
            //                        myArray['5'] = 0
            //                        socket.emit('get_state', myArray);
            //                    }
            //                }
            function node_send_msg(data)
            {
                if (connect === 1)
                {
                    $.request({
                        type: 'post',
                        url: SYS.URL.user.msg_add,
                        data: data,
                        dataType: 'json',
                        success: function (result) {
                            if (result.status == 200)
                            {
                                var msgData = result.data;

                                /*
                                 var e = socket.createEvent('send_msg');
                                 e.data = msgData;
                                 socket.dispatchEvent(e);
                                 */


                                var data = {mine:{}, to:{}};
                                data.mine.id = userInfo.id;
                                data.mine.avatar = userInfo.user_avatar;
                                data.mine.username = userInfo.user_nickname;
                                data.mine.content = msgData.message_content;
                                data['mine']['message_id'] = msgData.message_other_id;


                                data.to.id = userOtherInfo.id;
                                data.to.avatar = userOtherInfo.user_avatar;
                                data.to.username = userOtherInfo.user_nickname;
                                data.to.type = 'friend';



                                //向服务器发送数据
                                var text = JSON.stringify(data);
                                socket.send(text);

                                msgData.avatar = userInfo.user_avatar;
                                msgData.class = 'msg-me';
                                insert_html(msgData);
                            }
                            else
                            {
                                $.sDialog({
                                    skin: "red",
                                    content: result.msg,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return false;
                            }
                        }
                    });
                }
            }

            function node_del_msg(max_id, f_id)
            {
                if (connect === 1)
                {
                    socket.emit('del_msg', {'max_id': max_id, 'f_id': f_id});
                }
            }

            //                // 获取状态
            //                function get_state(data) {
            //
            //                    node_send_msg('');
            //                }
            // 接收消息
            function get_msg(msgData)
            {

                if (msgData.f_id != user_other_id)
                {
                }


                msgData.message_content = msgData.content;


                msgData.avatar = (!$.isEmptyObject(userOtherInfo.store_id) ? userOtherInfo.store_avatar : userOtherInfo.user_avatar);
                msgData.class = 'msg-other';
                insert_html(msgData);

                //设置为已读
                if (msgData.message_id)
                {
                    var url = sprintf("%s/account.php?mdu=sns&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'User_Message', 'setRead');

                    $.request({
                        type: 'post',
                        url: url,
                        data: {message_id:msgData.message_id},
                        dataType: 'json',
                        success: function (result) {
                        }
                    });
                }

                if (typeof(max_id) != 'undefined')
                {
                    //node_del_msg(max_id, user_other_id);
                }
            }

            // 删除消息
            //                function del_msg(data) {
            //                }

            $('#submit').click(function () {
                var t_msg = $('#msg').val();
                $('#msg').val('');
                if (t_msg == '')
                {
                    $.sDialog({
                        skin: "red",
                        content: __('请填写内容'),
                        okBtn: false,
                        cancelBtn: false
                    });
                    return false;
                }
                node_send_msg({
                    user_other_id: user_other_id,
                    t_name: userOtherInfo.member_name,
                    message_content: t_msg,
                    chat_item_id: chat_item_id
                });
                $('#chat_smile').addClass('hide');
                $('.sstouch-chat-con').css('bottom', '2rem');
            });
            //开始
            $(".send_goods_url").click(function () {
                var goods_url = $(".goods-name a").attr("href");
                var goods_name = $(".goods-name a").html();
                var item_unit_price = $(".goods-price").html();
                var last_msg = $("#msg").val() + goods_url + "&nbsp;" + goods_name + "&nbsp;" + item_unit_price;
                console.log(last_msg);
                $("#msg").val(last_msg).trigger("click");
                $("#submit").trigger("click");

            });
            //结束
        }

        for (var i in smilies_array[1])
        {
            var s = smilies_array[1][i];
            var smilieimg = '<img title="' + s[6] + '" alt="' + s[6] + '" data-sign="' + s[1] + '" src="' + resourceSiteUrl + '/images/smilies/' + s[2] + '">';
            $('#chat_smile > ul').append('<li>' + smilieimg + '</li>');
        }

        $('#open_smile').click(function () {
            if ($('#chat_smile').hasClass('hide'))
            {
                $('#chat_smile').removeClass('hide');
                $('.sstouch-chat-con').css('bottom', '7rem');
            }
            else
            {
                $('#chat_smile').addClass('hide');
                $('.sstouch-chat-con').css('bottom', '2rem');
            }
        });
        $('#chat_smile').on('click', 'img', function () {
            var _sign = $(this).attr('data-sign');
            var dthis = $('#msg')[0];
            var start = dthis.selectionStart;
            var end = dthis.selectionEnd;
            var top = dthis.scrollTop;
            dthis.value = dthis.value.substring(0, start) + _sign + dthis.value.substring(end, dthis.value.length);
            dthis.setSelectionRange(start + _sign.length, end + _sign.length);
        });

        // 查看更多聊天记录
        $('#chat_msg_log, #chat_msg_log_app').click(function () {
            $.request({
                type: 'post',
                url: SYS.URL.user.msg_lists,
                data: {user_other_id: user_other_id, t: 30},
                dataType: 'json',
                success: function (result) {
                    if (result.status == 200)
                    {
                        if (result.data.items.length == 0)
                        {
                            $.sDialog({
                                skin: "block",
                                content: __('暂无聊天记录'),
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }
                        result.data.items.reverse();
                        $("#chat_msg_html").html('');
                        for (var i = 0; i < result.data.items.length; i++)
                        {
                            var _list = result.data.items[i];
                            if (_list.message_kind == 1)
                            {
                                var data = {};
                                data.class = 'msg-me';
                                data.avatar = userInfo.user_avatar;
                                data.message_content = _list.message_content;
                                insert_html(data);
                            }
                            else
                            {
                                var data = {};
                                data.class = 'msg-other';
                                //data.avatar = userOtherInfo.store_avatar == '' ? userOtherInfo.user_avatar : userOtherInfo.store_avatar;
                                data.avatar = userOtherInfo.user_avatar;
                                data.message_content = _list.message_content;
                                insert_html(data);
                            }
                        }
                    }
                    else
                    {
                        $.sDialog({
                            skin: "red",
                            content: result.msg,
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                }
            });
        });


        function insert_html(msgData)
        {
            msgData.message_content = update_chat_msg(msgData.message_content);
            var html = '<dl class="' + msgData.class + '"><dt><img src="' + msgData.avatar + '" alt=""/><i></i></dt><dd>' + msgData.message_content + '</dd></dl>';
            $("#chat_msg_html").append(html);
            if (!$.isEmptyObject(msgData.goods_info))
            {
                var goods = msgData.goods_info;
                var html = '<div class="sstouch-chat-product"> <a href="' + WapSiteUrl + '/tmpl/product_detail.html?item_id=' + goods.item_id + '" target="_blank"><div class="goods-pic"><img src="' + goods.pic36 + '" alt=""/></div><div class="goods-info"><div class="goods-name">' + goods.goods_name + '</div><div class="goods-price">￥' + goods.goods_promotion_price + '</div></div></a> </div>';
                $("#chat_msg_html").append(html);
            }
            $("#anchor-bottom")[0].scrollIntoView();
        }

        // 表情
        function update_chat_msg(msg)
        {
            if (typeof smilies_array !== "undefined")
            {
                msg = '' + msg;
                for (var i in smilies_array[1])
                {
                    var s = smilies_array[1][i];
                    var re = new RegExp("" + s[1], "g");
                    var smilieimg = '<img title="' + s[6] + '" alt="' + s[6] + '" src="' + resourceSiteUrl + '/images/smilies/' + s[2] + '">';
                    msg = msg.replace(re, smilieimg);
                }
            }
            return msg;
        }
    }

});