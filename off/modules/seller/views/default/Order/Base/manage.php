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
                <input type="hidden" class="input-text form-control" name="order_id" id="order_id"  placeholder="<?=__('订单Id')?>" autocomplete="off" />

                <div class="form-group">
                    <select class="input_txt form-inline title-form form-control select2" style="width: 120px;" id="buyer_user_id" name="buyer_user_id" placeholder="请输入买家用户昵称" >
                    </select>
                </div>
                <div class="form-section col-lg-12 col-sm-12">
                    <div class="wrapper">
                        <div class="grid-wrap">
                            <table id="order_add"></table>
                            <div id="grid-pager"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section form-section-active" id="costume_address">
                    <label class="input-label" for=""><?=__('收货地址')?></label>
                    <transition name="fade">
                        <select class="form-control text-center" style="text-align:center" name="ud_id">
                            <option :value="-1">请选择收货地址</option>
                            <option v-for="item in items" :value="item.ud_id" v-text="item.ud_province + '/' + item.ud_city + '/' + item.ud_county + '  ' + item.ud_address"></option>
                        </select>
                    </transition>
                    <br />
                    <div class="btn btn-primary" id="J_addAddress"><i class="fa fa-plus"></i>添加新地址</div>
                </div>

                <div class="hide">
                    <div class="form-section form-section-active">
                        <label class="input-label" for="checkout_row[delivery_time_id]"><?=__('配送时间')?></label>
                        <br />
                        <label title="不限送货时间" for="time_id_1"><input class="cbr cbr-success form-control" id="time_id_1" name="checkout_row[delivery_time_id]" value="1" type="radio" checked >周一至周日</label>
                        <label title="工作日送货" for="time_id_2"><input class="cbr cbr-success form-control" id="time_id_2" name="checkout_row[delivery_time_id]" value="2" type="radio"  >周一至周五</label>
                        <label title="双休日、假日送货" for="time_id_3"><input class="cbr cbr-success form-control" id="time_id_3" name="checkout_row[delivery_time_id]" value="3" type="radio"  >周六至周日</label>
                    </div>


                    <div class="form-section form-section-active">
                        <label class="input-label" for="checkout_row[invoice_type_id]"><?=__('发票')?></label>
                        <br />
                        <label title="不开发票" for="not_invoice"><input class="cbr cbr-success form-control" id="not_invoice" name="checkout_row[invoice_type_id]" value="1" type="radio" checked >不开发票</label>
                        <label title="电子发票（非纸质）" for="electron"><input class="cbr cbr-success form-control" id="electron" name="checkout_row[invoice_type_id]" value="2" type="radio"  >电子发票（非纸质）</label>
                        <label title="普通发票（纸质）" for="personal"><input class="cbr cbr-success form-control" id="personal" name="checkout_row[invoice_type_id]" value="3" type="radio"  >普通发票（纸质）</label>
                    </div>
                    <br />
                    <div class="form-section form-section-active">
                        <label title="个人" for="personal"><input class="cbr cbr-success form-control" id="personal" name="checkout_row[invoice_type]" value="1" type="radio" checked >个人</label>
                        <label title="单位" for="company"><input class="cbr cbr-success form-control" id="company" name="checkout_row[invoice_type]" value="2" type="radio"  >单位</label>
                    </div>

                    <div class="form-section" id="J_invoiceTitle">
                        <label class="input-label" for="checkout_row[invoice_title]">请输入发票抬头</label>
                        <input class="input-text form-control" type="text" id="invoice_title" name="checkout_row[invoice_title]" value="" autocomplete="off" />
                    </div>

                    <div class="form-section" id="J_invoiceCompanyCode">
                        <label class="input-label" for="invoice_company_code">请填写购买方纳税人识别号或统一社会信用代码</label>
                        <input class="input-text form-control" type="text" id="invoice_company_code" name="invoice_company_code" value="" autocomplete="off"/>
                    </div>
                </div>



            </form>
        </div>
    </div>
</div>
<script>
    position = 'manage';
</script>
<script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
<script src="<?=$this->js('modules/seller/order_base')?>"></script>
<script src="<?=$this->js('modules/seller/order/order_add')?>"></script>
