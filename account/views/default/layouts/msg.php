<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="renderer" content="webkit" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<meta name="description" content="Qianyi Boostrap Admin Panel" />
	<meta name="author" content="" />

	<title><?=__('消息提示')?></title>

	<link rel="stylesheet" href="<?=$this->css('bootstrap', true)?>">

    <link rel="shortcut icon" href="<?=$this->img('favicon.ico')?>" type="image/x-icon" />

    <script src="<?=$this->js('require', true)?>" data-main="<?=$this->js('app')?>" defer async="true"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <script type="text/javascript">

        window.SYS = {};
        SYS.VER = '<?=VER?>';
        SYS.DEBUG = <?=intval(DEBUG)?>;
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            base_url: '<?=Zero_Registry::get('base_url')?>',
            index_url: "<?=Zero_Registry::get('url')?>",
            index_page: '<?=Zero_Registry::get('index_page')?>',
            static_url: '<?=Zero_Registry::get('static_url')?>'
        };
    </script>
</head>
<body>
<?php echo $msg ?>
</body>
</html>