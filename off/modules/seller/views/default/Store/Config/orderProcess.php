<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<script type="text/javascript" src="<?= $this->js('plugins/formwizard/jquery.bootstrap.wizard', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('plugins/jquery-validate/jquery.validate', true) ?>"></script>

<style type="text/css">

    .steps {
        margin-bottom: 22px
    }

    .steps.row {
        display: block;
        margin-right: 0;
        margin-left: 0
    }

    .step {
        position: relative;
        padding: 10px 15px;
        margin: 0;
        font-size: inherit;
        color: #a3afb7;
        vertical-align: top;
        background-color: #f3f7f9;
        border-radius: 0
    }

    .step-icon {
        float: left;
        margin-top: 4px;
        margin-right: .5em;
        font-size: 16px
    }

    .step-number {
        position: absolute;
        top: 50%;
        left: 15px;
        width: 32px;
        height: 32px;
        font-size: 20px;
        line-height: 32px;
        color: #fff;
        text-align: center;
        background: #e4eaec;
        border-radius: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%)
    }

    .step-number ~ .step-desc {
        min-height: 32px;
        margin-left: 42px
    }

    .step-title {
        margin-bottom: 0;
        font-size: 16px;
        color: #526069
    }

    .step-desc {
        text-align: left
    }

    .step-desc p {
        margin-bottom: 0
    }

    .steps-vertical .step {
        display: block;
        padding: 12px 15px
    }

    .steps-vertical .step[class*=col-] {
        float: none;
        width: 100%
    }

    .step.current {
        color: #fff;
        background-color: #62a8ea
    }

    .step.current .step-title {
        color: #fff
    }

    .step.current .step-number {
        color: #62a8ea;
        background-color: #fff
    }

    .step.disabled {
        color: #ccd5db;
        pointer-events: none;
        cursor: auto
    }

    .step.disabled .step-title {
        color: #ccd5db
    }

    .step.disabled .step-number {
        background-color: #ccd5db
    }

    .step.error {
        color: #fff;
        background-color: #f96868
    }

    .step.error .step-title {
        color: #fff
    }

    .step.error .step-number {
        color: #f96868;
        background-color: #fff
    }

    .step.done {
        color: #fff;
        background-color: #46be8a
    }

    .step.done .step-title {
        color: #fff
    }

    .step.done .step-number {
        color: #46be8a;
        background-color: #fff
    }

    .steps-lg .step {
        padding: 15px 15px;
        font-size: 14px
    }

    .steps-lg .step-icon {
        font-size: 18px
    }

    .steps-lg .step-title {
        font-size: 18px
    }

    .steps-lg .step-number {
        width: 46px;
        height: 46px;
        font-size: 28px;
        line-height: 46px
    }

    .steps-lg .step-number ~ .step-desc {
        min-height: 46px;
        margin-left: 56px
    }

    .steps-sm .step {
        font-size: 12px
    }

    .steps-sm .step-icon {
        font-size: 18px
    }

    .steps-sm .step-title {
        font-size: 18px
    }

    .steps-sm .step-number {
        width: 30px;
        height: 30px;
        font-size: 24px;
        line-height: 30px
    }

    .steps-sm .step-number ~ .step-desc {
        min-height: 30px;
        margin-left: 40px
    }

    .steps-sm .step-icon {
        margin-top: 3px
    }

    .steps-xs .step {
        font-size: 12px
    }

    .steps-xs .step-icon {
        font-size: 16px
    }

    .steps-xs .step-title {
        font-size: 16px
    }

    .steps-xs .step-number {
        width: 24px;
        height: 24px;
        font-size: 20px;
        line-height: 24px
    }

    .steps-xs .step-number ~ .step-desc {
        min-height: 24px;
        margin-left: 34px
    }

    .steps-xs .step-icon {
        margin-top: 3px
    }

    .pearls {
        margin-bottom: 22px
    }

    .pearls.row {
        display: block
    }

    .pearl {
        position: relative;
        padding: 0;
        margin: 0;
        text-align: center
    }

    .pearl:after, .pearl:before {
        position: absolute;
        top: 18px;
        z-index: 0;
        width: 50%;
        height: 4px;
        content: "";
        background-color: #f3f7f9
    }

    .pearl:before {
        left: 0
    }

    .pearl:after {
        right: 0
    }

    .pearl:first-child:before, .pearl:last-child:after {
        display: none !important
    }

    .pearl-icon, .pearl-number {
        position: relative;
        z-index: 1;
        display: inline-block;
        width: 36px;
        height: 36px;
        line-height: 32px;
        color: #fff;
        text-align: center;
        background: #ccd5db;
        border: 2px solid #ccd5db;
        border-radius: 50%
    }

    .pearl-number {
        font-size: 18px
    }

    .pearl-icon {
        font-size: 18px
    }

    .pearl-title {
        display: block;
        margin-top: .5em;
        margin-bottom: 0;
        overflow: hidden;
        font-size: 16px;
        color: #526069;
        text-overflow: ellipsis;
        word-wrap: normal;
        white-space: nowrap
    }

    .pearl.current:after, .pearl.current:before {
        /*background-color: #62a8ea*/
    }

    .pearl.current .pearl-icon, .pearl.current .pearl-number {
        color: #62a8ea;
        background-color: #fff;
        border-color: #62a8ea;
        -webkit-transform: scale(1.3);
        -ms-transform: scale(1.3);
        -o-transform: scale(1.3);
        transform: scale(1.3)
    }

    .pearl.disabled {
        pointer-events: none;
        cursor: auto
    }

    .pearl.disabled:after, .pearl.disabled:before {
        background-color: #f3f7f9
    }

    .pearl.disabled .pearl-icon, .pearl.disabled .pearl-number {
        color: #fff;
        background-color: #ccd5db;
        border-color: #ccd5db
    }

    .pearl.error:before {
        background-color: #62a8ea
    }

    .pearl.error:after {
        background-color: #f3f7f9
    }

    .pearl.error .pearl-icon, .pearl.error .pearl-number {
        color: #f96868;
        background-color: #fff;
        border-color: #f96868
    }

    .pearl.done:after, .pearl.done:before {
        background-color: #62a8ea
    }

    .pearl.done .pearl-icon, .pearl.done .pearl-number {
        color: #fff;
        background-color: #62a8ea;
        border-color: #62a8ea
    }

    .pearls-lg .pearl:after, .pearls-lg .pearl:before {
        top: 20px
    }

    .pearls-lg .pearl-title {
        font-size: 18px
    }

    .pearls-lg .pearl-icon, .pearls-lg .pearl-number {
        width: 40px;
        height: 40px;
        line-height: 36px
    }

    .pearls-lg .pearl-icon {
        font-size: 20px
    }

    .pearls-lg .pearl-number {
        font-size: 20px
    }

    .pearls-sm .pearl:after, .pearls-sm .pearl:before {
        top: 16px
    }

    .pearls-sm .pearl-title {
        font-size: 14px
    }

    .pearls-sm .pearl-icon, .pearls-sm .pearl-number {
        width: 32px;
        height: 32px;
        line-height: 28px
    }

    .pearls-sm .pearl-number {
        font-size: 16px
    }

    .pearls-sm .pearl-icon {
        font-size: 14px
    }

    .pearls-xs .pearl:after, .pearls-xs .pearl:before {
        top: 12px;
        height: 2px
    }

    .pearls-xs .pearl-title {
        font-size: 12px
    }

    .pearls-xs .pearl-icon, .pearls-xs .pearl-number {
        width: 24px;
        height: 24px;
        line-height: 20px
    }

    .pearls-xs .pearl-number {
        font-size: 12px
    }

    .pearls-xs .pearl-icon {
        font-size: 12px
    }
