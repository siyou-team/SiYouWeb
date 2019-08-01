<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-touch-fullscreen" content="yes" />

    <meta name="format-detection" content="telephone=no"/>

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <meta name="format-detection" content="telephone=no" />

    <meta name="msapplication-tap-highlight" content="no" />

    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />

    <title><?=('充值确认')?></title>

    <link rel="stylesheet" type="text/css" href="../../css/base.css">

    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">

</head>

<body>

<header id="header">

    <div class="header-wrap">

        <div class="header-l"><a href="member.html"><i class="zc zc-back back"></i></a></div>

        <div class="header-tab" style="font-size:20px;"> <?=('账户充值')?></div>

        <div class="header-r"><a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a> </div>

    </div>

    <div class="sstouch-nav-layout">

        <div class="sstouch-nav-menu"> <span class="arrow"></span>

          <ul>
            <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
            <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
            <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
            <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
            <li><a href="../cart_list.html"><i class="zc zc-cart cart"></i><?=__('购物车')?><sup></sup></a></li>
            <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
          </ul>

        </div>

    </div>

</header>

<div class="sstouch-main-layout">

    <div class="sstouch-asset-info">

        <div class="container rcard" style="height:3px;"> <i class="icon"></i>

            <dl class="rule">



            </dl>

        </div>

    </div>

    <div class="sstouch-inp-con" style="padding-top: 20px;" id="rechargeinfo">
        <script type="text/html" id="rechargeinfo-tmpl">

            <ul class="form-box">

                <li class="form-item">

                    <h4><?=__('充值订单')?>：</h4>

                    <div class="input-box" style="line-height: 1.95rem;">
                        <%=pay_info.pay_sn %> </div>

                </li>
                <li class="form-item">

                    <h4><?=__('充值金额')?>：</h4>

                    <div class="input-box"  style="line-height: 1.95rem;">
                        <%=pay_info.pay_amount %><?=__('元')?></div>

                </li>

            </ul>

            <%if(pay_info.payment_list.length > 0) {%>
            <%for(var p = 0;p < pay_info.payment_list.length;p++){%>
            <% if ('money' != pay_info.payment_list[p].payment_channel_code){ %>
            <div class="form-btn ok">
                <a href="<%=pay_url%>&key=<%=key %>&pay_sn=<%=pay_info.pay_sn %>&payment_channel_code=<%=pay_info.payment_list[p].payment_channel_code%>" class="btn" >
                        <%=pay_info.payment_list[p].payment_channel_name%>
                </a>
            </div>
            <% } %>
            <%}}%>


        </script>

    </div>

</div>
<script> var navigate_id ="5";</script>
<footer id="footer" class="bottom"></footer>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>



<script type="text/javascript" src="../../js/tmpl/rechargeinfo.js"></script>

<script type="text/javascript" src="../../js/tmpl/footer.js"></script>

</body>

</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
