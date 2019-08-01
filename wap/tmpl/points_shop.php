<?php
include __DIR__ . '/../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
    <title><?=__('积分中心')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_products_list.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../css/integral.css">
    <style>
        .s-dialog-wrapper{margin-left:-5.8rem !important;top:38% !important;}
        *,*:after,*:before{outline:none}
    </style>
</head>
<body>
<div id="header" class="sstouch-product-header fixed">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)"><i class="zc zc-back back"></i></a>
        </div>
        <div class="header-title">
            <h1><?=__('积分中心')?></h1>
        </div>
        <div class="header-r">
            <a id="header-nav" href="javascript:void(0);"><i class="zc zc-more more"></i><sup></sup></a>
        </div>
    </div>
    <div class="sstouch-nav-layout">
        <div class="sstouch-nav-menu"> <span class="arrow"></span>
          <ul>
            <li><a href="../index.html"><i class="zc zc-home home"></i><?=__('首页')?></a></li>
            <li><a href="search.html"><i class="zc zc-search search"></i><?=__('搜索')?></a></li>
            <li><a href="product_first_categroy.html"><i class="zc zc-categroy categroy"></i><?=__('分类')?></a></li>
            <li><a href="javascript:void(0);"><i class="zc zc-message message"></i><?=__('消息')?><sup></sup></a></li>
            <li><a href="member/member.html"><i class="zc zc-member member"></i><?=__('我的商城')?></a></li>
          </ul>
        </div>
    </div>
</div>
<div class="" id="points_body">
    <!--<div class="integral-01" id="access_info"></div>-->
    <ul class="integral-data">
        <li style="width: 49%;"><a href="member/pointslog_list.html"><h1 id="user_points" data_type="point">0</h1><h2><?=__('我的积分')?></h2></a></li>
        <li style="width: 49%;"><a href="member/voucher_list.html"><h1 id="user_voucher" data_type="voucher">0</h1><h2><?=__('可用优惠券')?></h2></a></li>
        <li class="redpack redpacket-enable hide"><a href="member/redpacket_list.html"><h1 id="user_redpack" data_type="redpacket">0</h1><h2><?=__('可用红包')?></h2></a></li>
    </ul>
</div>
<footer id="footer" class="bottom"></footer>
</body>

