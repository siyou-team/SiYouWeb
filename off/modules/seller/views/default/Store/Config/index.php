<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<script type="text/javascript" src="<?= $this->js('plugins/formwizard/jquery.bootstrap.wizard', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('plugins/jquery-validate/jquery.validate', true) ?>"></script>

<link rel="stylesheet" href="<?=$this->css('bootstrap-switch', true)?>">
<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="main-content">

        <div class="row">
            <div class="col-md-12">

                <div class="panel" id="process">
                    <div class="panel-heading">
                        <h3 class="panel-title">分销设置</h3>
                    </div>
                    <div class="panel-body">
                        <div id="manage-wrap">
                            <div class="manage-edit-box">
                                <div class="box-main">
                                    <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?mdu=seller&ctl=Store_Config&met=editDirectSeller&typ=json"  data-validator-option="{stopOnError:false, timely:false}">

                                        <input type="hidden" class="form-control" name="store_id" id="store_id" value="<?= @$data['store_id'] ?>"  placeholder="<?=__('店铺ID')?>" autocomplete="off" />
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_allow_seller_buy" title="购买权限开启状态下，销售员自己购买的订单将会算入业绩" data-toggle="tooltip"
                                            ><?=__('销售员购买权限')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_allow_seller_buy" name="sc_allow_seller_buy" type="checkbox" value="1" <?php if(@$data['sc_allow_seller_buy'] == 1){?> checked="checked"  <?php }?> data-on-text="开启" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_auto_settle" title="结算方式" data-toggle="tooltip"><?=__('结算方式')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_auto_settle" name="sc_auto_settle" type="checkbox" value="1" <?php if(@$data['sc_auto_settle'] == 1){?> checked="checked"  <?php }?> data-on-text="自动结算" data-off-text="手动结算">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_cps_rate"  title="一级佣金比例" data-toggle="tooltip"><?=__('一级佣金比例')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_cps_rate" id="sc_cps_rate" value="<?= @$data['sc_cps_rate'] ?>"  placeholder="<?=__('一级佣金比例')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_second_is_enable"  title="二级销售" data-toggle="tooltip"><?=__('二级销售')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_second_is_enable" name="sc_second_is_enable" type="checkbox" value="1" <?php if(@$data['sc_second_is_enable'] == 1){?> checked="checked"  <?php }?> data-on-text="开启" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_second_cps_rate"  title="二级佣金比例" data-toggle="tooltip"><?=__('二级佣金比例')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_second_cps_rate" id="sc_second_cps_rate" value="<?= @$data['sc_second_cps_rate'] ?>"  placeholder="<?=__('二级佣金比例')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_third_cps_rate"><?=__('三级分佣比例')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_third_cps_rate" id="sc_third_cps_rate" value="<?= @$data['sc_third_cps_rate'] ?>"  placeholder="<?=__('三级分佣比例')?>" autocomplete="off" />
                                            </div>
                                        </div>-->
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_directseller_customer_exptime"  title="销售员带来的客户（成为店铺的消费者开始计算时间）超过一定期限后，则不再享受分佣。 消费者在店铺消费第一单时间后，在某个期限内消费才可以产生佣金" data-toggle="tooltip"><?=__('客户关系期限')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_directseller_customer_exptime" id="sc_directseller_customer_exptime" value="<?= @$data['sc_directseller_customer_exptime'] ?>"  placeholder="<?=__('客户关系 期限， 销售员带来的客户（成为店铺的消费者开始计算时间）超过一定期限后，则不再享受分佣。 消费者在店铺消费第一单时间后，在某个期限内消费才可以产生佣金。 ')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_directseller_exptime_type"  title="永久：建立客户关系,客户以后在店铺的购买都分佣；短期：只根据链接购买获取佣金， 且一定期限后，链接失效。 不需要建立客户关系" data-toggle="tooltip"><?=__('客户有效期')?></label>
                                            <div class="col-sm-10 radio-inline">
                                                <label title="永久，建立客户关系,客户以后在店铺的购买都分佣" for="sc_directseller_exptime_type_1"><input class="cbr cbr-success form-control" id="sc_directseller_exptime_type_1" name="sc_directseller_exptime_type" value="1" type="radio" checked >永久 </label><label title="短期，只根据链接购买获取佣金， 且一定期限后，链接失效。 不需要建立客户关系" for="sc_directseller_exptime_type_2"><input class="cbr cbr-success form-control" id="sc_directseller_exptime_type_2" name="sc_directseller_exptime_type" value="2" type="radio"  >短期</label>
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_directseller_rel_exptime"  title="带来的客户关系在一定期限内不给抢走， 其它销售可以通过购买链接生效，但是在保护期内部更改关系" data-toggle="tooltip"><?=__('客户关系保护期')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_directseller_rel_exptime" id="sc_directseller_rel_exptime" value="<?= @$data['sc_directseller_rel_exptime'] ?>"  placeholder="<?=__('客户关系保护期')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_verify"  title="销售员审核" data-toggle="tooltip"><?=__('销售员审核')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_verify" name="sc_is_verify" type="checkbox" value="1" <?php if(@$data['sc_is_verify'] == 1){?> checked="checked"  <?php }?> data-on-text="需要审核" data-off-text="不需要审核">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_settle_time_type"  title="结算时间" data-toggle="tooltip"><?=__('结算时间')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_settle_time_type" id="sc_settle_time_type" value="<?= @$data['sc_settle_time_type'] ?>"  placeholder="<?=__('结算时间')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_expenditure"  title="分销申请消费额" data-toggle="tooltip"><?=__('分销申请消费额')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_expenditure" id="sc_expenditure" value="<?= @$data['sc_expenditure'] ?>"  placeholder="<?=__('分销申请消费额')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_enabled_share"  title="启用客户商品分享" data-toggle="tooltip"><?=__('启用客户商品分享')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_enabled_share" name="sc_is_enabled_share" type="checkbox" value="1" <?php if(@$data['sc_is_enabled_share'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="禁用">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <a type="submit" class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone" id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                       

                    </div>
                </div>

                <div class="panel" id="process">
                    <div class="panel-heading">
                        <h3 class="panel-title">商品设置</h3>
                    </div>
                    <div class="panel-body">
                        <div id="manage-wrap">
                            <div class="manage-edit-box">
                                <div class="box-main">
                                    <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?mdu=seller&ctl=Store_Config&met=edit&typ=json"  data-validator-option="{stopOnError:false, timely:false}">

                                        <input type="hidden" class="form-control" name="store_id" id="store_id" value="<?= @$data['store_id'] ?>"  placeholder="<?=__('店铺ID')?>" autocomplete="off" />

                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_use_min_quantity"  title="启用商品起订量" data-toggle="tooltip"><?=__('启用商品起订量')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_min_quantity" name="sc_is_use_min_quantity" type="checkbox" value="1"  <?php if(@$data['sc_is_use_min_quantity'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>

                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_use_max_quantity"  title="启用商品限购量" data-toggle="tooltip"><?=__('启用商品限购量')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_max_quantity" name="sc_is_use_max_quantity" type="checkbox" value="1" <?php if(@$data['sc_is_use_max_quantity'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_use_product_brand"  title="启用商品品牌" data-toggle="tooltip"><?=__('启用商品品牌')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_product_brand" name="sc_is_use_product_brand" type="checkbox" value="1" <?php if(@$data['sc_is_use_product_brand'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_use_product_weight"  title="启用商品重量字段" data-toggle="tooltip"><?=__('启用商品重量字段')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_product_weight" name="sc_is_use_product_weight" type="checkbox" value="1"  <?php if(@$data['sc_is_use_product_weight'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_use_product_defined"  title="启用商品自定义字段" data-toggle="tooltip"> <?=__('启用商品自定义字段')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_product_defined" name="sc_is_use_product_defined" type="checkbox" value="1"  <?php if(@$data['sc_is_use_product_defined'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_product_tags"  title="商品标签管理" data-toggle="tooltip"><?=__('商品标签管理')?></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_product_tags[0]" id="sc_product_tags[0]" value="<?= @$data['sc_product_tags'][0] ?>"  placeholder="<?=__('商品标签管理(JSON)')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_product_tags[1]" id="sc_product_tags[1]" value="<?= @$data['sc_product_tags'][1] ?>"  placeholder="<?=__('商品标签管理(JSON)')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_product_tags[2]" id="sc_product_tags[2]" value="<?= @$data['sc_product_tags'][2] ?>"  placeholder="<?=__('商品标签管理(JSON)')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_product_tags[3]" id="sc_product_tags[3]" value="<?= @$data['sc_product_tags'][3] ?>"  placeholder="<?=__('商品标签管理(JSON)')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_product_tags[4]" id="sc_product_tags[4]" value="<?= @$data['sc_product_tags'][4] ?>"  placeholder="<?=__('商品标签管理(JSON)')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_necessary_delivery_date"  title="" data-toggle="tooltip"><?=__('交货日期必填')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_is_necessary_delivery_date" id="sc_is_necessary_delivery_date" value="<?= @$data['sc_is_necessary_delivery_date'] ?>"  placeholder="<?=__('交货日期必填')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group" >
                                            <label class="col-sm-2 control-label" for="sc_is_use_order_min_money"  title="启用最低下单金额限制" data-toggle="tooltip"><?=__('启用最低下单金额限制')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_use_order_min_money" name="sc_is_use_order_min_money"  type="checkbox" value="1" <?php if(@$data['sc_is_use_order_min_money'] == 1){?> checked="checked"  <?php }?>   data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group" id="order_min_money" style="display:<?=@$data['sc_is_use_order_min_money'] == 1?'block':'none'?>">
                                            <label class="col-sm-2 control-label" for="sc_order_min_money"  title="" data-toggle="tooltip"><?=__('最低下单金额')?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sc_order_min_money" id="sc_order_min_money" value="<?= @$data['sc_order_min_money'] ?>"  placeholder="<?=__('最低下单金额')?>" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_deduct_inventory_mode"  title="按总仓库订购商品,不限制仓库定向供货指定的客户。按客户对应仓库订购商品,不限制仓库定向供货指定的客户" data-toggle="tooltip"><?=__('订货仓库限制')?></label>
                                            <div class="col-sm-10 radio-inline">
                                                <label title="按总仓库订购商品,不限制仓库定向供货指定的客户" for="sc_deduct_inventory_mode_1">
                                                    <input class="cbr cbr-success form-control" id="sc_deduct_inventory_mode_1" name="sc_deduct_inventory_mode" value="1" type="radio" <?=@$data['sc_deduct_inventory_mode'] ==1?'checked':''?> ><?=__('按总仓库订购商品')?>
                                                </label>
                                                <label title="按客户对应仓库订购商品,不限制仓库定向供货指定的客户" for="sc_deduct_inventory_mode_2">
                                                    <input class="cbr cbr-success form-control" id="sc_deduct_inventory_mode_2" name="sc_deduct_inventory_mode" value="2" type="radio" <?=@$data['sc_deduct_inventory_mode'] ==2?'checked':''?> ><?=__('按客户对应仓库订购商品')?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_inventory_agent_show_type"  title="不显示库存：客户订货无库存功能；显示存库：有无客户而在商品下单时显示商品库存有无，但不显示具体数量，未填库存信息显示无库存信息；显示存库数量：客户订货系统可在商品、下单时显示商品库存数量，未填写库存信息显示无库存信息" data-toggle="tooltip"><?=__('客户订货系统')?></label>
                                            <div class="col-sm-10 radio-inline">
                                                <label title="不显示库存,客户订货无库存功能" for="sc_inventory_agent_show_type_0" data-toggle="tooltip">
                                                    <input class="cbr cbr-success form-control" id="sc_inventory_agent_show_type_0" name="sc_inventory_agent_show_type" value="0" type="radio" <?=@$data['sc_inventory_agent_show_type'] ==0?'checked':''?> ><?=__('不显示库存')?>
                                                </label>
                                                <label title="显示存库有无客户而在商品下单时显示商品库存有无，但不显示具体数量，未填库存信息显示无库存信息" for="sc_inventory_agent_show_type_1" data-toggle="tooltip">
                                                    <input class="cbr cbr-success form-control" id="sc_inventory_agent_show_type_1" name="sc_inventory_agent_show_type" value="1" type="radio" <?=@$data['sc_inventory_agent_show_type'] ==1?'checked':''?> ><?=__('显示存库')?>
                                                </label>
                                                <label title="显示存库数量客户订货系统可在商品、下单时显示商品库存数量，未填写库存信息显示无库存信息" for="sc_inventory_agent_show_type_2" data-toggle="tooltip">
                                                    <input class="cbr cbr-success form-control" id="sc_inventory_agent_show_type_2" name="sc_inventory_agent_show_type" value="2" type="radio" <?=@$data['sc_inventory_agent_show_type'] ==2?'checked':''?> ><?=__('显示存库数量')?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_enabled_inventory_check"  title="支付扣减锁定：数量小于等于零，禁止订货" data-toggle="tooltip"><?=__('商品库存扣减预购值锁定')?></label>
                                            <div class="col-sm-10 radio-inline">
                                                <label title="下单扣减锁定" for="sc_is_enabled_inventory_check_1">
                                                    <input class="cbr cbr-success form-control" id="sc_is_enabled_inventory_check_1" name="sc_is_enabled_inventory_check" value="1" type="radio" <?=@$data['sc_is_enabled_inventory_check'] ==1?'checked':''?> ><?=__('下单扣减锁定')?>
                                                </label>
                                                <label title="支付扣减锁定,数量小于等于零，禁止订货" for="sc_is_enabled_inventory_check_2">
                                                    <input class="cbr cbr-success form-control" id="sc_is_enabled_inventory_check_2" name="sc_is_enabled_inventory_check" value="2" type="radio" <?=@$data['sc_is_enabled_inventory_check'] ==2?'checked':''?> ><?=__('支付扣减锁定')?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_fund_account_settings"  title="客户资金账户" data-toggle="tooltip"><?=__('客户资金账户')?></label>
                                            <div class="col-sm-1 switch">
                                                <input id="sc_fund_account_settings[0][enableStatus]" name="sc_fund_account_settings[0][enableStatus]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][0]['enableStatus'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('启用')?>" data-off-text="<?=__('禁用')?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[0][code]" id="sc_fund_account_settings[0][code]" value="<?= @$data['sc_fund_account_settings'][0]['code'] ?>"  placeholder="<?=__('预付款')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[0][name]" id="sc_fund_account_settings[0][name]" value="<?= @$data['sc_fund_account_settings'][0]['name'] ?>"  placeholder="<?=__('预付款')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2 switch">
                                                <input id="sc_fund_account_settings[0][can_pay]" name="sc_fund_account_settings[0][can_pay]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][0]['can_pay'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('余额付款无需确认')?>" data-off-text="<?=__('余额付款需确认')?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_fund_account_settings"  title="" data-toggle="tooltip"></label>
                                            <div class="col-sm-1 switch">
                                                <input id="sc_fund_account_settings[1][enableStatus]" name="sc_fund_account_settings[1][enableStatus]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][1]['enableStatus'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('启用')?>" data-off-text="<?=__('禁用')?>">
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[1][code]" id="sc_fund_account_settings[1][code]" value="<?= @$data['sc_fund_account_settings'][1]['code'] ?>"  placeholder="<?=__('充值卡')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[1][name]" id="sc_fund_account_settings[1][name]" value="<?= @$data['sc_fund_account_settings'][1]['name'] ?>"  placeholder="<?=__('充值卡')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2 switch">
                                                <input id="sc_fund_account_settings[1][can_pay]" name="sc_fund_account_settings[1][can_pay]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][1]['can_pay'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('余额付款无需确认')?>" data-off-text="<?=__('余额付款需确认')?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_fund_account_settings"  title="" data-toggle="tooltip"></label>
                                            <div class="col-sm-1 switch">
                                                <input id="sc_fund_account_settings[2][enableStatus]" name="sc_fund_account_settings[2][enableStatus]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][2]['enableStatus'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('启用')?>" data-off-text="<?=__('禁用')?>">
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[2][code]" id="sc_fund_account_settings[2][code]" value="<?= @$data['sc_fund_account_settings'][2]['code'] ?>"  placeholder="<?=__('保证金')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="sc_fund_account_settings[2][name]" id="sc_fund_account_settings[2][name]" value="<?= @$data['sc_fund_account_settings'][2]['name'] ?>"  placeholder="<?=__('保证金')?>" autocomplete="off" />
                                            </div>
                                            <div class="col-sm-2 switch">
                                                <input id="sc_fund_account_settings[2][can_pay]" name="sc_fund_account_settings[2][can_pay]" type="checkbox" value="1" <?php if(@$data['sc_fund_account_settings'][2]['can_pay'] == 1){?> checked="checked"  <?php }?> data-on-text="<?=__('余额付款无需确认')?>" data-off-text="<?=__('余额付款需确认')?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="sc_is_enabled_invoicing"  title="" data-toggle="tooltip"><?=__('启用进销存管理')?></label>
                                            <div class="col-sm-10 switch">
                                                <input id="sc_is_enabled_invoicing" name="sc_is_enabled_invoicing" type="checkbox" value="1" <?php if(@$data['sc_is_enabled_invoicing'] == 1){?> checked="checked"  <?php }?> data-on-text="启用" data-off-text="关闭">
                                            </div>
                                        </div>
                                        <div class="form-group-separator"></div>
                                        <div class="form-group">
                                            <a type="submit" class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone" id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="<?=$this->js('bootstrap-switch', true)?>"></script>
    <script>

    </script>