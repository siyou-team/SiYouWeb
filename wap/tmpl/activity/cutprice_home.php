
<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
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
    <title><?=__('砍价活动')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/public.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/cutprice_list.css">
</head>
<body>
    <header class="head-fixed bg6" id="header">
        <div class="header-wrap">
            <div class="header-l">
                <a href="javascript:history.back(-1)">
                    <span class="icon icon-arrow-left"></span>
                </a>
            </div>
            <h1 class="title"><?=__('我得砍价')?></h1>
            <div class="header-r">
               <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup style="display: inline;"></sup></a>
            </div>
        </div>

        <div class="sstouch-nav-layout">
            <div class="sstouch-nav-menu">
                <span class="arrow"></span>
                <ul>
                    <li><a href="../../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
                    <li><a href="../search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
                    <li><a href="../product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
                    <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
                    <li><a href="../member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="page-content b200">
        <ul id="cutprice_list">
        </ul>
    </div>

    <footer class="bar bar-footer footer-wrap flex-box">
        <div class="bgf flex-center">
            <a class="f6 ca1" href="cutprice_list.html"><?=__('砍价商品')?></a>
        </div>
        <div class="bg5 flex-center">
            <a class="f6 cf" href="javascript:;"><?=__('我的砍价')?></a>
        </div>
    </footer>
</body>

<script type="text/html" id="cutprice_main">
    <%  var cutprice_list = data.items; %>
    <%  if( cutprice_list.length >0 ){ %>
    <%  for( var j = 0; j < cutprice_list.length; j++ ){ %>
        <li class="pd65">
            <a class="flex-sb borb-d1 flex-xsycenter" href="cutprice_detail.html?ac_id=<%=cutprice_list[j].ac_id%>">
                <div class="wh522 flex-fb522 img-w100 mb2 mimg">
                    <img src="<%=cutprice_list[j].product_image%>" alt="">
                </div>
                <div class="flex-sb flex-dc w100 flex-overflow">
                    <div>
                        <div class="f6 c26 ellipsis1">
                            <%=cutprice_list[j].product_name%>
                        </div>
                        <div class="f2 ca ellipsis2"><%=cutprice_list[j].product_tips%></div>
                    </div>
                    <div class="flex-sb flex-ye">
                        <div class="">
                            <div class="f2 c79 ellipsis1"><%= cutprice_list[j].activity_part_num%><?=__('人已')?><%= cutprice_list[j].ac_mix_limit_price%><?=__('元拿')?></div>
                            <div class="f6 c5 ellipsis1"><?=__('原价')?> <span class="fw600">￥<%=cutprice_list[j].ac_sale_price%></span></div>
                        </div>
                        <div class="flex-xsye">
                            <span class="icon icon-killpbg flex-xcenterye f3 cf"><%= cutprice_list[j].ac_status_t%></span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <% } %>
        <% if ( hasmore ) { %>
        <li class="loading">
            <div class="spinner"><i></i></div>
            <?=__('数据读取中')?>...
        </li>
        <% } %>

        <% } else { %>
        <div class="sstouch-norecord search">
            <div class="norecord-ico"><i></i></div>
                <dl>
                    <dt><?=__('没有找到任何相关信息')?></dt>
                </dl>
        </div>
        <% } %>
</script>


<!--信息提示-->
<div class="ui-center-mask hidden" id="bargain_dialog">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content">
            <a href="javascript:void(0);" class="ui-bottom-mask-close" onclick="hiddenCenter('bargain_dialog')"><i></i></a>
            <div class="c1e pdtb0">
                 <div class="flex-xsycenter">
                    <div class="flex-center w284 img-w100 bor-r22 user-img-ab">
                        <img id="user-img" src="../images/fkg/avatar2.png" alt="" >
                    </div>
                </div>
                <div class="flex-center f6 mt2 tc block">
                    <p><?=__('当前商品有正在开的团')?></p>
                     <p><?=__('快去砍价吧')?>~</p>
                </div>
            </div>
            <div class="flex-box f6 flex-center tc">
                <div class="ptb42 close"><a class="sbtn" href="javascript:;"><?=__('继续砍价')?></a></div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/public.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/cutprice_home.js"></script>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
