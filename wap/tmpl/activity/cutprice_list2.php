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
    <link rel="stylesheet" type="text/css" href="../../css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/public.css">
    <link rel="stylesheet" type="text/css" href="../../css/activity/cutprice_list.css">
    <script type="text/javascript" src="../../js/swiper.min.js"></script>

</head>
<body>
    <header class="head-fixed bg6" id="header">
        <div class="header-wrap">
            <div class="header-l">
                <a href="javascript:history.back(-1)">
                    <span class="icon icon-arrow-left"></span>
                </a>
            </div>
            <h1 class="title"><?=__('砍价免费拿')?></h1>
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
    <div id="container" style="margin-top: 1.2rem;padding-top: 0.1rem;">
        <!--砍价活动BRAND-->
        <div class="img-w100" v-if="cutprice_banner">
            <a :href="cutprice_banner_url">
                <img :src="cutprice_banner" alt="">
            </a>
        </div>
        <!--砍价成功列表-->
        <div class="success_wrap" v-if="success_list && success_list.length > 0 ">
            <div class="plr65 bg7 swiper-container" style="height: 2rem">
               <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="item in success_list">
                        <a class="flex-xsycenter h200" href="javascript:;">
                            <div class="wh174 flex-fb174 bor-r100 mr40 img-w100">
                                <img :src="item.user_image" alt="">
                            </div>
                            <div class="f4 cf ellipsis1 swiper-container" v-text="user_info.user_account+'<?=__('砍价成功')?>，' + item.ac_mix_limit_price +'<?=__('元')?><?=__('拿')?>' + item.product_name">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--商品列表-->
        <ul scroll-y="true" bindscrolltolower="scrollbottom" :scroll-top="scposition" v-if="isdata">
            <li class="pd65" v-for="item in Info" >
                <a class="flex-sb borb-d1 flex-xsycenter" href="javascript:;">
                    <div class="wh522 flex-fb522 img-w100 mb2 mimg">
                        <img :src="item.product_image" alt="">
                    </div>
                    <div class="flex-sb flex-dc w100 flex-overflow">
                        <div>
                            <div class="f6 c26 ellipsis1" v-text="item.product_name"></div>
                            <div class="f2 ca ellipsis2" v-text="item.product_tips"></div>
                        </div>
                        <div class="flex-sb flex-ye">
                            <div class="">
                                <div class="f2 c79 ellipsis1" v-text="'<?=__('0人已')?>'+item.activity_item_price+'<?=__('元')?><?=__('拿')?>'"></div>
                                <div class="f6 c5 ellipsis1"><?=__('原件')?>
                                    <span class="fw600" v-text="'￥'+item.item_sale_price"></span>
                                </div>
                            </div>
                            <div class="flex-xsye">
                                <span class="icon icon-killpbg flex-xcenterye f3 cf" v-text="'?=__('砍价')?>' +item.activity_item_price+'?=__('元')?>?=__('得')?>'"></span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="m-loading-box">
                <div v-if="ispage">
                    <div class="u-loadmore">
                        <label class="u-loading"></label>
                        <span class="u-loadmore-tips"><?=__('正在加载')?></span>
                    </div>
                </div>
                <div v-else>
                    <div class="u-loadmore u-loadmore-line">
                        <span class="u-loadmore-tips"><?=__('没有更多数据啦')?>！</span>
                    </div>
                </div>
            </li>
        </ul>
        <div href="../../search.html" redirect="true" class="m-nullpage" v-else>
            <div class="m-nullpage-middle">
                <label class="iconfont icon-sousuo-sousuo"></label>
                <div class="m-null-tip">
                    <span><?=__('亲~找不到您想要的商品')?></span>
                    <span><?=__('再多点提示呗')?></span>
                </div>
            </div>
        </div>

        <!--信息提示-->
        <div class="ui-center-mask hidden" v-if="user_info">
            <div class="ui-center-mask-bg"></div>
            <div class="ui-center-mask-block">
                <div class="ui-center-mask-content">
                    <a href="javascript:void(0);" class="ui-bottom-mask-close" onclick="hiddenCenter('bargain_dialog')"><i></i></a>
                    <div class="c1e pdtb0">
                         <div class="flex-xsycenter">
                            <div class="flex-center w284 img-w100 bor-r22 user-img-ab">
                                <img id="user-img" :src="user_info.user_avatar" alt="" >
                            </div>
                        </div>
                        <div class="flex-center f6 mt2 tc block">
                            <p><?=__('当前商品有正在开的团')?></p>
                             <p><?=__('快去砍价吧')?>~</p>
                        </div>
                    </div>
                    <div class="flex-box f6 flex-center tc">
                        <div class="ptb42 close"><a class="sbtn" href="javascript:;"><?=__('继续砍价')?>~</a></div>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="pre-loading">
        <div class="pre-block">
            <div class="spinner"><i></i></div>
            <?=__('数据读取中...')?>
        </div>
    </div>

    <footer class="bar bar-footer footer-wrap flex-box">
        <div class="bg5 flex-center">
            <a class="f6 cf" href="javascript:;"><?=__('砍价商品')?></a>
        </div>
        <div class="bgf flex-center">
            <a class="f6 ca1 " href="cutprice_home.html"><?=__('我的砍价')?></a>
        </div>
    </footer>

