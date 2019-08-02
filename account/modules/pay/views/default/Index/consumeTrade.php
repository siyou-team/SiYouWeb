
<div class="alert alert-default" role="alert">
    <p></p>
</div>
<table  id="consume-trade-table" class="table table-bordered table-hover dataTable table-striped width-full text-center">
    <thead>
    <tr>
<!--        <th>交易订单id</th>
        <th>标题</th>-->
        <th><?=__('商户订单id')?></th>
        <th><?=__('交易类型')?></th>
        <th><?=__('总付款额度')?></th>
        <th><?=__('创建时间')?></th>
        <th><?=__('支付状态')?></th>
    </tr>
    </thead>
</table>


<?php $this->lazyJs('plugins/datatables/jquery.dataTables', true) ?>
<?php $this->lazyJs('plugins/datatables/dataTables.bootstrap', true) ?>

<?php $this->lazyJs('modules/pay/index') ?>
