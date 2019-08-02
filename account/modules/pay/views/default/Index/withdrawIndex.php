<div class="alert alert-default" role="alert">
    <div class="btn btn-primary" id="J_addWithdraw"><?=__('申请提现')?></div>
    <a class="btn btn-primary" href="<?= url('Index', 'userBank', 'pay')?>"><?=__('银行卡管理')?></a>
</div>

<form class="layui-form" style="display:none">
    <input type="text"/>
    <input type="password"/>
</form>
<form style="display: none;" method="post" enctype="multipart/form-data" action="<?= htmlspecialchars(urlh('account.php', 'Index', 'addWithdraw', 'pay', 'typ=json'))?>" id="withdraw-form" name="withdraw-form">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="withdraw_amount" data-toggle="tooltip" title="" data-original-title="<?= __('提现金额')?>："><span style="color:red">*</span><?=__('提现金额')?>:</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="withdraw_amount" id="withdraw_amount" value="" placeholder="<?=__('请输入充值金额')?>" autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="withdraw_bank" data-toggle="tooltip" title="" data-original-title="<?= __('收款方式') ?>："><span style="color:red">*</span><?=__('收款方式')?>:</label>
        <div class="col-sm-10">
            <select type="text" class="form-control" name="withdraw_bank" id="withdraw_bank" value="" autocomplete="off" required="" aria-required="true">
                    <option value="0"><?=__('请选择收款方式')?></option>
                <?php foreach ($data['bank_list'] as $bank_list) {?>
                    <option value="<?= @$bank_list['user_bank_id'] ?>"><?= @$bank_list['bank_name'] ?><?= @$bank_list['user_bank_card_address']?></option>
                <?php }?>
            </select>
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="withdraw_account_no" data-toggle="tooltip" title="" data-original-title="<?=__('收款账号')?>："><span style="color:red">*</span><?=__('收款账号')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="withdraw_account_no" id="withdraw_account_no" value="" placeholder="<?=__('填写您选择提现方式的账号，银行卡号、支付宝、微信号等')?>" autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="withdraw_account_name" data-toggle="tooltip" title="" data-original-title="<?=__('收&nbsp;&nbsp;款&nbsp;&nbsp;人')?>："><span style="color:red">*</span><?=__('收&nbsp;&nbsp;款&nbsp;&nbsp;人')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="withdraw_account_name" id="withdraw_account_name" value="" placeholder="<?=__('请如实填写您的收款人姓名，否则将会影响到收款')?>" autocomplete="off"autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="withdraw_mobile" data-toggle="tooltip" title="" data-original-title="<?=__('手机号码')?>:"><span style="color:red">*</span><?=__('手机号码')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="withdraw_mobile" id="withdraw_mobile" value="" placeholder="<?=__('手机号码方便联系您')?>" autoComplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="password" data-toggle="tooltip" title="" data-original-title="<?=__('支付密码')?>:"><span style="color:red">*</span><?=__('支付密码')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="password" readonly onfocus="this.removeAttribute('readonly');"/ id="password" placeholder="<?=__('验证您的身份，我们将在2个工作日内将提现金额转至您的提现账号中')?>" autocomplete="new-password" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>


    <button type="submit" id="J_submit" class="btn btn-primary form-control"><?=__('确认提现')?></button>
</form>
<table  id="J_withdrawTable" class="table table-bordered table-hover dataTable table-striped width-full text-center">
    <thead>
    <tr>
        <th><?=__('提现审核id')?></th>
        <th><?=__('提现金额')?></th>
        <th><?=__('创建时间')?></th>
        <th><?=__('审核状态')?></th>
        <th><?=__('备注')?></th>
    </tr>
    </thead>
</table>

<?php $this->lazyJs('plugins/datatables/jquery.dataTables', true) ?>
<?php $this->lazyJs('plugins/datatables/dataTables.bootstrap', true) ?>
<?php $this->lazyJs('modules/pay/consume_withdraw') ?>

