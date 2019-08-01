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
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" data-validator-option="{stopOnError:false, timely:false}">
                <input type="hidden" class="input-text form-control" name="activity_id" id="activity_id" value="<?=i('activity_id')?>"  placeholder="<?=__('活动编号')?>" autocomplete="off" />

                <?php if(@i('activity_type_id')):?>
                    <input type="hidden" name="activity_type_id" value="<?=i('activity_type_id')?>">
                <?php endif;?>

                <input type="hidden" name="action" value="voucher">

                <div class="form-section">
                    <label class="input-label" for="activity_title"><?=__('优惠券名称')?></label>
                    <input type="text" class="input-text form-control" name="activity_title" id="activity_title" <?=s('action') == 'detail'?'readonly':''?> placeholder="<?=__('优惠券名称')?>" autocomplete="off" data-rule="<?=__('优惠券名称')?>:required" required  />
                </div>
                <div class="form-group">
                    <label class="control-label" for="voucher_image">优惠券图标</label>
                    <div class="inline">
                        <a href="#"  data-toggle="image" class="img-thumbnail picture_upload_replace" id="voucher_image_upload_replace_id" data-target="voucher_image">
                            <input type="hidden" class="form-control" name="voucher_image" id="voucher_image"
                                   value="" placeholder="商品单价" autocomplete="off"/>
                            <img src=""  data-placeholder="" width="50" height="50" data-toggle="tooltip" /></a>
                    </div>
                    <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                </div>
                <div class="form-section">
                    <label class="input-label" for="subtotal"><?=__('消费金额')?></label>
                    <input type="text" class="input-text form-control" name="subtotal" id="subtotal" <?=s('action') == 'detail'?'readonly':''?>  placeholder="<?=__('消费金额')?>" autocomplete="off"  data-rule="<?=__('消费金额')?>:required" required />
                </div>
                <div class="form-section">
                    <label class="input-label" for="voucher_price" title="<?=__('优惠券的消费金额须大于面额')?>" data-toggle="tooltip"><?=__('面额')?></label>
                    <input type="text" class="input-text form-control" name="voucher_price" id="voucher_price" <?=s('action') == 'detail'?'readonly':''?>  placeholder="<?=__('面额')?>" autocomplete="off"  data-rule="<?=__('面额')?>:required" required />
                </div>
                <div class="form-section">
                    <label class="input-label" for="voucher_quantity"><?=__('可发放总数')?></label>
                    <input type="text" class="input-text form-control" name="voucher_quantity" id="voucher_quantity" <?=s('action') == 'detail'?'readonly':''?> placeholder="<?=__('可发放总数')?>" autocomplete="off"  data-rule="<?=__('可发放总数')?>:required" required />
                </div>
                <div class="form-section">
                    <label class="input-label" for="voucher_pre_quantity"><?=__('每人限领')?></label>
                    <input type="text" class="input-text form-control" name="voucher_pre_quantity" id="voucher_pre_quantity" <?=s('action') == 'detail'?'readonly':''?>  placeholder="<?=__('每人限领')?>" autocomplete="off"  data-rule="<?=__('每人限领')?>:required" required />
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip"><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" data-format="Y-m-d"  placeholder="<?=__('活动开始时间')?>" autocomplete="off"  <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动开始时间')?>:required" required  />
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip"><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime" data-format="Y-m-d"   placeholder="<?=__('活动结束时间')?>" autocomplete="off"  <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required  />
                </div>

                <div class="form-section">
                    <label class="input-label hide" for="activity_state"><?=__('活动状态')?></label>
                    <label title="未开启" for="activity_state_0"><input class="cbr cbr-success form-control" id="activity_state_0" name="activity_state" value="0" type="radio"  ><?=__('未开启')?></label><label title=<?=__('正常')?>" for="activity_state_1"><input class="cbr cbr-success form-control" id="activity_state_1" name="activity_state" value="1" type="radio" checked ><?=__('正常')?></label>
                </div>

                <div class="form-section">
                    <label class="input-label hide" for="activity_type" title="<?=__('“积分参与”时会员可以在积分中心用积分进行兑换；“购买参与”时会员需要在购买商品时获得；“免费参与”时会员可以点击店铺的优惠券推广广告领取优惠券。')?>" data-toggle="tooltip"><?=__('参与类型')?></label>
                    <label title="<?=__('免费参与')?>" for="activity_type_1"><input class="cbr cbr-success form-control" id="activity_type_1" name="activity_type" value="1" type="radio" checked ><?=__('免费参与')?></label><label title="积分参与" for="activity_type_2"><input class="cbr cbr-success form-control" id="activity_type_2" name="activity_type" value="2" type="radio"  ><?=__('积分参与')?></label><label title="<?=__('购买参与')?>" for="activity_type_3"><input class="cbr cbr-success form-control" id="activity_type_3" name="activity_type" value="3" type="radio"  ><?=__('购买参与')?></label>
                </div>

                <div class="form-section">
                    <label class="input-label" for="voucher_points_needed"><?=__('需要积分数')?></label>
                    <input type="text" class="input-text form-control" name="voucher_points_needed" id="voucher_points_needed" <?=s('action') == 'detail'?'readonly':''?>  placeholder="<?=__('请输入参与的积分数')?>" autocomplete="off"  data-rule="<?=__('积分')?>:required"  />
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>