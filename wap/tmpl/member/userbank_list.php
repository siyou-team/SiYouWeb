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
    <title><?=__('银行卡管理')?></title>
    <link rel="stylesheet" type="text/css" href="../../css/base.css">
    <link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
    <div class="header-wrap">
        <div class="header-l"> <a href="member.html"> <i class="zc zc-back back"></i> </a> </div>
        <div class="header-title">
            <h1><?=__('银行卡管理')?></h1>
        </div>
        <div class="header-r"> <a href="userbank_add.html"><i class="zc zc-add add"></i></a> </div>
    </div>
</header>
<div class="sstouch-main-layout mb20">
    <div class="sstouch-address-list" id="userbank_list"></div>
</div>
<footer id="footer" class="bottom"></footer>
<script type="text/html" id="_userbank_list">
    <%if(items.length>0){%>
    <ul>
        <%for(var i in items){%>
        <li>
            <dl>
                <dt>
                    <span class="name"><%=items[i].bank_name %></span>
                    <span class="phone"><%=items[i].user_bank_card_address %></span>
                </dt>
                <dd><%=items[i].user_bank_card_code %></dd>
            </dl>
            <div class="handle">
           		<span>
					<a href="javascript:;" userbank_id="<%=items[i].user_bank_id %>" class="deluserbank"><i class="zc zc-shanchu del"></i><?=__('删除')?></a>
				</span>
            </div>
        </li>
        <%}%>
    </ul>
    <a class="btn-l mt5" href="userbank_add.html"><?=__('添加银行卡')?></a>
    <%}else{%>
    <div class="sstouch-norecord address">
        <div class="norecord-ico"><i></i></div>
        <dl>
            <dt><?=__('您还没有过银行卡信息')?></dt>
        </dl>
        <a href="userbank_add.html" class="btn"><?=__('添加银行卡')?></a>
    </div>
    </div>
    <%}%>
</script>
<script> var navigate_id ="5";</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/userbank_list.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
