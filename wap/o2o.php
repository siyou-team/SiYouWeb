<?php
include __DIR__ . '/includes/header.php';
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
    <title>附近的门店</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/sstouch_o2o.css">
</head>

<body>
<div class="nctouch-home-top fixed-Width">
    <div class="header">
        <a class="location"  href="./tmpl/dhome/address_list.html">
            <span></span><i class="icon-down"></i>
        </a>
    <span class="search-ipt">
      <a class="search-icon"></a>搜索附近商品和门店
    </span>
        <div class="header-right">
            <a id="header-nav" href="./tmpl/member/chat_list.html"><i class="message"></i>
                <p>消息</p>
                <sup></sup>
            </a>
        </div>
    </div>
    <div id="slider" class="swipe">
        <div class="swipe-wrap">
        </div>
    </div>
</div>
<div class="index-con-wrap" style="max-width:640px;margin: 0 auto;">
    <div class="index-con-shop mtop10">
        <div class="title"><span>附近的门店</span></div>
        <ul class="index-shop-ul" id="chain_list"></ul>
        <div class="dp-more-shop" style="display: none;">
            <p><i class="bb"></i>没有更多门店啦<i class="bc"></i></p>
        </div>
    </div>
</div>
<footer class="f-box">
    <a class="index current" href="./dhome.html">首页</a>
    <a class="classify" href="./tmpl/dhome/category.html">分类</a>
    <a class="orderList" href="./tmpl/member/order_list.html?chain=1">订单</a>
    <a class="mine" href="./tmpl/member/member.html">我的</a>
</footer>
<script type="text/html" id="adv_list_tpl">
    <% for (var i in swipe_list) { %>
    <div class="swiper-slide">
        <a href="<%= swipe_list[i].url %>">
            <img src="<%= swipe_list[i].image %>" alt="<%= swipe_list[i].data %>">
        </a>
    </div>
    <% } %>
</script>
<script type="text/html" id="chain_list_tpl">
    <% var chain_list = datas.chain_list; %>
    <% chain_len = chain_list.length; %>
    <% if(chain_len > 0){%>
    <%for(i=0;i<chain_len;i++){%>
    <li class="dp">
        <div class="dp-box">
            <div class="dp-inner">
                <a class="dp-link" href="./tmpl/dhome/store.html?chain_id=<%=chain_list[i].chain_id%>">
            <span class="clearfix a8o">
              <img class="d9" src="<%=chain_list[i].chain_img%>">
            </span>
                </a>
                <div class="dp-link-rt">
                    <a class="dp-link-rt-a1" href="./tmpl/dhome/store.html?chain_id=<%=chain_list[i].chain_id%>">
                        <div class="dp-title clearfix">
                            <h2 class=""><%=chain_list[i].chain_name%></h2>
                        </div>
                        <div class="dp-star">
                            <p class="dp-star-p2">商品<%=chain_list[i].goods_amount%>个</p>
                            <p class="dp-star-p2"><span class="dp-line"></span>成交<%=chain_list[i].order_amount%>单</p>
                        </div>
              <span class="dp-txt2">
                <%=chain_list[i].start_amount_price%>元起送，
                <%if(chain_list[i].gps >= 1000){%>
                距您<%=(chain_list[i].gps/1000.0).toFixed(1) %>km，
                <%}else{%>
                距您<%=chain_list[i].gps%>m，
                <%}%>
                <%if(chain_list[i].transport_freight > 0){%>
                基础运费<%=chain_list[i].transport_freight%>元
                <%}else{%>
                免配送费
                <%}%>
              </span>
                    </a>
                    <div class="dp-link-rtlist">
                    </div>
                    <% goods_list = chain_list[i].goods_list;%>
                    <% g_count = (goods_list.length > 0 && goods_list.length > 4) ? 4 : goods_list.length;%>
                    <% if(g_count > 0){ %>
                    <div class="dp-list-box">
                        <% for(var j=0;j<g_count;j++){%>
                        <a class="dp-a" href="./tmpl/dhome/goods_detail.html?goods_id=<%=goods_list[j].goods_id%>&chain_id=<%=chain_list[i].chain_id%>">
                <span class="dp-sapn">
                  <img src="<%=goods_list[j].goods_image%>">
                </span>
                            <span class="dp-sapn-price">￥<%=goods_list[j].chain_price%></span>
                        </a>
                        <% } %>
                    </div>
                    <% }%>
                </div>
            </div>
        </div>
        <% if(chain_list[i].is_new == 1){ %>
        <span class="new_store"></span>
        <% } %>
    </li>
    <% } %>
    <% } %>
</script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/libs/lib.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/libs/swipe.js"></script>
<script type="text/javascript" src="js/tmpl/dhome/uptop.js"></script>
<script type="text/javascript" src="js/tmpl/dhome/o2o.js"></script>
</body>
</html>
<?php
include __DIR__ . '/includes/footer.php';
?>