<script type="text/html" id="home_body">
    <% var voucher_list =  data.voucherlist; %>
    <% var points_product_list = data.product_rows; %>
    <% var redpacket_list = []; %>
    <% var StateCode = getStateCode(); %>
    <% if(voucher_list.length > 0 || points_product_list.length > 0 || redpacket_list.length > 0){ %>
    <% if(voucher_list.length > 0){ %>
    <div class="integral-02">
        <a href="points_list_voucher.html" class="top-link"><img src="../images/integral/daijinquan.png"/></a>
        <ul class="integral-list">
            <%for(i=0;i<voucher_list.length;i++){ var voucher = voucher_list[i];%>
            <li activity_id="<%=voucher.activity_id%>" voucher_price="<%=voucher.activity_rule.voucher_price%>">
                <div class="top-title">
                    <h1 class="fl"><b><%=voucher_list[i].store_name%></b>&nbsp;&nbsp;<%=voucher_list[i].activity_title%></h1>
                    <% if(false){ %>
                    <h2 class="fr"><i class="red-word"><?=__('等级要求')?></i>&nbsp;<span class="level">Lv.<b><%=voucher_list[i].voucher_t_mgradelimit%></b></span></h2>
                    <% } %>
                </div>
                <div class="top-content">
                    <img class="fl" src="<%= voucher.activity_rule.voucher_image %>"/>
                    <div class="fl">
                        <span class="red-word">&yen;<b><%= voucher.activity_rule.voucher_price %></b></span>
                        <span class="red-word"><?=__('购物满')?><%= voucher.activity_rule.voucher_price %><?=__('元可用')?></span>
                        <span class="gray-word"><?=__('有效期至')?><%= voucher.activity_endtime%></span>
                        <% if (voucher.activity_type == getStateCode().GET_VOUCHER_BY_POINT) { %>
                        <span class="red-word" style="font-size:0.7rem"><?=__('需')?><%=  voucher.activity_rule.requirement.points.needed %><?=__('积分')?></span>
                        <% } else { %>
                        <span class="red-word" style="font-size:0.7rem"><?=__('免费兑换')?></span>
                        <% }  %>
                        <span class="gray-word"><%= voucher.activity_rule.voucher_quantity_use ? voucher.activity_rule.voucher_quantity_use : 0 %><?=__('人已兑换')?></span>
                    </div>
                    <% if(voucher.if_gain) { %>
                    <a class="btn key integral-more get_voucher" href="javascript:void(0);"><?=__('立即兑换')?></a>
                    <% } else { %>
                    <a href="javascript:void(0)" class="btn integral-more"><?=__('已经兑换')?></a>
                    <% } %>
                </div>
            </li>
            <%}%>
        </ul>
        <div class="clear"></div>
    </div>
    <% } %>
    <% if(points_product_list.length > 0){ %>
    <div class="integral-02">
        <a href="points_list_item.html" class="top-link">
            <img src="../images/integral/lipin.png" />
        </a>
        <ul class="integral-list">
            <%for(i=0,c=points_product_list.length;i<c;i++){%>
            <li>
                <a href="points_detial.html?activity_item_id=<%=points_product_list[i].activity_item_id%>">
                    <div class="top-content">
                        <img class="fl" src="<%= points_product_list[i].product_image %>" alt=""/>
                        <div class="fl">
                            <span class="black-word"><strong><%= points_product_list[i].product_item_name %></strong></span>
                            <span class="gray-word line-t" style="margin-top:0.6rem">&yen;<b style="font-weight:normal"><%=points_product_list[i].product_unit_price%></b></span>
                            <span class="red-word" style="font-size:0.7rem;margin-top:0.4rem"><?=__('需')?><%=points_product_list[i].activity_points_num%><?=__('积分')?></span>
                        </div>
                        <% if(points_product_list[i].activity_level_limits > 0){ %>
                        <div class="level-b"><i class="red-word"><?=__('等级要求')?></i>&nbsp;<span class="level">Lv.<b><%= points_product_list[i].activity_level_limits %></b></span></div>
                        <% } %>
                    </div>
                </a>
            </li>
            <% } %>
        </ul>
        <div class="clear"></div>
    </div>
    <% } %>
    <% if(redpacket_list.length > 0){ %>
    <div class="integral-02">
        <a href="point_list.redpaket.html" class="top-link"><img src="../images/integral/hongbao.png"/></a>
        <ul class="integral-list">
            <%for(i=0,c=redpacket_list.length;i<c;i++){%>
            <li redpackte_id="<%=redpacket_list[i].rpacket_t_id%>" rpacket_t_price="<%=redpacket_list[i].rpacket_t_price%>" rpacket_t_limit="<%=redpacket_list[i].rpacket_t_limit%>" rpacket_t_end_date="<%=redpacket_list[i].rpacket_t_end_date%>" rpacket_t_points="<%=redpacket_list[i].rpacket_t_points%>" rpacket_t_giveout="<%=redpacket_list[i].rpacket_t_giveout%>" rpacket_t_eachlimit="<%=redpacket_list[i].rpacket_t_eachlimit%>" rpacket_t_total="<%=redpacket_list[i].rpacket_t_total%>" rpacket_t_mgradelimit="<%=redpacket_list[i].rpacket_t_mgradelimit%>">
                <div class="top-title">
                    <h1 class="fl"><b><%=redpacket_list[i].rpacket_t_title%></b></h1>
                    <% if(redpacket_list[i].rpacket_t_mgradelimit > 0){ %>
                    <h2 class="fr"><i class="red-word"><?=__('等级要求')?></i>&nbsp;<span class="level">Lv.<b><%=redpacket_list[i].rpacket_t_mgradelimit%></b></span></h2>
                    <% } %>
                </div>
                <div class="top-content">
                    <img class="fl" src="<%=redpacket_list[i].rpacket_t_customimg_url%>"/>
                    <div class="fl">
                        <span class="red-word">&yen;<b><%=redpacket_list[i].rpacket_t_price%></b></span>
                        <span class="red-word"><?=__('购物满')?><%=redpacket_list[i].rpacket_t_limit%><?=__('元可用')?></span>
                        <span class="gray-word"><?=__('有效期至')?><%=redpacket_list[i].rpacket_t_end_date%></span>
                        <span class="red-word" style="font-size:0.7rem"><?=__('需')?><%=redpacket_list[i].rpacket_t_points%><?=__('积分</span>')?>
                        <span class="gray-word"><%=redpacket_list[i].rpacket_t_giveout%><?=__('人已兑换')?></span>
                    </div>
                    <a class="integral-more get_redpacket" href="javascript:void(0);"></a>
                </div>
            </li>
            <% } %>
        </ul>
        <div class="clear"></div>
    </div>
    <% } %>
    <% }else{ %>
    <div class="integral-02">
        <div class="sstouch-norecord order" style="margin:0 0 0 -5rem;">
            <div class="norecord-ico"><i></i></div>
            <dl>
                <dt><?=__('暂时没有可兑换产品')?></dt>
                <dd><?=__('可以去看看哪些想要买的')?></dd>
            </dl>
            <a href="../index.html" class="btn"><?=__('随便逛逛')?></a>
        </div>
    </div>
    <% } %>
</script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script type="text/javascript" src="../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../js/tmpl/points_shop.js"></script>
</html>
<?php
include __DIR__ . '/../includes/footer.php';
?>