</style>
<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="main-content">

        <div class="row">
            <div class="col-md-12">

                <div class="panel" id="process">
                    <div class="panel-heading">
                        <h3 class="panel-title">订货流程设置</h3>
                    </div>
                    <div class="panel-body">

                        <div class="pearls row">

                            <div class="pearl col-xs-2 <?=(in_array(StateCode::ORDER_PROCESS_PAY, $data['sc_order_process']) ? 'current' : '')?>"  data-id="<?=StateCode::ORDER_PROCESS_PAY?>"">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">支付</span>
                            </div>
                            <div class="pearl col-xs-2 <?=(in_array(StateCode::ORDER_PROCESS_CHECK, $data['sc_order_process']) ? 'current' : '')?>"  data-id="<?=StateCode::ORDER_PROCESS_CHECK?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">订单审核</span>
                            </div>
                            <div class="pearl col-xs-2  <?=(in_array(StateCode::ORDER_PROCESS_FINANCE_REVIEW, $data['sc_order_process']) ? 'current' : '')?>" data-id="<?=StateCode::ORDER_PROCESS_FINANCE_REVIEW?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">财务审核</span>
                            </div>

                            <div class="pearl col-xs-2  <?=(in_array(StateCode::ORDER_PROCESS_OUT, $data['sc_order_process']) ? 'current' : '')?>" data-id="<?=StateCode::ORDER_PROCESS_OUT?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">出库审核</span>
                            </div>
                            <div class="pearl col-xs-2  <?=(in_array(StateCode::ORDER_PROCESS_SHIPPED, $data['sc_order_process']) ? 'current' : '')?>" data-id="<?=StateCode::ORDER_PROCESS_SHIPPED?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">发货确认</span>
                            </div>
                            <div class="pearl col-xs-2 default current" data-id="<?=StateCode::ORDER_PROCESS_RECEIVED?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">【客户】收货确认</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel" id="return_process">
                    <div class="panel-heading">
                        <h3 class="panel-title">退货流程设置</h3>
                    </div>
                    <div class="panel-body">

                        <div class="pearls row">
                            <div class="pearl col-xs-2 default current" data-id="<?=StateCode::RETURN_PROCESS_SUBMIT?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">【客户】提交退单</span>
                            </div>
                            <div class="pearl col-xs-2 default current" data-id="<?=StateCode::RETURN_PROCESS_CHECK?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">退单审核</span>
                            </div>
                            <div class="pearl col-xs-2  <?=(in_array(StateCode::RETURN_PROCESS_RECEIVED, $data['sc_order_return_process']) ? 'current' : '')?>" data-id="<?=StateCode::RETURN_PROCESS_RECEIVED?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">收货确认</span>
                            </div>

                            <div class="pearl col-xs-2  <?=(in_array(StateCode::RETURN_PROCESS_REFUND, $data['sc_order_return_process']) ? 'current' : '')?>" data-id="<?=StateCode::RETURN_PROCESS_REFUND?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">退款确认</span>
                            </div>
                            <div class="pearl col-xs-2  <?=(in_array(StateCode::RETURN_PROCESS_RECEIPT_CONFIRMATION, $data['sc_order_return_process']) ? 'current' : '')?>" data-id="<?=StateCode::RETURN_PROCESS_RECEIPT_CONFIRMATION?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">【客户】收款确认</span>
                            </div>
                            <div class="pearl col-xs-2 default current" data-id="<?=StateCode::RETURN_PROCESS_FINISH?>">
                                <div class="pearl-icon"><i class="icon-shezhi"></i></div>
                                <span class="pearl-title">完成</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(function ()
        {
            $(".pearl ").on('click', function ()
            {
                if (!$(this).hasClass('default'))
                {

                    $(this).toggleClass('current');


                    var process_list = [];

                    $("#process .current").each(function ()
                    {

                        process_list.push($(this).data('id'))
                    })

                    var return_process_list = [];

                    $("#return_process .current").each(function ()
                    {

                        return_process_list.push($(this).data('id'))
                    })

                    Public.ajax( {
                        url:SYS.CONFIG.index_url + '?mdu=seller&ctl=Store_Config&met=saveOrderProcess&typ=json',
                        data: {'sc_order_process': process_list, 'sc_order_return_process':return_process_list},
                        type: "POST",
                        dataType: "json",
                        loading: true,
                        timeout:900000 //15mins 
                    })
                }
            })

        })
    </script>
