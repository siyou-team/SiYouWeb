<?php

require_once '../configs/config.ini.php';
include  LIB_PATH . "/phpqrcode/phpqrcode.php";

$data = s('data', s('url'));

QRcode::png($data);

die();
?>