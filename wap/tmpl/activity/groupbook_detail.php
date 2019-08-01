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
    <title><?=__('拼单页')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/activity/app.css">
    <link rel="stylesheet" type="text/css" href="../../css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/public.css">
    <script type="text/javascript" src="../../js/swiper.min.js"></script>
    <script src="../../js/public.js"></script>
   <style type="text/css">
   	.m-product-GP {
	    height: 6.137rem;
	}
	.m-product-GP .m-product-img {
	    height: 6.137rem;
	    width: 6.137rem;
	}
	.m-product-GP .m-product-info {
	    height: 6.137rem;
	    width: 10rem;
	    position: relative;
	}
	.m-product-name {
	    height: 2.637rem;
	    font-size: .65rem;
	}
	.m-product-name, .m-product-price, .m-product-price1 {
	    line-height: 1rem;
	}
	.groupNumber {
	    font-size: .6rem;
	    color: #888;
	}
	.m-product-price {
		font-size: 1rem;
    	color: #DB384C;
	}
	.u-del-price {
	    color: #888;
	    font-size: .26666666666666666rem;
	    text-decoration: line-through;
	}
	.m-product-info::before {
		border-bottom: 0;
	}
	.m-min-name, .m-product-price label {
		font-size: .6rem;
	}
	*[data-role='mask']{
        display: none;
    }

    *[data-mask='help'] .help_pic{
        position: fixed;
        display: block;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url(../../images/share_help.png) no-repeat center top rgba(0,0,0,0.93);
        background-size: 100%;
        z-index: 100;
    }
   </style>

