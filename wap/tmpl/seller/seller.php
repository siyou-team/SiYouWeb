<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1"/>
    <title><?=__('商家管理中心')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<style>
    body{
        background-color: #f7f7f7;
    }
    .seller-header{
        height:2rem;
        line-height: 2rem;
        display: flex;
        justify-content: space-between;
    }
    .header-img{
        height: 1rem;width: 1rem;margin: .5rem;
    }
    .seller-header-img{
        height:5rem;
        width:100%;
        margin-top: 2rem;
    }
    .seller-total{
        display: flex;
        justify-content: space-between;
        height: 3rem;
        line-height: 1.3rem;
        text-align: center;
        font-size: .5rem;
        color: #626262;
        background-color: #fff;
    }
    .seller-total-item{
        width:50%;
    }
    .order-chain{
        height: 1.5rem;
        display: flex;
        justify-content: space-between;
        background-color: white;
        margin: .2rem;
        line-height: 1.5rem;
        font-size: .7rem;
        padding-left: 0.5rem;
        border-radius: .1rem;
        color: #585353;
    }
    .order-lists{
        display:flex;
        justify-content: space-around;
    }
    .order-link{
        display: block;
        width: 20%;
        background-color: white;
        color: #4d4d4d;
        font-size: .4rem;
        text-align: center;
        box-shadow: 1px 0px 2px #d2d0d0;
        padding-bottom: 0.3rem;
        border-radius: 0.3rem;
    }

    .order-title{
        height: 1.5rem;
        margin: .2rem;
        line-height: 1.5rem;
        font-size: .7rem;
        padding-left: 0.5rem;
        border-radius: .1rem;
        color: #585353;
    }

    .order-img{
        width: 50%;
        margin: .2rem auto;
        background-color:#eaeaea;
        border-radius: 50%;
        overflow: hidden;
        padding: 0.2rem;
    }

    .footnav ul li p{
        color:white;
    }
    .img-100{
        height: 100%;
        width:100%;
    }
    .font-red{
        color:red;
        font-size: .8rem;
    }
    .mt-4{
        margin-top:.4rem;
    }
    .unused{
        background:transparent;
        box-shadow:0 0 ;
    }
</style>
<body>
<header >
    <div class="seller-header">
        <div class="header-img" id="scan" >
            <img src="../../images/app-index/sys.png" class="img-100" >
        </div>
        <div> <h1 id="chain_name"><?=__('Siyou Market')?></h1></div>
        <div class="header-img"><a href="/wap/tmpl/setting.php"><img src="../../images/app_new/setting.png" class="img-100" ></a></div>
    </div>
</header>
<div >
    <div class="seller-header-img">
        <img src="../../images/app_new/sell_header.png" alt=""  class="img-100" >
    </div>
</div>
<div class="seller-total">
    <div  class="seller-total-item">
        <div class="font-red" id="day_num">0</div>
        <div>今日销售额</div>
    </div>
    <div  class="seller-total-item">
        <div class="font-red" id="month_num">0</div>
        <div>本月销售额</div>
    </div>
</div>
<div class="seller-total mt-4">
    <div  class="seller-total-item">
        <div class="font-red" id="chain_num">0</div>
        <div>今日在线订单数</div>
    </div>
    <div  class="seller-total-item">
        <div class="font-red" id="total_num">0</div>
        <div>今日店内订单数</div>
    </div>
</div>
<a href="store_orders_list_chain.html">
    <div class="order-chain">
        <div>店内订单</div>
        <div><i class="zc zc-arrow-r arrow-r"></i></div>
    </div>
</a>
<div>
    <div class="order-title">线上订单管理</div>
    <div class="order-lists">
        <a href="store_orders_list.html?data-state=2010" class="order-link">
            <div><div class="order-img"><img src="../../images/app_new/wait.png" alt="" class="img-100"></div></div>
            <div>待付款</div>
        </a>
        <a href="store_orders_list.html?data-state=2020,2030" class="order-link">
            <div><div class="order-img"><img src="../../images/app_new/express.png" alt=""  class="img-100"></div></div>
            <div>待发货</div>
        </a>
        <a href="store_orders_list.html?data-state=2040" class="order-link">
            <div><div class="order-img"><img src="../../images/app_new/expressed.png" alt=""  class="img-100"></div></div>
            <div>已发货</div>
        </a>
        <a href="store_orders_list.html?data-state=2060" class="order-link">
            <div><div class="order-img"><img src="../../images/app_new/finshed.png" alt=""  class="img-100"></div></div>
            <div>已完成</div>
        </a>
    </div>
</div>
<div>
    <div class="order-title">仓库管理</div>
    <div class="order-lists">
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/in.png" alt="" class="img-100"></div></div>
            <div>入库</div>
        </a>
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/out.png" alt=""  class="img-100"></div></div>
            <div>出库</div>
        </a>
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/list.png" alt=""  class="img-100"></div></div>
            <div>产品列表</div>
        </a>
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/io.png" alt=""  class="img-100"></div></div>
            <div>出入记录</div>
        </a>
    </div>
</div>
<div>
    <div class="order-title">会员管理</div>
    <div class="order-lists">
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/user_lists.png" alt="" class="img-100"></div></div>
            <div>列表</div>
        </a>
        <a href="javascript:void(0);" class="order-link coding">
            <div><div class="order-img"><img src="../../images/app_new/user_add.png" alt=""  class="img-100"></div></div>
            <div>新增</div>
        </a>
        <a href="javascript:void(0);" class="order-link unused">

        </a>
        <a href="javascript:void(0);" class="order-link unused">

        </a>
    </div>
</div>
<a href="./chain_list.php">
    <div class="order-chain">
        <div>切换门店</div>
        <div><i class="zc zc-arrow-r arrow-r"></i></div>
    </div>
</a>

<footer id="footer"></footer>

<script> var navigate_id ="1";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller.js"></script>
<script>
    $(function() {
        $('.coding').click(function(){
            $.sTip({
                "title": '提示',
                "content": '功能开发中',
            });
            return false;
        });
    });
    function getAppQrcode(data){
        if(!data){
            alert('未获取到条形码');
        }else{
            window.location.href='./product_info.php?product_id='+data;
            return false;
        }
    }
    $('#scan').click(function(){
        console.log('scan');
        appApi.scanQRCode();
    });
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
