<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<title>ShopSuite &rsaquo; <?=$this->title?></title>
	<link rel="stylesheet" href="<?=$this->css('buttons', true)?>" type="text/css" media='all' />
	<link rel="stylesheet" href="<?=$this->css('install', true)?>" type="text/css" media='all' />
    <script type="text/javascript" src="<?=$this->js('jquery', true)?>"></script>
    <script type="text/javascript" src="<?=$this->js('jquery.percentageloader-0.1.min', true)?>"></script>
</head>
<body class="wp-core-ui">
<p id="logo"><a href="//www.shopsuite.cn/" tabindex="-1">ShopSuite</a></p>
<?php include $this->getView(); ?>
</body>
</html>