</head>
<body>
	<div id="container" v-cloak>
		<div scroll-y="true" bindscrolltolower="fightPage" style="position: absolute;height:100%;width:100%;">
			<header class="head-fixed transparent">
			    <div class="header-wrap">
			        <div class="header-l">
			            <a href="javascript:history.back(-1)">
			                <span class="icon icon-arrow-left1"></span>
			            </a>
			        </div>
			        <div class="title c5" style="background: #fff" v-if="GbInfo.gb_enable==2 && show"><?=__('剩余')?>

			        	<span class="count-time" :data-end="GbInfo.gb_endtime">
			                <em class="day" ><?=__('天')?></em>:<em class="hour">00</em>:<em class="mini">00</em>:<em class="sec" >00</em>
			            </span>

			    	</div>
			    	<div class="title c5" style="background: #fff" v-else ><?=__('剩余
			        	拼团活动')?>
			    	</div>

			        <div class="header-r">
			            <a id="header-nav" href="javascript:void(0);" bindtap="shareBox">
			                <span class="icon icon-share"></span>
			            </a>
			        </div>
			    </div>
			</header>

			<div class="ptf pbf">
				<div :href="'../product_detail.html?item_id=' + GbInfo.activity_rule.item_id + '&gb_id=' + GbInfo.gb_id" class="m-product-item m-product-GP">
	                <div class="m-product-img">
	                    <img :src="GbInfo.activity_rule.product_image" />
	                </div>
	                <div class="m-product-info">
	                    <div class="m-product-name">
	                        <label v-text="GbInfo.activity_rule.item_name"></label>
	                        <div class='groupNumber' style='margin-top:0.24rem'><?=__('拼团省
              			        	')?>
	                            <span v-text="(GbInfo.activity_rule.item_unit_price - GbInfo.activity_rule.group_sale_price).toFixed(2)"></span>
	                        </div>
	                    </div>
	                    <div style='position:absolute;bottom:0.26666666666667rem;'>
	                        <div class="groupNumber" style='margin-bottom:0.16rem;'>
	                            <span v-text="GbInfo.gb_quantity"></span><?=__('人团')?>
	                        </div>
	                        <div class="m-product-price">
	                            <label>¥</label><span v-text="GbInfo.activity_rule.group_sale_price"></span>
	                            <label class="u-del-price" v-text="'¥' + GbInfo.activity_rule.item_unit_price"></label>
	                        </div>
	                    </div>

	                    <div class="isSucces">
	                        <img class='simg' v-if="1==GbInfo.gb_enable" src='https://static.shopsuite.cn/xcxfile/appicon/groupbooking/success.png' />
	                        <img class='simg' v-if="0==GbInfo.gb_enable" src='https://static.shopsuite.cn/xcxfile/appicon/groupbooking/failure.png' />
	                    </div>
	                </div>
	            </div>

	            <div class="pb65" id="avatar_wrap">
			        <div class="pd65" v-if="GbInfo.gb_enable==2 && show">
			            <div class="f8 c26 tc " ><?=__('还差')?><span v-text="GbInfo.gb_quantity - GbInfo.gb_amount_quantity" style="color: #fc4747;font-size:.8rem "></span>人 <?=__('点击分享给好友')?></div>
			        </div>
			        <div class="plr140 tc" v-if="show" >
			            <a href="javascript:;" class="flex-center ptb21 f7 cf bg5 bor-r30" v-if="GbInfo.gb_enable==2 && !groupIsEnd" bindtap="shareBox">
                    <?=__('邀请好友拼单')?>
			            </a>
			            <a href="./group_book.html" class="flex-center ptb21 f7 cf bg5 bor-r30" v-if="GbInfo.gb_enable==0">
			                  <?=__('点击再开一团')?>
			            </a>
			            <a href="./group_book.html" class="flex-center ptb21 f7 cf bg5 bor-r30" v-if="GbInfo.gb_enable==1">
			                  <?=__('点击再开一团')?>
			            </a>
			            <a href="javascript:;" class="flex-center ptb21 f7 cf bg5 bor-r30 mt45" v-if="GbInfo.gb_enable==2 && !ispaysuccess" bindtap="immediatelyOffered">
			                 <?=__('参加活动')?>
			            </a>
			        </div>
			    </div>

			    <div class="pd65 flex-center">
			        <div class="flex-avatar-left f14 flex-sb h100" v-if="GroupUsers[0] && GbInfo.user_id == GroupUsers[0].user_id">
			            <div class="wh148 f3 c1e flex-ycenter"><?=__('团长')?> </div>
			            <div class="wh148 img-w100 mr40 avatar-r100">
			                <img :src="GroupUsers[0].user_avatar" alt="">
			            </div>
			        </div>
			        <div class="avatar-warp h100">
			            <div class="flex-center flex-avatar-right">
			                <div class="wh148 flex-fb148 img-w100 mr40 avatar-r100" v-for="item in GroupUsers" v-if="GbInfo.user_id != item.user_id">
			                    <img :src="item.user_avatar" alt="">
			                </div>

			                <div class="wh148 flex-fb148 img-w100 mr40 avatar-r100" v-for="img in remain_quantity">
			                    <img src="../../images/unknown-avatar.png" alt="">
			                </div>
			            </div>
			        </div>
			    </div>

    			<hr class="hr">
			    <div class="list-block">
			        <li class="item-content plr65">
			            <div class="item-inner">
			                <div class="item-title"><?=__('拼单规则：')?> </div>
			                <div class="item-after">
			                    <div class="mr40 f3 c88 flex-ycenter">
			                        <span class="icon-circle"></span><?=__('人满发货')?>
			                    </div>
			                    <div class="mr40 f3 c88 flex-ycenter">
			                        <span class="icon-circle"></span><?=__('人不满退款')?>
			                    </div>
			                </div>
			            </div>
			        </li>
			    </div>
			    <hr class="hr">
			    <div v-if="RecGoods">
			        <div class="f4 c1e pd65">
			            <?=__('推荐商品')?>
			        </div>
			        <div class="plr39">
			            <div class="swiper-container" id="swiper_container_tj">
			                <div class="swiper-wrapper">
			                    <div class="swiper-slide pd21 flex-fb50" v-for="item in RecGoods">
			                        <div class="flex-overflow">
			                            <a class="flex-sb flex-dc bor-r22" :href="'../product_detail.html?item_id=' + item.item_id" >
			                                <div class="flex-center whimg-love">
			                                    <img :src="item.product_image" :alt="item.product_name">
			                                </div>
			                                <div class="flex-sb pd21">
			                                    <div class="flex-overflow">
			                                        <div class="f3 c26 ellipsis1" v-text="item.product_name"></div>
			                                        <div class="flex-sb flex-xsye">
			                                            <div class="f4 c5 ellipsis1 mr21" v-text="'￥'+ item.product_unit_price"></div>
			                                            <div class="f1 c3 line-th" v-text="'￥'+ item.product_market_price"></div>
			                                        </div>
			                                    </div>
			                                    <div class="flex-center">
			                                        <span class="icon icon-shopcart"></span>
			                                    </div>
			                                </div>
			                            </a>
			                        </div>
			                    </div>

			                </div>
			            </div>
			        </div>
			    </div>

			</div>
		</div>
	</div>


    <div id="shareit" data-role="mask" data-mask="help" class="mask_help">
	    <a href="javascript:;" class="help_pic" bindtap='cancelShare'></a>
	</div>

<!--拼单页弹窗-->
<div class="ui-center-mask hidden" id="popup_pindan">
    <div class="ui-center-mask-bg"></div>
    <div class="ui-center-mask-block">
        <div class="ui-center-mask-content">
            <a href="javascript:void(0);" class="ui-center-mask-close close"><i></i></a>
            <div class="pd65">
                <div class="ptb65 c1e tc">
                    <div class="f6">  <?=__('必须要请好友拼单，才能拼单成功')?></div>
                    <div class="f4 mt21"><span class="c5"> <?=__('还差1人，')?></span> <?=__('点击邀请好友拼单')?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/public.js"></script>
<script type="text/javascript" src="../../js/libs/vue.min.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/app.js"></script>
<script type="text/javascript" src="../../js/tmpl/activity/group_detail.js"></script>
<script src="../../js/bscroll.min.js"></script>

</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