</body>


<script type="text/html" id="spec_main">
     <div class="pd65">
        <div class="flex-xsycenter">
            <div class="flex-center wh326 img-w100 bor-r22 spec-img-ab">
                <img src="<%=product_image%>" alt="">
            </div>
            <div class="ml390" style="width: 100%">
                <div class="f5 c5  goods_spec_price"><?=__('¥')?>0</div>
                <div class="f2 c79 " style="width: 100">
                    <span class="goods_spec_name"><?=__('请选择')?>：
                    <?=__('规格')?>
                    </span>
                    <span class="goods_spec_storage" style="float: right;">0<?=__('件')?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="ui-bottom-mask-content">
        <div class="ui-bottom-mask-rolling">
            <% if(product_spec.length>0){%>
            <% for(var i =0;i < product_spec.length;i++){%>
            <div class="">
                <div class="f4 26 borb-d1 pd65 pdtb3"><%=product_spec[i].name%>：</div>
                <div class="flex-xsycenter pd65 pdtb3 flex-wrap spec-list" activity_id = '<%=activity_id%>'>
                    <%for(var j = 0;j<product_spec[i].item.length;j++){%>
                    <a href="javascript:void(0);" class="spec-item <%if(item_spec[i]['item'].id == product_spec[i].item[j].id){%> current <%}%>" specs_value_id = "<%=product_spec[i].item[j].id%>">
                        <%=product_spec[i].item[j].name%>
                    </a>
                    <% } %>
                </div>
            </div>
            <% } %>
            <% } %>
            <div class="flex-center mt120">
                <a class="f7 cf bg5 bor-r60 pd10-100" href="javascript:;" onclick="goodsSpecCallBack(<%=activity_id%>)"><?=__('确定')?></a>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="success_main">
     <% if( cutprice_success_list.length > 0 ) { %>
     <div class="plr65 bg7 swiper-container" style="height: 2rem">
       <div class="swiper-wrapper">
        <% for( var i = 0; i < cutprice_success_list.length; i++ ) { %>
            <div class="swiper-slide">
                <a class="flex-xsycenter h200" href="javascript:;">
                    <div class="wh174 flex-fb174 bor-r100 mr40 img-w100">
                        <img src="<%=cutprice_success_list[i].user_image%>" alt="">
                    </div>
                    <div class="f4 cf ellipsis1 swiper-container">
                        <%=cutprice_success_list[i].user_name%><?=__('砍价成功')?>，<%=cutprice_success_list[i].ac_mix_limit_price%><?=__('元')?><?=__('拿')?><%=cutprice_success_list[i].product_name%>
                    </div>
                </a>
            </div>
         <% } %>
        </div>
    </div>
    <% } %>
</script>

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
                收货地址：<%=address[i].ud_province%><%=address[i].ud_city%><%=address[i].ud_county%> <%=address[i].ud_address%>
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


<!--选择规则操作表-->
<div class="ui-bottom-mask hidden " id="select_spec">
    <div class="ui-bottom-mask-bg"></div>
    <div class="ui-bottom-mask-block bor-rt">
        <div class="ui-bottom-mask-tip hidden"><i></i></div>
        <a href="javascript:void(0);" class="ui-bottom-mask-close close"><i></i></a>

        <div id="spec_detail">

        </div>
    </div>
</div>

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
                        <div class="f4 c2b"<?=__('新增收货地址')?>></div>
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


<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/public.js"></script>
<script type="text/javascript" src="../../js/picker.min.js"></script>
<script type="text/javascript" src="../../js/city.json"></script>
<script type="text/javascript" src="../../js/address_picker.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/bargain_list.js"></script>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
