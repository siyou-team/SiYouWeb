<?php
$qrcode_img = Base_ConfigModel::qrcode(Zero_Registry::get('wap_url') . '#CH' . i('chain_id'));
?>


<div id="name" class="text-center"><img src="<?=$qrcode_img?>"></div>
