<div class="alert alert-default" role="alert">
    <div class="btn btn-primary" id="addUserBank"><?=__('添加银行卡')?></div>
</div>

<form class="layui-form" style="display:none">
    <input type="text"/>
    <input type="password"/>
</form>

<form style="display: none;" method="post" enctype="multipart/form-data" action="<?= htmlspecialchars(urlh('account.php', 'Index', 'userBank', 'pay', 'typ=json'))?>" id="userBank-form" name="userBank-form">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="bank_id" data-toggle="tooltip" title="" data-original-title="<?= __('选择银行')?>："><span style="color:red">*</span><?=__('选择银行')?>:</label>
        <div class="col-sm-10">
            <input type="hidden" name="bank_name" id="bank_name" value="">
            <select type="text" class="form-control" name="bank_id" id="bank_id" value="" autocomplete="off" required="" aria-required="true">
                <?php foreach ($data['bank_list'] as $bank_list) {?>
                    <option value="<?=$bank_list['bank_id']?>"><?=$bank_list['bank_name']?></option>
                <?php }?>
            </select>
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_bank_card_address" data-toggle="tooltip" title="" data-original-title="<?=__('开户支行')?>："><span style="color:red">*</span><?=__('开户支行')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_bank_card_address" id="user_bank_card_address" value="" placeholder="<?=__('请输入开户支行')?>" autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_bank_card_code" data-toggle="tooltip" title="" data-original-title="<?= __('收款方式') ?>："><span style="color:red">*</span><?=__('银行卡卡号')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_bank_card_code" id="user_bank_card_code" value="" placeholder="<?=__('请输入银行卡卡号')?>" autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_bank_card_name" data-toggle="tooltip" title="" data-original-title="<?=__('持卡人姓名')?>："><span style="color:red">*</span><?=__('持卡人姓名')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_bank_card_name" id="user_bank_card_name" value="" placeholder="<?=__('请输入持卡人姓名')?>" autocomplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_bank_card_mobile" data-toggle="tooltip" title="" data-original-title="<?=__('手机号')?>："><span style="color:red">*</span><?=__('手机号')?>:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_bank_card_mobile" id="user_bank_card_mobile" value="" placeholder="<?=__('请输入银行预留手机号')?>" autoComplete="off" required="" aria-required="true">
        </div>
    </div>
    <div>&nbsp;</div>


    <button type="submit" id="J_submit" class="btn btn-primary form-control"><?=__('确认添加')?></button>
</form>

<table  id="J_userBankTable" class="table table-bordered table-hover dataTable table-striped width-full text-center">
    <thead>
    <tr>
        <th><?=__('用户卡ID')?></th>
        <th><?=__('银行名称')?></th>
        <th><?=__('银行卡卡号')?></th>
        <th><?=__('持卡人')?></th>
        <th><?=__('操作')?></th>
    </tr>
    </thead>
</table>

<?php $this->lazyJs('plugins/datatables/jquery.dataTables', true) ?>
<?php $this->lazyJs('plugins/datatables/dataTables.bootstrap', true) ?>
<?php $this->lazyJs('modules/pay/user_bank') ?>

