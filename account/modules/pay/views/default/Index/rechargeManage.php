<div class="content-main pay">
    <form  method="post" enctype="multipart/form-data" action="<?=url('Index', 'rechargePage', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" id="withdraw-form" name="withdraw-form">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="number" class="form-control" name="recharge_amount" id="recharge_amount" value="1000" placeholder="<?=__('请输入充值金额')?>" autocomplete="off" required="" aria-required="true">
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" id="rechargePage_btn" class="btn btn-primary"  style="margin-top: 20px;"><?=__('确认充值')?></button>
        </div>

    </form>

</div>
<?php

$js = <<<JS
$(function(){
})
JS;
$this->lazyJsString($js);
?>