<?php
include __DIR__ . '/../includes/header.php';
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
    <title><?=__('门店地图')?></title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/sstouch_chat.css">
    <script type="text/javascript" src="//api.map.baidu.com/api?v=3.0&ak=Yi9XWlwa7sUGSuKGDiPBrS261bMeu6YF"></script>
</head>
<body>
<header id="header" class="fixed fixed-Width">
    <div class="header-wrap">
        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('门店地图')?></h1>
        </div>
        <div class="header-r">&nbsp;</div>
    </div>
</header>
<div class="map-wrap" id="baidu_map">
</div>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/libs/lib.min.js"></script><script type="text/javascript" src="../js/common.js"></script>
</body>
</html>
<script type="text/javascript">
    var chain_id = getQueryString("chain_id");
    var map_info = {};
    var baidu_map = {};
    var cur_point = {};
    $.ajax({
        type: 'post',
        url: SYS.URL.store.getChain,
        data: {chain_id: chain_id},
        dataType: 'json',
        success: function(result) {
            map_info = result.data;
            get_map();
        }
    });

    function local_city(cityResult){
        var center_point = cityResult.center;
        baidu_map.centerAndZoom(center_point, 16);
        var myGeo = new BMap.Geocoder();
        myGeo.getPoint(map_info.chain_address, function(point){
            if (point) {
                baidu_map.centerAndZoom(point, 16);
                cur_point = point;
            }else{
                //cur_point = center_point;
                cur_point = new BMap.Point(map_info.chain_lng, map_info.chain_lat);


            }
            select_district(cur_point);
        });
    }
    function select_district(obj) {
        baidu_map.clearOverlays();
        var point = new BMap.Point(obj.lng, obj.lat);
        var marker = new BMap.Marker(point);
        marker.setTitle(map_info.chain_name);
        baidu_map.addOverlay(marker);
        marker_info(marker,obj);
        baidu_map.setViewport([obj]);
    }
    function marker_info(marker,obj){//开启信息窗口
        marker.addEventListener("click", function(){
            var point = new BMap.Point(obj.lng, obj.lat);
            var opts = {
                'title': "<p style='font-size:12px;'>" + map_info.chain_name + '</p>'
            }
            var infoWindow = new BMap.InfoWindow("<p style='font-size:12px;'>地址："+map_info.chain_address+"</p>",opts);
            baidu_map.openInfoWindow(infoWindow,point);
        });
    }
    function baidu_init() {//初始化地图
        baidu_map = new BMap.Map("baidu_map", {enableMapClick:false});
        var city = new BMap.LocalCity();
        var top_left_navigation = new BMap.NavigationControl();
        var overView = new BMap.OverviewMapControl();
        baidu_map.enableScrollWheelZoom(true);
        baidu_map.enableDoubleClickZoom(true);
        city.get(local_city);
    }
    function get_map(){
        $('#baidu_map').css('width', screen.width);
        $('#baidu_map').css('height', screen.height);
        baidu_init();
    }
</script>
<?php
include __DIR__ . '/../includes/footer.php';
?>