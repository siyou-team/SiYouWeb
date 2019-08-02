

<div class="col-sm-6 pd0">
    <div class="xe-widget xe-counter-block xe-counter-block-info  pb20" data-count=".num" data-from="0" data-to="<?=sprintf('%.2f', $data['user_recharge_card'])?>" data-prefix="¥" data-duration="2">
        <div class="xe-upper">
            <div class="xe-icon">
                <i class="fa-credit-card"></i>
            </div>
            <div class="xe-label">
                <strong class="num"><?=@format_money($data['user_recharge_card'])?></strong>
                <span><?=__('充值卡余额')?></span>
            </div>
        </div>
    </div>

</div>


<div class="col-sm-6 pd0">
    <div class="xe-widget xe-counter-block xe-counter-block-orange  pb20" data-count=".num" data-from="0" data-to="<?=sprintf('%.2f', $data['user_recharge_card_frozen'])?>" data-prefix="¥" data-duration="2">
        <div class="xe-upper">
            <div class="xe-icon">
                <i class="fa-credit-card"></i>
            </div>
            <div class="xe-label">
                <strong class="num"><?=@format_money($data['user_recharge_card_frozen'])?></strong>
                <span><?=__('冻结余额')?></span>
            </div>
        </div>
    </div>

</div>


<table id="J_ecardTable" class="table table-bordered table-hover dataTable table-striped width-full text-center no-footer">
    <thead>
    <tr>
        <th><?=__('卡号')?></th>
        <th><?=__('金额（元）')?></th>
        <th><?=__('时间')?></th>
        <th><?=__('备注')?></th>

    </tr>
    </thead>

</table>


<?php $this->lazyJs('plugins/datatables/jquery.dataTables', true) ?>
<?php $this->lazyJs('plugins/datatables/dataTables.bootstrap', true) ?>

<?php $this->lazyJs('plugins/scrollMonitor', true) ?>
<?php $this->lazyJs('qianyi-widgets') ?>

<?php $this->lazyJs('modules/pay/cart/index') ?>