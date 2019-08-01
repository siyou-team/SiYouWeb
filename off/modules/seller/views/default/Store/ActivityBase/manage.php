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
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form"  data-validator-option="{stopOnError:false, timely:false}">
                <input type="hidden" class="input-text form-control" name="activity_id" id="activity_id" value="<?=i('activity_id')?>"  placeholder="<?=__('活动编号')?>" autocomplete="off" />

                <?php if(@i('activity_type_id')):?>
                    <input type="hidden" name="activity_type_id" value="<?=i('activity_type_id')?>">
                <?php endif;?>

                 <input type="hidden" name="action" value="edit">

                <div class="form-section">
                    <label class="input-label" for="activity_title" title="<?=__('活动名称将显示在活动列表中，方便商家管理使用。')?>" data-toggle="tooltip"  ><?=__('活动名称')?></label>
                    <input type="text" class="input-text form-control" name="activity_title" id="activity_title"  placeholder="<?=__('活动标题')?>" autocomplete="off"  data-rule="<?=__('活动名称')?>:required" required />
                </div>

                <div class="form-section">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" <?php if(i('activity_id')){ echo 'disabled';}?> placeholder="<?=__('活动开始时间')?>" data-rule="<?=__('活动开始时间')?>:required" required autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime"  placeholder="<?=__('活动结束时间')?>" <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required autocomplete="off" />
                </div>
                <?php if(@i('activity_type_id') == StateCode::ACTIVITY_TYPE_LIMITED_DISCOUNT):?>
                    <div class="form-section">
                        <label class="input-label" for="subtotal" title="<?=__('参加活动的最低购买数量，默认为1')?>" data-toggle="tooltip"><?=__('购买下限')?></label>
                        <input type="text" class="input-text form-control" name="subtotal" id="subtotal"  placeholder="<?=__('活动标题')?>" autocomplete="off" data-rule="<?=__('购买下限')?>:required" required />
                    </div>
                <?php endif;?>


            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>

<script type="text/javascript" src="<?= $this->js('plugins/datepicker/dateTimePicker', true) ?>"></script>