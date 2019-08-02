<div class="col-sm-6 pd0">
    <div class="xe-widget xe-counter-block  pb20" data-count=".num" data-from="0" data-to="<?=sprintf('%.2f', $data['user_money'])?>" data-prefix="¥" data-duration="2">
        <div class="xe-upper">
            <div class="xe-icon">
                <i class="fa-credit-card"></i>
            </div>
            <div class="xe-label">
                <strong class="num"><?=@format_money($data['user_money'])?></strong>
                <span><?=__('可用余额')?></span>
            </div>
        </div>
    </div>

</div>


<div class="col-sm-6 pd0">
    <div class="xe-widget xe-counter-block xe-counter-block-orange  pb20" data-count=".num" data-from="0" data-to="<?=sprintf('%.2f', $data['user_money_frozen'])?>" data-prefix="¥" data-duration="2">
        <div class="xe-upper">
            <div class="xe-icon">
                <i class="fa-credit-card"></i>
            </div>
            <div class="xe-label">
                <strong class="num"><?=@format_money($data['user_money_frozen'])?></strong>
                <span><?=__('冻结余额')?></span>
            </div>
        </div>
    </div>

</div>

<table id="J_balanceTable" class="table table-bordered table-hover dataTable table-striped width-full text-center no-footer">
    <thead>
    <tr>
        <th><?=__('金额（元）')?></th>
        <th><?=__('交易类型')?></th>
        <th><?=__('时间')?></th>
        <th><?=__('备注')?></th>
    </tr>
    </thead>

</table>

<?php $this->lazyJs('plugins/datatables/jquery.dataTables', true) ?>
<?php $this->lazyJs('plugins/datatables/dataTables.bootstrap', true) ?>

<?php $this->lazyJs('plugins/scrollMonitor', true) ?>
<?php $this->lazyJs('qianyi-widgets') ?>


<?php $this->lazyJs('modules/pay/resource_index') ?>

