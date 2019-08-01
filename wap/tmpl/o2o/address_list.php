<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html>
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
    <meta name="author" content="ShopNC">
    <meta name="copyright" content="ShopNC Inc. All Rights Reserved">
    <title><?=__('选择地址')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_o2o.css">
    <link rel="stylesheet" type="text/css" href="../../css/idangerous.swiper.css">
</head>

<body>
<div class="adr-box a0">
    <div class="adr-1 adr2">
        <input class="adr-input de-Width" maxlength="50" type="text" placeholder="<?=__('选择城市、小区、写字楼、学校')?>">
    </div>
    <div class="d4">
        <div class="d5" id="get_location"><i></i><p><?=__('点击定位当前地点')?></p></div>
        <div class="adr-notext" style="display: none;"><?=__('无法获取您的位置信息')?><br<?=__('请手动输入地址')?>></div>
        <div class="adr-list" style="display: none;">
        </div>
    </div>
</div>
</body>
<script type="text/html" id="address_list_tpl">
    <% var acount = address_list.length; %>
    <% if(acount > 0){%>
    <div class="xk">
        <p class="xn"><?=__('我的收货地址')?></p>
        <div class="xm ">
            <ul>
                <% for(var i=0; i<acount;i++){ %>
                <li addressid="<%=address_list[i].address_id%>" addresslat="<%=address_list[i].area_lat%>" addresslng="<%=address_list[i].area_lng%>" city_id="<%=address_list[i].city_id%>" district_id="<%=address_list[i].area_id%>" current_area="<%=address_list[i].address%>" area_info="<%=address_list[i].area_info%>">
                    <p class="xp a2">
            <span class="xo">
              <em><%=address_list[i].true_name%></em>
              <b><%=address_list[i].mob_phone%></b>
            </span>
                        <span class="tw"><%=address_list[i].area_info%><%=address_list[i].address%></span>
                    </p>
                </li>
                <% }%>
            </ul>
        </div>
    </div>
    <% } %>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/dhome/uptop.js"></script>
<script type="text/javascript" src="../../js/tmpl/dhome/address_list.js"></script>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
