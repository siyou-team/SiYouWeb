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
<title><?=__('店铺设置')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header" class="app-no-fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('店铺设置')?></h1>
    </div>
    <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
  </div>
</header>
<div class="sstouch-main-layout">
  <form>
    <div class="sstouch-inp-con">
      <ul class="form-box">
          <li class="form-item">
              <h4><?=__('店铺名称')?>：</h4>
              <div class="input-box">
                  <input type="text" readonly class="inp no-follow" id="store_name" name="store_name" autocomplete="off" onchange="btn_check($('form'));"/>
              </div>
          </li>
        <li class="form-item">
          <h4  style="height:4rem;line-height: 4rem;"><?=__('店铺')?>logo：</h4>
          <div class="input-box"  style="height:4rem;line-height: 4rem;">
            <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
              <a href="javascript:void(0);">
                <span>
                  <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_011" name="upfile" id="">
                </span>
                <p><i class="icon-upload"></i></p>
              </a>
              <input type="hidden"  class=" no-follow" name="store_logo" id="store_logo" value="">
            </div>
          </div>
        </li>
          <li class="form-item"  class="form-item">
              <h4  style="height:4rem;line-height: 4rem;"><?=__('店铺横幅')?>：</h4>
              <div class="input-box"  style="height:4rem;line-height: 4rem;">
                  <div class="sstouch-upload"  style="width:10rem;height: 3.7rem; border:0px;">
                      <a href="javascript:void(0);">
                        <span>
                          <input type="file" hidefocus="true" size="1" class="input-file no-follow" id="file_012" name="upfile">
                        </span>
                          <p><i class="icon-upload"></i></p>
                      </a>
                      <input type="hidden"  class=" no-follow" name="store_banner" id="store_banner" value="" />
                  </div>
              </div>
          </li>
          <li class="form-item">
              <h4><?=__('店铺电话')?>：</h4>
              <div class="input-box">
                  <label>
                      <input type="tel" class="inp" name="store_tel" id="store_tel" autocomplete="off" oninput="writeClear($(this));"/>
                      <span class="input-del"></span>
                  </label>
              </div>
          </li>
        <li class="form-item">
          <h4>QQ：</h4>
          <div class="input-box">
            <input name="store_qq" type="tel" class="inp no-follow" id="store_qq" autocomplete="off" onchange="btn_check($('form'));"/>
          </div>
        </li>
        <li class="form-item">
          <h4><?=__('阿里旺旺')?>：</h4>
          <div class="input-box">
            <input type="text" class="inp no-follow" name="store_ww" id="store_ww" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span>
          </div>
        </li>
        <li class="form-item hide">
          <h4><?=__('SEO关键字')?>：</h4>
          <div class="input-box">
            <input type="text" class="inp no-follow" name="store_keywords" id="store_keywords" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span>
          </div>
        </li>
        <li class="form-item hide">
          <h4><?=__('SEO店铺描述')?>：</h4>
          <div class="input-box">
            <input type="text" class="inp no-follow" name="store_des" id="store_des" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span>
          </div>
        </li>

      </ul>
      <div class="error-tips"></div>
      <div class="form-btn"><a class="btn" href="javascript:;"><?=__('保存信息')?></a></div>
    </div>
  </form>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/seller_account.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
