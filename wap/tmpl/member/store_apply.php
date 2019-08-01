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
<title><?=__('店铺入驻')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('店铺入驻')?></h1>
    </div>
    <div class="header-r"></div>
  </div>
</header>
<div class="sstouch-main-layout">
  <form id="form-name">
    <div class="sstouch-inp-con">
      <ul class="form-box">

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('入驻类型')?></h4>
          <div class="input-box">
            <span class='inp-black' style="padding: 0.1rem 0.5rem;height: 100%;line-height: 100%;width:100%;">
                <select id="store_o2o_flag" name="store_o2o_flag" style="height: 1.75rem;"  oninput="writeClear($(this));" placeholder="<?=__('选择入驻类型')?>" >
                    <option value="" disabled selected><?=__('选择入驻类型')?></option>
                    <option value="0"><?=__('爱网购')?></option>
                    <option value="1"><?=__('爱逛街')?></option>
                </select>
            </span>
          </div>
        </li>


        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('店铺名称')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="store_name" id="store_name" autocomplete="off" oninput="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>



        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('经营类目')?></h4>
          <div class="input-box">
            <span class='inp-black' style="padding: 0.1rem 0.5rem;height: 100%;line-height: 100%;width:100%;">
                <select id="store_category_id" name="store_category_id" style="height: 1.75rem;"  oninput="writeClear($(this));" placeholder="<?=__('选择经营类目')?>" >
                    <option value="" disabled selected><?=__('选择经营类目')?>/option>
                </select>
            </span>
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('公司名称')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="company_name" id="company_name" autocomplete="off" oninput="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>

        <!--
        <li class="form-item ">
          <h4><i style="color: red;">*</i>开户名称</h4>
          <div class="input-box">
            <input type="text"  class="inp" name="bank_account_name" id="bank_account_name" autocomplete="off" oninput="writeClear($(this));"/>
            <span class="input-del"></span> </div>
        </li>
        -->

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('开户银行')?></h4>
          <div class="input-box">
            <input type="text" placeholder="<?=__('……银行……分行……支行')?>" class="inp" name="bank_name" id="bank_name" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('银行账户')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="bank_account_number" id="bank_account_number" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('联系人')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="contacts_name" id="contacts_name" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('联系手机')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="contacts_phone" id="contacts_phone" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4><i style="color: red;">*</i><?=__('企业地址')?></h4>
          <div class="input-box">
            <input type="text" class="inp" name="company_address" id="company_address" autocomplete="off" oninput="writeClear($(this));">
            <span class="input-del"></span> </div>
        </li>

        <li class="form-item">
          <h4  style="height:4rem;line-height: 4rem;"><h4><i style="color: red;">*</i><?=__('营业执照')?></h4>
          <div class="input-box"  style="height:4rem;line-height: 4rem;">
            <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
              <a href="javascript:void(0);">
                <span>
                  <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_011" name="upfile" style="line-height: 4rem;">
                </span>
                <p><i class="icon-upload"></i></p>
              </a>
              <input type="hidden"  class=" no-follow" name="business_license_electronic[]" id="business_license_electronic" value="">
            </div>
          </div>
        </li>

      </ul>
      <div class="error-tips"></div>
      <div class="form-btn "><a class="btn" href="javascript:;"><?=__('申请入驻')?></a></div>
    </div>
  </form>
</div>
<footer id="footer" class="bottom"></footer>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/store_apply.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
