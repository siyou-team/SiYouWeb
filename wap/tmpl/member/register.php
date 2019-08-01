
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
  <title>会员注册</title>
  <link rel="stylesheet" type="text/css" href="../../css/base.css">
  <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
  <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"><a href="../../index.html"><i class="zc zc-home home"></i></a></div>
    <div class="header-title">
      <h1>会员注册</h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="login.html" class="text">登录</a> </div>
  </div>
</header>
<div class="sstouch-main-layout fixed-Width">
  <div class="sstouch-single-nav mb5 register-tab">
    <ul>
      <li class="selected"><a href="javascript: void(0);"><i class="reg"></i>普通注册</a></li>
      <li><a href="register_mobile.html"><i class="regm"></i>手机注册</a></li>
    </ul>
  </div>
  <div class="sstouch-inp-con">
    <form action="" method ="">
      <ul class="form-box">
        <li class="form-item">
          <h4>用&nbsp;户&nbsp;名</h4>
          <div class="input-box">
            <input type="text" placeholder="请输入6-20个字符" class="inp" name="username" id="username" oninput="writeClear($(this));"/>
            <span class="input-del"></span></div>
        </li>
        <li class="form-item">
          <h4>设置密码</h4>
          <div class="input-box">
            <input type="password" placeholder="请输入6-20位密码" class="inp" name="pwd" id="userpwd" oninput="writeClear($(this));"/>
            <span class="input-del"></span></div>
        </li>
        <li class="form-item">
          <h4>确认密码</h4>
          <div class="input-box">
            <input type="password" placeholder="请再次输入密码" class="inp" name="password_confirm" id="password_confirm" oninput="writeClear($(this));"/>
            <span class="input-del"></span></div>
        </li>
        <li class="form-item">
          <h4>验&nbsp;证&nbsp;码</h4>
          <div class="input-box">
            <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="输入4位验证码" oninput="writeClear($(this));" />
            <span class="input-del code"></span><a href="javascript:void(0)" id="refreshcode" class="code-img"><img border="0" id="codeimage" name="codeimage"></a>
            <input type="hidden" class="inp  no-follow"  id="codekey" name="codekey" value="">
          </div>
        </li>
      </ul>
      <div class="remember-form">
        <input id="checkbox" type="checkbox" checked="" class="checkbox">
        <label for="checkbox">同意</label>
        <a class="reg-cms" href="document.html" target="_blank">用户注册协议</a> </div>
      <div class="error-tips"></div>
      <div class="form-btn"><a href="javascript:void(0);" class="btn" id="registerbtn">注册</a></div>
    </form>
    <input type="hidden" name="referurl">
  </div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/register.js"></script>
</body>
</html>