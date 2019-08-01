<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="withdraw_id" id="withdraw_id"  placeholder="<?=__('ID')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="withdraw_amount"><?=__('提现额度')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_amount" id="withdraw_amount"  placeholder="<?=__('提现额度')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="withdraw_desc"><?=__('描述')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_desc" id="withdraw_desc"  placeholder="<?=__('描述')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="withdraw_bank"><?=__('银行')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_bank" id="withdraw_bank"  placeholder="<?=__('银行')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="withdraw_account_no"><?=__('银行账户')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_account_no" id="withdraw_account_no"  placeholder="<?=__('银行账户')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="withdraw_account_name"><?=__('开户名称')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_account_name" id="withdraw_account_name"  placeholder="<?=__('开户名称')?>" autocomplete="off" />
                </div>

                <div class="form-section">
                    <label class="input-label" for="withdraw_mobile"><?=__('联系手机')?></label>
                    <input type="text" class="input-text form-control" name="withdraw_mobile" id="withdraw_mobile"  placeholder="<?=__('联系手机')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/withdraw/consume_withdraw')?>"></script>