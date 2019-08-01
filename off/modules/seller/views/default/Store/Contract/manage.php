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
                <input type="hidden" class="input-text form-control" name="contract_id" id="contract_id"  placeholder="<?=__('关联ID')?>" autocomplete="off" />

                <span id="warehouse_id"></span>

                <div class="form-section">
                    <label class="input-label" for="contract_type_id"><?=__('服务id')?></label>
                    <input type="text" class="input-text form-control" name="contract_type_id" id="contract_type_id"  placeholder="<?=__('服务id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_id"><?=__('商铺id')?></label>
                    <input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="<?=__('商铺id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_name"><?=__('商铺名称')?></label>
                    <input type="text" class="input-text form-control" name="store_name" id="store_name"  placeholder="<?=__('商铺名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="contract_type_name"><?=__('服务类别名称')?></label>
                    <input type="text" class="input-text form-control" name="contract_type_name" id="contract_type_name"  placeholder="<?=__('服务类别名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="contract_state"><?=__('状态：1-可以使用 2-永久不能使用')?></label>
                    <input type="text" class="input-text form-control" name="contract_state" id="contract_state"  placeholder="<?=__('状态：1-可以使用 2-永久不能使用')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="contract_use_state"><?=__('加入状态：1--已加入 2-已退出')?></label>
                    <input type="text" class="input-text form-control" name="contract_use_state" id="contract_use_state"  placeholder="<?=__('加入状态：1--已加入 2-已退出')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="contract_cash"><?=__('保障金余额')?></label>
                    <input type="text" class="input-text form-control" name="contract_cash" id="contract_cash"  placeholder="<?=__('保障金余额')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="contract_log_id"><?=__('保证金当前日志id')?></label>
                    <input type="text" class="input-text form-control" name="contract_log_id" id="contract_log_id"  placeholder="<?=__('保证金当前日志id')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    var position = 'seller';
</script>
<script src="<?=$this->js('controllers/store/store_contract')?>"></script>