<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row">
            <form class="form-inline title-form" id="grid-search-form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <select name="return_state_id" id="grid-search-form" class="input_txt form-inline title-form form-control select2" style="width:200px;">
                            <option value="0" selected>全部状态</option>
                            <option value="3100">提交退单</option>
                            <option value="3105">退单审核</option>
                            <option value="3110">收货确认</option>
                            <option value="3115">退款确认</option>
                            <option value="3120">收款确认</option>
                            <option value="3125">完成</option>
                            <option value="3130">已拒绝退款</option>
                            <option value="3135">已取消</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>
                    <div class="btn-group  pull-right">
                        <?php /*foreach ($data['sc_order_return_process'] as $order_return_process):*/?><!--
                            <?php /*if ($order_return_process == StateCode::RETURN_PROCESS_CHECK):*/?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-order-review"><?/*=__('退单审核')*/?></a>
                            <?php /*elseif ($order_return_process == StateCode::RETURN_PROCESS_RECEIVED):*/?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-order-finance-review"><?/*=__('收货确认')*/?></a>
                            <?php /*elseif ($order_return_process == StateCode::RETURN_PROCESS_REFUND):*/?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-stock-out-review"><?/*=__('退款确认')*/?></a>
                            <?php /*endif;*/?>
                        --><?php /*endforeach;*/?>


                        <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a>
                        <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>

                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="grid-pager"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/order/order_return')?>"></script>
