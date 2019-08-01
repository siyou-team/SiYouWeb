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
    <title><?=__('发布商品')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header" class="fixed">
    <div class="header-wrap">
        <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('发布商品')?></h1>
        </div>
        <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="zc zc-save save"></i></a> </div>
    </div>
</header>
<div class="sstouch-main-layout">
    <form>
        <div class="sstouch-inp-con">
            <ul class="form-box">
                <li class="form-item">
                    <h4><?=__('商品分类')?>:</h4>
                    <div class="input-box">
                        <input name="category_info" type="text" class="inp" id="category_info" autocomplete="off" onchange="btn_check($('form'));" readonly/>
                    </div>
                </li>
                <li class="form-item">
                    <h4><?=__('商品名称')?>:</h4>
                    <div class="input-box">
                        <input type="text" class="inp" name="g_name" id="g_name" autocomplete="off" oninput="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('商品价格')?>:</h4>
                    <div class="input-box">
                        <input type="tel" class="inp"  name="g_price"  id="g_price" autocomplete="off" oninput="writeClear($(this));"/>
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('市场价')?>:</h4>
                    <div class="input-box">
                        <input type="text" class="inp" name="g_marketprice" id="g_marketprice" autocomplete="off" oninput="writeClear($(this));" >
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('折扣')?>:</h4>
                    <div class="input-box">
                        <input type="number" class="inp" readonly name="g_discount" id="g_discount" />
                        <span class="input-del"></span> </div>
                </li>

                <li class="form-item upload-item">
                    <h4><?=__('商品主图')?>:</h4>
                    <div class="input-box">
                        <div class="sstouch-upload">
                            <a href="javascript:void(0);">
                                <span><input type="file" hidefocus="true" size="1" class="input-file" id="file_011" name="upfile" id=""></span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden" name="image_body_0" id="image_body_0" value="">
                        </div>
                        <div class="sstouch-upload">
                            <a href="javascript:void(0);">
                                <span><input type="file" hidefocus="true" size="1" class="input-file" id="file_012" name="upfile" id=""></span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden" name="image_body_1" id="image_body_1" value="">
                        </div>
                        <div class="sstouch-upload">
                            <a href="javascript:void(0);">
                                <span><input type="file" hidefocus="true" size="1" class="input-file" id="file_013" name="upfile" id=""></span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden" name="image_body_2" id="image_body_2" value="">
                        </div>
                        <div class="sstouch-upload">
                            <a href="javascript:void(0);">
                                <span><input type="file" hidefocus="true" size="1" class="input-file" id="file_014" name="upfile" id=""></span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden" name="image_body_3" id="image_body_3" value="">
                        </div>
                        <div class="sstouch-upload">
                            <a href="javascript:void(0);">
                                <span><input type="file" hidefocus="true" size="1" class="input-file" id="file_015" name="upfile" id=""></span>
                                <p><i class="icon-upload"></i></p>
                            </a>
                            <input type="hidden" name="image_body_4" id="image_body_4" value="">
                        </div>
                    </div>
                </li>

                <li class="form-item">
                    <h4><?=__('商品库存')?>:</h4>
                    <div class="input-box">
                        <input type="tel" class="inp" name="g_storage" id="g_storage" autocomplete="off" oninput="writeClear($(this));">
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('商家货号')?>:</h4>
                    <div class="input-box">
                        <input type="tel" class="inp" name="g_serial" id="g_serial" autocomplete="off" oninput="writeClear($(this));">
                        <span class="input-del"></span> </div>
                </li>
                <li class="form-item">
                    <h4><?=__('物流费用')?>:</h4>
                    <div class="input-box">
                        <input type="tel" class="inp" name="g_freight" id="g_freight" autocomplete="off" oninput="writeClear($(this));">
                        <span class="input-del" ></span> </div>
                </li>
                <li class="form-item" style="font-size:0.5rem;" id="feeinfo">
                </li>

                <li class="form-item" style="height:3rem;">
                    <h4><?=__('商品描述')?>:</h4>
                    <div class="input-box evaluation-inp-block">
                        <input type="text" class="textarea" name="g_body" id="g_body"  >
                        <span class="input-del"></span> </div>
                </li>

            </ul>
            <ul id="goodstate">
                <li style="font-size:0.6rem;padding-left:0.5rem;"><?=__('商品状态：')?>
                    <input type="radio" class="inp" name="g_state" value=1 >&nbsp;<?=__('立即发布')?>&nbsp;
                    <input type="radio" class="inp" name="g_state" value=0 checked>&nbsp;<?=__('放人仓库')?>
                </li>
            </ul>
            <div class="error-tips"></div>
            <div class="form-btn ok"><a class="btn" href="javascript:;"><?=__('发布商品')?></a></div>

        </div>

    </form>
</div>
<footer id="footer" class="bottom"></footer>

<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>

<script type="text/javascript" src="../../js/tmpl/seller/seller_footer.js"></script>
<script type="text/javascript" src="../../js/tmpl/seller/store_goods_add.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
