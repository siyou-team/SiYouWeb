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
<meta name="format-detection" content="telephone=no"/>
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('登录')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<style>
    html{
        width: 100%;
        height: 100%;
        background-image: url("../../images/app_new/login.jpg");
        background-size: 100% 100%;
    }
    body{
        background-color:transparent;
    }
    .sstouch-main-layout{
        display: block;
        margin: 11rem 2rem;
        background-color: white;
        width: 80%;
        border-radius: .4rem;
        overflow: hidden;
    }
    .sstouch-inp-con ul{
        margin-top:1rem;background-color: white;
    }
    .forget{
        line-height: 2rem;
        font-size: .5rem;
        border-bottom: none !important;
    }
    .sstouch-inp-con ul li h4{
        width:	auto
    }
    .sstouch-inp-con ul li .input-box{
        margin:0;
        margin-left: 1.5rem;
    }
    .sstouch-inp-con .form-btn{
        margin-top:0;
    }
</style>
<body>
<div class="sstouch-main-layout fixed-Width">
  <div class="sstouch-inp-con">
    <form action="" method ="">
      <ul class="form-box">
        <li class="form-item">
          <h4><i class="zc zc-member"></i></h4>
          <div class="input-box">
            <input type="text" placeholder="<?=__('用户名')?>" class="inp" name="username" id="username" />
            <span class="input-del"></span> </div>
        </li>
          <li class="form-item">
              <h4><i class="zc zc-edit edit"></i></h4>
              <div class="input-box">
                  <input type="password" autocomplete="off" placeholder="<?=__('密码')?>" class="inp" name="pwd" id="userpwd" oninput="writeClear($(this));" />
                  <span class="input-del"></span> </div>
          </li>
          <li class="form-item forget">
              <a href="find_password.html"><?=__('忘记密码？')?></a>
          </li>
          <li class="form-item">
              <div class="form-btn"><a href="javascript:void(0);" class="btn" id="loginbtn"><?=__('登录')?></a></div>
          </li>
      </ul>
<!--      <div class="remember-form">-->
<!--        <input id="checkbox" type="checkbox" checked="" class="checkbox">-->
<!--        <label for="checkbox">--><?//=__('七天自动登录')?><!--</label>-->
<!--        <a class="forgot-password" href="find_password.html">--><?//=__('忘记密码？')?><!--</a> -->
<!--      </div>-->

    </form>
  </div>
</div>
<div class="joint-login hide">
    <!-- <h2><span><?=__('合作账号登录')?></span></h2>
    <ul id="connect">
      <li><a class="weibo hide" href="javascript: void(0);"></a></li>
      <li><a class="qq hide" href="javascript: void(0);"></a></li>
      <li class="wxshow"><a class="weixin hide" href="javascript: void(0);"></a></li>
    </ul> -->
  </div>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/login.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
