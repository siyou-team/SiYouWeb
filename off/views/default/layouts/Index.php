<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="renderer" content="webkit" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<meta name="description" content="上海迅有收银系统" />
	<meta name="author" content="" />
	<title><?=__('管理中心')?></title>
	<link rel="stylesheet" href="<?=$this->css('bootstrap')?>">
	<link rel="stylesheet" href="<?=$this->css('offline')?>"> 
    <link rel="shortcut icon" href="<?=$this->img('favicon.ico')?>" type="image/x-icon" />
    <?php if( $this->registry('language') == 'it') { ?> 
    <link rel="stylesheet" type="text/css" href="<?=$this->css('it',false)?>" />
    <?php } ?>
    <script type="text/javascript">
        window.SYS = {};
        SYS.VER = '<?=VER?>';
        SYS.DEBUG = <?=intval(DEBUG)?>;
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            admin_url:   '<?=Zero_Registry::get('base_url')?>/admin.php',
            base_url:    '<?=Zero_Registry::get('base_url')?>',
            index_url:   '<?=Zero_Registry::get('url')?>',
            index_page:  '<?=Zero_Registry::get('index_page')?>',
            static_url:  '<?=Zero_Registry::get('static_url')?>'
        };

        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
        SYSTEM.language = "<?=$this->registry('language')?>";
    </script>
	<script src="<?=$this->js('common/jquery')?>?self=false"></script>
	<script type="text/javascript">
		function __(a){return"zh-CN"!=SYSTEM.language&&lang_package[a]?lang_package[a]:a};
		var resizefunc = [];
	</script>
    <script src="<?=$this->js('lang/'.$this->registry('language'),false)?>"></script>   
	<script src="<?=$this->js('bootstrap/bootstrap.min')?>?self=false"></script>
	<script src="<?=$this->js('fastclick')?>"></script>
	<script src="<?=$this->js('jquery.slimscroll')?>"></script>
	<script src="<?=$this->js('jquery.blockUI')?>"></script>
	<script src="<?=$this->js('wow.min')?>"></script>
	<script src="<?=$this->js('menu')?>"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="fixed-left">
	<?php include $this->getView(); ?>
	<?php foreach ($this->getLazyLoadJs() as $url):?>
		<script type="text/javascript" src="<?=$url?>"></script>
	<?php endforeach;?>
	<?php foreach ($this->getLazyLoadJsString() as $str):?>
		<script type="text/javascript">
			<?=$str?>
		</script>
	<?php endforeach;?>
</body>
</html>