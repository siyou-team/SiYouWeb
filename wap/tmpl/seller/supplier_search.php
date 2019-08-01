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
<title><?=__('商品搜索')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <style>
        .header-inp .search-type{float:left;margin-right:.2rem;height: 1.4rem}
        .header-inp .search-type .search-title{}
        .header-inp .search-type .search-title{float: left;font-size:.6rem;height: 1rem;line-height: 1rem ;padding: 0.2rem 0;margin-left:.5rem;}
        .goods-class-sel{position: absolute;background: #373737;border-radius: 0.2rem;top: 1.5rem;width: 4rem;text-align: center;}
        .header-inp .search-input {padding-left: 0.2rem}
        .goods-class-sel li:nth-child(1) {
            border-top-left-radius: 0.2rem;
            border-top-right-radius: 0.2rem;
            /*margin:.2rem;*/
        }
        .goods-class-sel li i.icon {
            width: 0.8rem;
            height: 0.8rem;
            display: inline-block;
            vertical-align: middle;
            margin: 0 0.5rem 0 0;
            opacity: 1;
            float: none;
        }
        .goods-class-sel li {
            padding: 0.2rem 0;
        }
        .goods-class-sel li:nth-child(1) i.icon {
            background: url(../../images/icon-goods.png) no-repeat center;
            background-size: contain;
        }
        .goods-class-sel li span {
            color: #fff;
            font-size: 0.6rem;
            vertical-align: middle;
        }
        .goods-class-sel li:nth-child(2) {
             border-bottom-left-radius: 0.2rem;
             border-bottom-right-radius: 0.2rem;
         }
        .goods-class-sel li:nth-child(2) i.icon {
            background: url(../../images/icon-store.png) no-repeat center;
            background-size: contain;
        }
        .goods-class-sel li.active {
            background: #4e4e4e;
        }
        i.icon-drapdown {
            width: 20px;
            height: 1rem;
            display: inline-block;
            background: url(../../images/arrow-bottom.png) no-repeat center;
            background-size: contain;
            padding: 0.2rem 0;
        }
    </style>
</head>
<body>
<header id="header" class="appshow">
    <div class="header-wrap">
        <div class="header-l">
            <a href="javascript:history.go(-1)">
                <i class="zc zc-back back"></i>
            </a>
        </div>
        <div class="header-inp">
            <div class="search-type" >
                <div class='search-title'><?=__('商品')?></div>
                <i class="icon-drapdown"></i>
            </div>
            <ul class="goods-class-sel" style="display:none">
                <li class="search_kind"><i class="icon"></i><span><?=__('商品')?></span></li>
                <li class="search_kind active"><i class="icon"></i><span><?=__('店铺')?></span></li>
            </ul>
            <input type="text" class="search-input" value="" oninput="writeClear($(this));" id="keyword" placeholder="<?=__('请输入搜索关键词')?>" maxlength="50" autocomplete="on" autofocus>
            <span class="input-del"></span>
        </div>
        <div class="header-r">
            <a id="header-nav" href="javascript:void(0);" class="search-btn"><?=__('搜索')?></a>
        </div>
    </div>
</header>

<!-- 全文搜索提示 begin -->
<div class="sstouch-main-layout mb-20" id="search_tip_list_container" style="display:none"></div>
<script type="text/html" id="search_tip_list_script">
<ul class="sstouch-default-list">
<%for(i = 0; i < list.length; i++){%>
    <li><a href="<%=$buildUrl('keyword',list[i])%>"><%=list[i]%></a></li>
<%}%>
</ul>
</script>
<!-- 全文搜索提示 end -->

<div id="store-wrapper">
  <div class="sstouch-search-layout">
    <dl class="hot-keyword">
      <dt><?=__('热门搜索')?></dt>
      <dd id="hot_list_container"></dd>
    </dl>
    <dl>
      <dt><?=__('历史纪录')?></dt>
      <dd id="search_his_list_container"></dd>
    </dl>
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="hot_list">
<ul>
<%for(i = 0; i < hot_list.length; i++){%>
    <li><a href="<%=$buildUrl('keyword',hot_list[i])%>"><%=hot_list[i]%></a></li>
<%}%>
</ul>
</script>
<script type="text/html" id="search_his_list">
<ul>
<%for(i = 0; i < search_his_list.length; i++){%>
    <li><a href="<%=$buildUrl('keyword',search_his_list[i])%>"><%=search_his_list[i]%></a></li>
<%}%>
</ul><a href="javascript:void(0);" class="clear-history" onclick="$(this).prev().remove();delLocalStorage('hisSearch');"<?=__('清空历史')?></a>
</script>
<script> var navigate_id ="3";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/supplier_search.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script>
    var search_type='keyword';
    //搜索点击下拉选择搜索类型
    $('.search-type').click(function(){
        var display = $('.goods-class-sel').css('display');
        if(display == 'none')
        {
            $('.goods-class-sel').show();
        }
        else
        {
            $('.goods-class-sel').hide();
        }
    })
    //点击选择搜索商品还是店铺
    $('.goods-class-sel').on('click', 'li', function(){
        $('.search_kind').removeClass('active');
        $(this).addClass('active');
        var type_name = $(this).find('span').html();
        $('.search-title').html(type_name);
        $('.goods-class-sel').hide();
        if(type_name == '宝贝')
            search_type = 'keyword';
        else
            search_type = 'shop';
    })
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>