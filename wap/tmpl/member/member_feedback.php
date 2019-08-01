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
<title><?=__('我的商城')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('用户反馈')?></h1>
    </div>
  </div>
</header>
<div class="sstouch-main-layout feedback">
  <form>
    <textarea id="feedback" class="textarea" placeholder="<?=__('请描述一下您遇到的问题')?>"></textarea>
    <div class="error-tips"></div>
    <a href="javascript:void(0);" class="btn-l" id="feedbackbtn"><?=__('提交')?></a>
  </form>
</div>
<footer id="footer" class="bottom"></footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/member_feedback.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
