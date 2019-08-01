
<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/public.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_cart.css">

    <style type="text/css">
        .page-content {
            margin-top: 1rem;
        }
        .ui-center-mask-content {
            position: relative;
        }
        .ui-bottom-mask-close {
            top: -1.3rem;
            right: 0rem;
        }
        .nctouch-inp-con ul li {
            margin-right: 0.5rem
        }
        .w284 {
            width: 2.84rem;
        }
        .user-img-ab {
            position: absolute;
            top: -1.42rem;
            left: 50%;
            border-radius: 1.42rem;
            margin-left: -1.42rem;
        }

        .mt2 {
            margin-top: 0.84rem;
        }
        .pd2 {
            margin:0.22rem 0;
        }
        .sbtn {
            display: block;
            width: 90%;
            margin: 0 auto;
            padding: 0.2rem 0;
            background: #fc4747;
            color: #fff;
            border-radius: 0.2rem;
            margin-bottom: 0.5rem;
        }
        .pdt65{
            padding-top: .65rem;
        }
        .wx_code{position:absolute;top:50%;margin-top:-125px;left:50%;margin-left:-120px;z-index:99;width:220px;height:245px;background:#FFF;font-size:13px;padding:10px 10px;text-align:center;}
        .wx_code .close_box{display:inline-block;position:absolute;right:-10px;top:-5px;width:30px;height:30px;background:url(../../images/chacha.png) #EC5464 no-repeat center center;background-size:60%;border-radius:100%;z-index:100;}
        .wx_code p{font-size:12px;line-height:14px;}
        .item {
            min-width: 4rem;
            padding: 0 0rem 0 0.2rem;
        }
        .icon-killf {
            width: 1.42rem;
            background-position-y:50%;
        }
        *[data-role='mask']{
            display: none;
        }
        *[data-role='mask'].on{
            display: block;
        }
        *[data-mask='help'] .help_pic{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(../../images/share_help.png) no-repeat center top rgba(0,0,0,0.93);
            background-size: 100%;
            z-index: 100;
        }
        .help_cut {
            width: 3.5rem;
            text-align: right;
        }
        .icon-killfbg {
            width: 1.48rem;
            background-position-y:50%;
        }
        .header-r a .icon-share {
            background-image: url(../../images/icon-share.png);
        }
        .nctouch-inp-con ul li {
            margin: 0 0.5rem;
        }
        .lab {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 5rem;
        }
    </style>
</head>
<body>
<div class="page-wrap">
    <header class="head-fixed bg5">
        <div class="header-wrap">
            <div class="header-l">
                <a href="javascript:;" onclick="goBack()">
                    <span class="icon icon-arrow-left"></span>
                </a>
            </div>
            <h1 class="title"><?=__('砍价免费拿')?></h1>
            <div class="header-r">
                <a id="header-nav" href="javascript:void(0);" onclick="shareBox()">
                    <span class="icon icon-share"></span>
                </a>
            </div>
        </div>
    </header>
    <div class="page-content" style="padding-top:.9rem;">

    </div>

    <!--分享操作表-->
    <div class="ui-bottom-mask hidden" id="share_box">
        <div class="ui-bottom-mask-bg"></div>
        <div class="ui-bottom-mask-block bor-rt">
            <div class="ui-bottom-mask-tip hidden"><i></i></div>
            <div class="ui-bottom-mask-content">
                <a href="javascript:void(0);" class="ui-bottom-mask-close close"><i></i></a>
                <div class="ui-bottom-mask-rolling" id="share_rolling">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="share_main">
    <% if( data ) { %>
    <div>
        <div class="flex-center flex-dc ptb100 borb-d1">
            <div class="f8 c26" ><?=__('你已砍价')?><span class="c5"><%=data.user_self_cut_price%><?=__('元')?></span>，<?=__('赶快分享给好友吧')?></div>
            <div class="f8 c26"><?=__('分享后可以多砍')?><span class="c5"><%=data.cut_down_share_price%><?=__('元')?></span><?=__('哦～')?></div>
        </div>
        <div>
            <div class="flex-center mt5">
                <a class="f7 cf bg5 bor-r60 pd10-100 close share_btn" href="javascript:;"><?=__('确定')?></a>
            </div>
        </div>
    </div>
    <% } %>
</script>

<script type="text/html" id="detail_main">
<% if( data ) { %>
    <div class="flex-sb f3 c1e pd65">
        <div></div>
        <div onclick="showCenter('activity_main')"><?=__('砍价免费拿')?>活动规则</div>
    </div>
    <div class="plr65">
        <div class="bs-card tc">
            <div class="borb-d1 pd65">
                <div class="bs-card-img">
                    <% if( data.user_is_initiator == '1' ){ %>
                        <a href="../../member/member.html"><img src="<%=data.user_avatar%>" alt=""></a>
                    <% } else {  %>
                        <a href="javascript:;"><img src="<%=data.user_avatar%>" alt=""></a>
                    <% } %>
                </div>
                <div class="f4 c1e"><%=data.user_name%></div>
                <div class="f8 c26"><?=__('发现一件好东西，一起砍价')?> <span class="c5"><%=data.ac_mix_limit_price%><?=__('元')?></span> <?=__('拿')?></div>
                <div class="f3 c1e"><?=__('每天限量好货等你来拿')?></div>
            </div>
            <div>
                <a class="flex-sb ptb65 plr2" href="javascript:;">
                    <div class="wh346 flex-fb346 img-w100">
                        <img src="<%=data.product_image%>" alt="">
                    </div>
                    <div class="flex-sb flex-dc w100 flex-overflow tl plr65">
                        <div>
                            <div class="f6 c26 ellipsis1"><%=data.product_name%>
                            </div>
                            <div class="f2 ca ellipsis2"><%=data.product_name%></div>
                        </div>
                        <div class="flex-sb flex-ye">
                            <div class="f6 c5 ellipsis1"><?=__('原价')?> <span class="fw600">￥<%=data.ac_sale_price%></span></div>
                            <div class="f2 c79 ellipsis1"><%=data.activity_part_num%>人已<%=data.ac_mix_limit_price%><?=__('元拿')?></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <% if( data.ac_status == '1' ) { %>
    <div class="pdt65">
        <div class="f8 c26 tc " id="cut_tips"><?=__('已砍')?> <span class="c5"><%=data.ac_cut_price%></span> <?=__('元')?>，<?=__('只差')?> <span class="c5"><%=data.cutprice_rest%></span> <?=__('元了')?></div>
    </div>
    <% } %>
    <div class="plr65 tc pdt65" id="bind_main">
        <% if( data.user_is_initiator ){ %>
            <% if(  data.ac_status == 2 ) { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" onclick="confirm()">
                <?=__('砍价完成，立即出手')?>
            </a>
            <% } else if( data.ac_status == 4 ) { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" onclick="toPay(<%=data.order_id%>, 'member_buy', 'pay')">
                <?=__('砍价完成，确认付款')?>
            </a>
            <% } else if( data.ac_status == 5 ) { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="../member/order_detail.html?order_id=<%=data.order_id%>" >
                <?=__('砍价完成，查看订单')?>
            </a>
            <% } else if( data.ac_status == 3 ) { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" >
                <?=__('砍价失败')?>
            </a>
            <% } else { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" onclick="shareBox()">
                <?=__('分享给好友，帮我砍价')?>
            </a>
            <% } %>
        <% } else { %>
            <% if( data.ac_status >= 3 ) { %>
             <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" >
                <?=__('帮砍已结束')?>
            </a>
            <a class="flex-center ptb21 f7 cf bg5 bor-r60" href="cutprice_list.html"><?=__('我也要砍价')?></a>
            <% } else { %>
            <% if( data.user_help_parted ) { %>
            <a class="flex-center ptb21 f7 cf bg5 bor-r60" href="cutprice_list.html" ><?=__('我也要砍价')?></a>
            <% } else { %>
            <a id="hand" class="flex-center ptb21 f7 cf bg5 bor-r60" href="javascript:;" onclick="helpCutprice(<%=data.ac_id%>)">
                <?=__('帮好友砍一刀')?>
            </a>
            <% } %>
            <% } %>
        <% } %>
        <% if( data.ac_status == '1' ) { %>
        <div class="progress-wrap">
            <div class="progress-content bg5" style="width: <%=data.cutprice_progress%>%"></div>
        </div>

        <div class="f3 c26"><?=__('还剩')?>
            <span class="c5 timeCount" data-end="<%=data.activity_endtime%>">
                <em class="day" >00</em>:
                <em class="hour">00</em>:
                <em class="mini">00</em>:
                <em class="sec" >00</em>
             </span> <?=__('结束，赶快砍价吧')?>
        </div>
        <% } %>

    </div>

    <div style="border-top: .022rem solid #d1d1d1;margin-top: .5rem;">
        <ul class="plr65" id="help_list">
        <% if( data.user_help ) { %>
        <% var user_help = data.user_help %>

            <% for( var i = 0; i < user_help.length; i++ ) { %>
            <li>
                <a class="ptb21 flex-sb flex-ycenter" href="javascript:;">
                    <div class="flex-xsycenter">
                        <div class="wh148 flex-fb148 img-w100 mr40">
                            <img src="<%=user_help[i].user_avatar%>" alt="">
                        </div>
                        <div>
                            <div class="f4 c26 lab"><%=user_help[i].user_name%></div>
                            <div class="f2 c88"><%=user_help[i].ach_datetime.substring(0,10)%><span class="ml44"><%=user_help[i].ach_datetime.substring(10,19)%></span></div>
                        </div>
                    </div>
                    <div class="flex-sb ">
                        <div class="help_cut">
                            <% for( var j = 0 ;j < user_help[i].ach_times;j++ ) { %>
                            <span class="icon icon-killfbg"></span>
                            <% } %>
                        </div>
                        <div class="f5 c26 flex-ycenter"><span class="item"<?=__('帮砍')?>> <em class="c5 help_price"><%=user_help[i].ach_price%></em> <?=__('元')?></span></div>
                    </div>
                </a>
            </li>
            <% } %>

        <% } %>
        </ul>
    </div>
<% } %>

</script>

<!--有找人帮砍的页面请添加此段-->
<div data-role="mask" data-mask="help" id="mask_help" class="mask_help">
    <div class="help_pic"></div>
</div>

<!--新增收货地址Begin-->
<div id="new-address-wrapper" class="nctouch-full-mask hide">
    <div class="nctouch-full-mask-bg"></div>
    <div class="nctouch-full-mask-block">
        <div class="title bg6">
            <header class="bar bar-nav bor-none bg6 ">
                <div class="header-l">
                    <a href="javascript:;" class="header-back">
                        <span class="icon icon-arrow-left"></span>
                    </a>
                </div>
                <h1 class="title"><?=__('新增收货地址')?></h1>
            </header>
        </div>
        <div class="nctouch-main-layout" id="new-address-scroll" style="margin-top: 2rem">
            <div class="nctouch-inp-con">
                <form id="add_address_form">
                    <div class="page">
                        <div class="list-block">
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><?=__('收货人')?></div>
                                            <div class="item-input">
                                                <input type="text" id="true_name" name="true_name" placeholder="<?=__('收货人姓名')?>">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><?=__('手机号码')?></div>
                                            <div class="item-input">
                                                <input type="text" id="mob_phone" name="mob_phone" placeholder="<?=__('你的电话')?>">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content" id="select_wrap">
                                        <div class="item-inner navigate">
                                            <div class="item-title label"><?=__('所在城市')?></div>
                                            <div class="item-input">
                                                <input type="text" id="district_info" name="district_info" readonly placeholder="<?=__('选择您所在的城市')?>">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label"><?=__('收货地址')?></div>
                                            <div class="item-input h195">
                                                <textarea name="address" id="address" rows="2" placeholder="<?=__('请输入详细地址，如街道、小区、门牌、 楼栋、单元室')?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label"><?=__('邮政编码')?></div>
                                        <div class="item-input">
                                            <input type="text" id="ud_postalcode" name="ud_postalcode" placeholder="<?=__('邮政编码')?>">
                                        </div>
                                    </div>

                                </li>
                                <li class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title"><?=__('设置默认地址')?></div>
                                        <div class="item-after"><span class="badge" onclick="toggleActive(this)"><?=__('开关')?></span></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="main-btn-wrap pd65">
                            <span class="main-btn"><?=__('保存收货地址')?></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--新增收货地址End-->


 <!--选择收货地址-->
<div class="ui-bottom-mask hidden " id="select_address">
    <div class="ui-bottom-mask-bg"></div>
    <div class="ui-bottom-mask-block bor-rt">
        <div class="ui-bottom-mask-tip hidden"><i></i></div>
        <a href="javascript:void(0);" class="ui-bottom-mask-close close"><i></i></a>
        <div class="ui-bottom-mask-content">
            <div class="ui-bottom-mask-rolling">
                <div class="">
                    <div class="ptb42 f6 c26 borb-d1 tc">
                        <?=__('选择收货地址')?>
                    </div>
                    <div class="">
                        <ul id="address_list">

                        </ul>
                    </div>
                    <div class="flex-xsycenter navigate borb-d1 pd65" onclick="showAddressAddWrap()">
                        <span class="icon icon-add mr2"></span>
                        <div class="f4 c2b"><?=__('新增收货地址')?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--收货地址弹窗-->
<div class="ui-center-mask hidden" id="popup_address">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content" id="confirm_address">

        </div>
    </div>
</div>


<!--砍价提示-->
<div class="ui-center-mask hidden" id="message_tip1">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content" >
            <a href="javascript:void(0);" class="ui-bottom-mask-close close" onclick="hiddenBottom('message_tip1')"><i></i></a>
            <div class="f5  pd65">
                 <div class="flex-xsycenter">
                    <div class="flex-center w284 img-w100 bor-r22 user-img-ab">
                        <img src="../../images/fkg/avatar2.png" alt="">
                    </div>
                </div>

                <div class="content-message mt2 tc">
                    <div class="f2 c9 pd2"><?=__('成功帮好友砍价0元')?></div>
                    <div class="f6"><?=__('你也可以砍价免费拿哦，快去挑选心仪的商品吧')?>~</div>
                </div>

                <div class="flex-box f6 flex-center tc">
                    <div class="ptb42 close hand_btn"><a class="sbtn" href="cutprice_list.html"><?=__('我也来砍价试试')?></a></div>
                </div>

            </div>
        </div>
    </div>
</div>



<!--达到-->
<div class="ui-center-mask hidden" id="message_tip3">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content" >
            <a href="javascript:void(0);" class="ui-bottom-mask-close close" onclick="hiddenBottom('message_tip3')"><i></i></a>
            <div class="f5  pd65">
                 <div class="flex-xsycenter">
                    <div class="flex-center w284 img-w100 bor-r22 user-img-ab">
                        <img src="../../images/fkg/avatar2.png" alt="">
                    </div>
                </div>

                <div class="content-message mt2 tc">
                    <div class="f6"><?=__('您今天已经达到砍价的次数限制了哦，明天继续试试吧')?>~</div>
                </div>

                <div class="flex-box f6 flex-center tc">
                    <div class="ptb42 close"><a class="sbtn" href="cutprice_list.html"><?=__('我要到处逛逛')?>~</a></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--活动规则-->
<div class="ui-center-mask hidden" id="activity_main">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content" >
            <a href="javascript:void(0);" class="ui-bottom-mask-close close" onclick="hiddenBottom('activity_main')"><i></i></a>
            <div class="f6 fw600 tc pd65 borb-d1"><?=__('活动规则')?></div>
            <div class="f5  pd65" id="activity_rules">
            </div>
        </div>
    </div>
</div>

<!--蜂窝担保-->
<div class="ui-center-mask hidden" id="fkgou_assure">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content">
            <a href="javascript:void(0);" class="ui-bottom-mask-close close" onclick="hiddenBottom('fkgou_assure')"><i></i></a>
            <div class="f6 fw600 tc pd65 borb-d1"><?=__('蜂窝担保')?></div>
            <div class="f5  pd65" id="activity_assure">

            </div>
        </div>
    </div>
</div>

<!--底部总金额固定层End-->
<div class="sstouch-bottom-mask">
    <div class="sstouch-bottom-mask-bg"></div>
    <div class="sstouch-bottom-mask-block">
      <div class="sstouch-bottom-mask-tip"><i></i><?=__('点击此处返回')?></div>
      <div class="sstouch-bottom-mask-top">
        <p class="sstouch-cart-num"><?=__('本次交易需在线支付')?><em id="onlineTotal">0.00
        <p style="display:none" id="isPayed"></p>
        <a href="javascript:void(0);" class="sstouch-bottom-mask-close"><i></i></a> </div>
      <div class="sstouch-inp-con sstouch-inp-cart">
        <ul class="form-box" id="internalPay">
          <p class="rpt_error_tip" style="display:none;color:red;"></p>
          <li class="form-item" id="wrapperUseRCBpay">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
                <?=__('充值卡支付')?> <span class="power"><i></i></span> </label>
              <p><?=__('可用充值卡余额')?> ￥<em id="availableRcBalance"></em></p>
            </div>
          </li>
          <li class="form-item" id="wrapperUsePDpy">
            <div class="input-box pl5">
              <label>
                <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
                <?=__('预存款支付')?> <span class="power"><i></i></span> </label>
              <p><?=__('可用预存款余额')?> ￥<em id="availablePredeposit"></em></p>
            </div>
          </li>

            <li class="form-item" id="wrapperUsePoints">
                <div class="input-box pl5">
                    <label>

                        <input type="checkbox" class="checkbox" id="usePoints" autocomplete="off" />
                        <?=__('积&nbsp;&nbsp;分&nbsp;&nbsp;')?><?=__('支付')?> <span class="power"><i></i></span>
                    </label>
                    <p><?=__('可抵资金')?> ￥<em id="availablePointsMoney"></em>   <?=__('当前积分')?><em id="availablePoints"></em></p>
                </div>
            </li>


            <li class="form-item" id="wrapperUseCredit">
                <div class="input-box pl5">
                    <label>
                        <input type="checkbox" class="checkbox" id="useCredit" autocomplete="off" />
                        <?=__('信 用 支 付')?> <span class="power"><i></i></span>
                    </label>
                    <p><?=__('可用信用余额')?> ￥<em id="availableCredit"></em></p>
                </div>
            </li>
          <li class="form-item" id="wrapperPaymentPassword" style="display:none">
            <div class="input-box"> <span class="txt"><?=__('输入支付密码')?></span>
              <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
              <span class="input-del"></span></div>
            <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i><?=__('尚未设置')?></a> </li>
        </ul>
        <div class="sstouch-pay">
          <div class="spacing-div"><span><?=__('在线支付方式')?></span></div>
          <div class="pay-sel">
            <label style="display:none">
              <input type="radio" name="payment_channel_code" class="checkbox" id="alipay" autocomplete="off" />
              <span class="alipay"><?=__('支付宝')?></span></label>
            <label style="display:none">
              <input type="radio" name="payment_channel_code" class="checkbox" id="wx_native" autocomplete="off" />
              <span class="wxpay"><?=__('微信')?></span></label>
          </div>
        </div>
        <div class="pay-btn"> <a href="javascript:void(0);" id="toPay" class="btn-l"><?=__('确认支付')?></a> </div>
      </div>
    </div>
  </div>

<script type="text/html" id="address_main">
    <% if( address ) { %>
    <% for( var i = 0; i < address.length; i++ ) { %>
     <li>
        <a class="box pd65 f4 c2b borb-d1" href="javascript:;" onclick="selectAddress(<%=address[i].ud_id%>)">
            <div>
                <div class="in-b"><?=__('收货人')?>：<%=address[i].da_name%></div>
                <div class="in-b"><%=address[i].ud_mobile%></div>
            </div>
            <div class="flex-sb">
                <?=__('收货地址')?>：<%=address[i].ud_province%><%=address[i].ud_city%><%=address[i].ud_county%> <%=address[i].ud_address%>
            </div>
        </a>
    </li>
    <% } %>
    <% } %>
</script>

<script type="text/html" id="address_dialog">
    <div class="pd65 borb-d1 c1e">
        <div class="f6 fw600 tc"><?=__('请确认您的收货地址')?></div>
        <div class="flex-center f4 tc">
            <%=ud_province%><%=ud_city%><%=ud_county%> <%=ud_address%> <%=ud_mobile%> <%=ud_name%>
        </div>
    </div>
    <div class="flex-box f6 flex-center tc">
        <div class="ptb42 borr1 close"><a class="c1e" href="javascript:;" onclick=""><?=__('取消')?></a></div>
        <div class=" ptb42"><a class="c1" href="javascript:;" onclick="addressCallback(<%=ud_id%>)"><?=__('确认')?></a></div>
    </div>
</script>



<script type="text/html" id="help_item">
<% if( data ) { %>
    <li>
        <a class="ptb21 flex-sb flex-ycenter" href="javascript:;">
            <div class="flex-xsycenter">
                <div class="wh148 flex-fb148 img-w100 mr40">
                    <img src="<%=data.user_avatar%>" alt="">
                </div>
                <div>
                    <div class="f4 c26"><%=data.user_name%></div>
                    <div class="f2 c88"><%=data.ach_datetime.substring(0,10)%><span class="ml44"><%=data.ach_datetime.substring(10,19)%></span></div>
                </div>
            </div>
            <div class="flex-sb ">
                <div class="">
                    <span class="icon icon-killfbg"></span>
                </div>
                <div class="f6 c26 flex-ycenter"><span class="item"><?=__('帮砍')?> <em class="c5"><%=data.ach_price%></em> <?=__('元')?></span></div>
            </div>
        </a>
    </li>
<% } %>
</script>


<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/public.js"></script>
<script type="text/javascript" src="../../js/picker.min.js"></script>
<script type="text/javascript" src="../../js/city.json"></script>
<script type="text/javascript" src="../../js/address_picker.js"></script>
<script type="text/javascript" src="../../js/tmpl/order_payment_common.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/cutprice_detail.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
