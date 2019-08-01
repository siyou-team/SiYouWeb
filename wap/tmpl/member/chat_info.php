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
<title><?=__('消息详情')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_chat.css">
</head>
<body>
<header id="header hide">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('消息详情')?></h1>
    </div>
    <div class="header-r"><a href="javascript:void(0)" class="msg-log" id="chat_msg_log"><i></i><?=__('历史')?></a></div>
  </div>
</header>
<!-- app show -->
<div class="header-r"><a href="javascript:void(0)" class="msg-log" id="chat_msg_log_app"><i></i><?=__('历史')?></a></div>

<div class="sstouch-chat-layout">
  <div class="sstouch-chat-con">
    <div class="margin-heigh"></div>
    <div id="chat_msg_html"> </div>
    <a href="javascript:void(0);" id="anchor-bottom"></a> </div>
  <div class="sstouch-chat-bottom">
    <div class="chat-input-layout"> <span class="open-smile"><a href="javascript:void(0)" id="open_smile"></a></span>
      <div class="input-box">
        <input type="text" id="msg"/>
        <a href="javascript:void(0)" id="submit" class="submit"></a> </div>
    </div>
    <div class="chat-smile-layout hide" id="chat_smile">
      <ul>
      </ul>
    </div>
  </div>
</div>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/chat_info.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
