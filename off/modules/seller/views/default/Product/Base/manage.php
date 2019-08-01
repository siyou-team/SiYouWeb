<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>
<link rel="stylesheet" href="<?=$this->css('index')?>">
<link rel="stylesheet" href="<?=$this->css('bootstrap-treeview', true)?>">

<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>"
        charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>"
        charset="utf-8"></script>

<script type="text/javascript" src="<?= $this->js('plugins/formwizard/jquery.bootstrap.wizard', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('plugins/jquery-validate/jquery.validate', true) ?>"></script>
<?php

$data= conversion_type($data);

$product = array();
$spec_row_checked = array();
$spec_item_row_checked = array();

if (isset($data['product_id']) && isset($data['product'][$data['product_id']]))
{
    $product = $data['product'][$data['product_id']];
}

$category_id = i('category_id', $data['category_id']);

//选中的规格
$spec_row_checked = $data['spec_row_checked'];

//选中的规格值
$spec_item_row_checked = $data['spec_item_row_checked'];
$spec_item_uniqid_row = $data['spec_item_uniqid_row'];;

$store_id = $data['store_id'];
$store_base = Store_BaseModel::getInstance()->getOne( $store_id );

/*
//构造item-spec-item-uniqid
$spec_item_uniqid_row = array();

foreach (@$product['items'] as $item_row)
{

    $item_spec_id_row = array_column(array_column($item_row['item_spec'], 'item'), 'id');
    sort($item_spec_id_row);

    $spec_item_uniqid = implode('-', $item_spec_id_row);

    $spec_item_uniqid_row[$spec_item_uniqid] = $item_row;
}
*/
?>
<div class="page-container">
    <div class="main-content">  
        <div class="box-content-container box-main"><!--
            <a  data-toggle="tab-max" class=" pull-right hidden">缩放</a>
            <a  data-toggle="tab-close" class=" pull-right">关闭</a>-->
            <form method="post" enctype="multipart/form-data" id="product-form" id="manage-form" name="product-form"
                  class="form-horizontal" action="<?=$this->registry('url')?>?mdu=seller&ctl=Product_Base&met=save&typ=json"  data-validator-option="{stopOnError:false, timely:false}">
                <input type="hidden" class="form-control" name="product_id" id="product_id"
                       value="<?= @$product['product_id'] ?>" placeholder="产品SPU" autocomplete="off"/>
                <fieldset>
                    <legend>基本信息</legend>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="category_id" data-toggle="tooltip"
                               title="添加商品后，不可以修改" >商品分类 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <span id="category_id"></span>
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <div class="form-group-separator111"></div>

                    <!--
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="store_product_cat_id">店铺商品分类 - 忽略独立管理！</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="store_product_cat_id" name="store_product_cat_id" style="width:100%;">
                                <option value="<?= @$product['store_product_cat_id'] ?>">Alabama</option>
                                <option value="al">Alaska</option>
                                <option value="al">Arizona</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-separator111"></div>
                    -->

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="kind_id">商品类型</label>
                        <div class="col-sm-10">
                            <label title="实体商品" for="kind_id_1201"><input class="cbr cbr-primary form-control" id="kind_id_1201" name="kind_id" value="1201" type="radio"  >实体商品</label> &nbsp;&nbsp;<label title="虚拟商品（服务类商品）" for="kind_id_1202"><input class="cbr cbr-primary form-control" id="kind_id_1202" name="kind_id" value="1202" type="radio"  <?=($data['category_row']['category_virtual_enable'] ? '' : 'disabled')?>>虚拟商品（服务类商品）</label>
                        </div>
                    </div>
                </fieldset>
                <?php if (@$data['assist'] || @$data['brand']) { ?>
                <fieldset>
                    <legend>辅助属性</legend>
                    <?php if (@$data['brand']) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">品牌</label>
                        <div class="col-sm-10 radio-inline" id="input-option-brand">
                            <?php foreach ($data['brand'] as $option_row) { ?>
                                <label>
                                    <input class="cbr cbr-success form-control"  type="radio" name="brand_id" value="<?php echo $option_row['brand_id']; ?>"  <?=(@$option_row['selected'] ? 'checked' : '') ?> />
                                    <?php echo $option_row['brand_name']; ?>
                                </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php Zero_Utils_Html::generateOption($data['assist'])?>
                </fieldset>
                <?php } ?>


                <fieldset>
                    <legend>商品规格</legend>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="" data-toggle="tooltip"
                               title="商品规格选定后，不允许增减，只允许增减规格值。<br>  如果要变动规格则可以新增产品。<br> 商品图片尺寸宽高为：800*800">规格属性 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <?php
                                $spec_id_selected_row = array_column((array)@$product['product_spec'], 'id');
                                ?>
                                <?php foreach ((array)@$data['spec'] as $spec_row):?>
                                    <div class="col-sm-12 vertical-middle-sm">
                                        <span id="spec_<?=$spec_row['spec_id']?>" data-spec-name="<?=$spec_row['spec_name']?>"><?=$spec_row['spec_name']?></span> :
                                        <?php foreach ($spec_row['item'] as $spec_item_row):?>
                                            <input type="checkbox" class="cbr cbr-primary spec_item" id="spec_item_<?=$spec_item_row['spec_item_id']?>"  name="spec_item_id[]" value="<?=$spec_item_row['spec_item_id']?>" data-spec-id="<?=$spec_row['spec_id']?>"  data-spec-name="<?=$spec_row['spec_name']?>"  data-spec-item-name="<?=$spec_item_row['spec_item_name']?>" <?=(in_array($spec_item_row['spec_item_id'], $spec_item_row_checked) ? 'checked disabled="disabled"' : '') ?>  <?=($product && !in_array($spec_row['spec_id'], $spec_id_selected_row) ? ' disabled="disabled" ' : '')?> ><label for="spec_item_<?=$spec_item_row['spec_item_id']?>"><?=$spec_item_row['spec_item_name']?></label>&nbsp;&nbsp;
                                        <?php endforeach;?>&nbsp;

                                        <?php if (($product && in_array($spec_row['spec_id'], $spec_id_selected_row)) || !$spec_id_selected_row): ?>
                                            <a class="new-spec-item  text-success" data-spec_id="<?=$spec_row['spec_id']?>" href="#"><i class="fa fa-plus" data-spec_id="<?=$spec_row['spec_id']?>"></i></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach;?>
                                <div class="col-sm-12 manage-wrap">
                                    <div class="wrapper">
                                        <div class="grid-wrap">
                                            <table id="gridSku"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <legend>商品信息</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_name" data-toggle="tooltip"
                               title="商品名称">产品名称 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                   value="<?= @$product['product_name'] ?>" placeholder="产品名称， 必填"
                                   autocomplete="off" data-rule="产品名称:required" required />
                        </div>
                    </div>

                    <div class="form-group 1201">
                        <label class="col-sm-2 control-label" for="unit_id" data-toggle="tooltip"
                               title="计量单位">计量单位 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <span id="unit_id"></span>
                            <input type="hidden" class="form-control" name="aaa" required />
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_weight" data-toggle="tooltip"
                               title="商品重量,多规格统一重量">商品重量 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <input type="input" class="form-control" value="<?= @$product['product_weight'] ?>" name="product_weight" placeholder="请输入数字，单位默认为KG" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_cubage" data-toggle="tooltip" title="商品重量,多规格统一重量">商品体积 <i class="fa-question"></i></label>
                        <input type="hidden" name="product_cubage" id="product_cubage" placeholder="体积" value="<?= @implode(",",$product['product_cubage']) ?>"/>
                        <div class="form-section col-sm-1 mgl15 w140">
                            <label class="input-label" for="product_length">长度，单位为CM</label>    
                            <input type="input" class="input-text form-control" id="product_length" placeholder="长度，单位为CM" autocomplete="off" value="<?= @$product['product_cubage'][0] ?>"/>
                        </div>
                        <span class="mul">x</span>
                        <div class="form-section col-sm-1 w140">
                            <label class="input-label" for="product_width">宽度，单位为CM</label>
                            <input type="input" class="input-text form-control" id="product_width" placeholder="宽度，单位为CM" autocomplete="off" value="<?= @$product['product_cubage'][1] ?>"/>
                        </div>
                        <span class="mul">x</span>
                        <div class="form-section col-sm-1 w140">
                            <label class="input-label" for="product_height">高度，单位为CM</label>
                            <input type="input" class="input-text form-control" id="product_height" placeholder="高度，单位为CM" autocomplete="off" value="<?= @$product['product_cubage'][2] ?>"/>
                        </div>
                    </div>

                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_tags"data-toggle="tooltip"
                               title="商品标签。">商品标签 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <select class="form-control select2" multiple="multiple" id="product_tags" name="product_tags[]" style="width:100%;"    data-placeholder="商品标签">
                                <option value="<?=StateCode::PRODUCT_TAG_NEW ?>" <?=(in_array(StateCode::PRODUCT_TAG_NEW, (array)@$product['product_tags']) ? 'selected' : '')?>>新品上架</option>
                                <option value="<?=StateCode::PRODUCT_TAG_REC ?>" <?=(in_array(StateCode::PRODUCT_TAG_REC, (array)@$product['product_tags']) ? 'selected' : '')?>>热卖推荐</option>
                                <option value="<?=StateCode::PRODUCT_TAG_BARGAIN ?>" <?=(in_array(StateCode::PRODUCT_TAG_BARGAIN, (array)@$product['product_tags']) ? 'selected' : '')?>>清仓优惠</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_tips"data-toggle="tooltip"
                               title="商品卖点。">商品卖点 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_tips" id="product_tips"
                                   value="<?= @$product['product_tips'] ?>" placeholder="商品广告词" autocomplete="off"/>
                        </div>
                    </div>

                    <!--
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_unit_price">商品单价</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_unit_price" id="product_unit_price"
                                   value="<?= @$product['product_unit_price'] ?>" placeholder="商品单价" autocomplete="off"/>
                        </div>
                    </div>
                    -->
                    

                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_image">商品主图</label>
                        <div class="inline">
                            <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_replace_id" data-target="product_image">
                                <input type="hidden" class="form-control" name="product_image" id="product_image"
                                       value="<?= @$product['product_image'] ?>" placeholder="商品单价" autocomplete="off"/>
                                <img src="<?= @$product['product_image'] ?>"  data-placeholder="" width="100" height="100" data-toggle="tooltip" /></a>
                        </div>
                        <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                    </div>


                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_video" data-toggle="tooltip" title="可以添加一个视频播放地址，将会在商品主图上展示出来">视频地址 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_video" id="product_video"
                                                   value="<?= @$product['product_video'] ?>" placeholder="视频地址"
                                                   autocomplete="off"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="store_category_ids" data-toggle="tooltip"
                               title="此分类仅为店铺内分类使用" >本店商品分类 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <span id="store_category_ids"></span>
                            <input type="hidden"  name="store_category_ids" />
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <?php if( $store_base && $store_base['shop_type'] == StateCode::STORE_TYPE_SUPPLIER ): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_is_behalf_delivery" data-toggle="tooltip" title="支持代发货" >支持代发货 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <label title="是" for="product_is_behalf_delivery_1001">
                                <input class="cbr cbr-primary form-control cbr-success" id="product_is_behalf_delivery_1001" name="product_is_behalf_delivery" value="1001" type="radio">是
                            </label> &nbsp;&nbsp;
                            <label title="否" for="product_is_behalf_delivery_1002">
                                <input class="cbr cbr-primary form-control cbr-success" id="product_is_behalf_delivery_1002" name="product_is_behalf_delivery" value="1002" type="radio">否
                            </label>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!--<div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_image">商品主图</label>
                        <div class="col-sm-10">
                            <div class="pics">
                                <ul class="clearfix" id="ul_pics">
                                    <li class="item"> <a class="picture_add picture_upload_dialog">+加图</a> </li>
                                    <li class="item J_choosePic"> <a class="picture_select picture_select_dialog">从图片空间选择</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->

                </fieldset>

                <fieldset class="1202">
                    <legend>预约服务属性</legend>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_valid_period"  data-toggle="tooltip"
                               title="虚拟商品可兑换的有效期，过期后商品不能购买，电子兑换码不能使用。">有效期 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label title="长期有效" for="product_valid_period_1001"><input class="cbr cbr-success form-control" id="product_valid_period_1001" name="product_valid_period" value="1001" type="radio" <?=(1002==@$product['product_valid_period']? '' : 'checked')?> >长期有效</label>
                                </div>
                                <div class="col-sm-12">
                                    <label title="自定义有效期" for="product_valid_period_1002"><input class="cbr cbr-success form-control" id="product_valid_period_1002" name="product_valid_period" value="1002" type="radio" <?=(1002==@$product['product_valid_period']? 'checked' : '')?> >自定义有效期</label>
                                    
                                    <input type="text" class="form-control datepicker" name="product_validity_end" id="product_validity_end" value="<?= @$product['product_validity_end'] ?>" placeholder="商品有效期至"  autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group-separator11"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_valid_type"><?=__('服务类型')?></label>
                        <div class="col-sm-10 radio-inline">
                            <label title="到店服务" for="product_valid_type_1001"><input class="cbr cbr-success form-control" id="product_valid_type_1001" name="product_valid_type" value="1001" type="radio" checked >到店服务</label><label title="上门服务" for="product_valid_type_1002"><input class="cbr cbr-success form-control" id="product_valid_type_1002" name="product_valid_type" value="1002" type="radio"  >上门服务</label>
                        </div>
                    </div>
                    <div class="form-group-separator11"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_service_date_flag"><?=__('填写预约日期')?></label>
                        <div class="col-sm-10 radio-inline">
                            <label title="否" for="product_service_date_flag_0"><input class="cbr cbr-success form-control" id="product_service_date_flag_0" name="product_service_date_flag" value="0" type="radio" checked >否</label><label title="是" for="product_service_date_flag_1"><input class="cbr cbr-success form-control" id="product_service_date_flag_1" name="product_service_date_flag" value="1" type="radio"  >是</label>
                        </div>
                    </div>
                    <div class="form-group-separator11"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_service_contactor_flag"><?=__('填写联系人')?></label>
                        <div class="col-sm-10 radio-inline">
                            <label title="否" for="product_service_contactor_flag_0"><input class="cbr cbr-success form-control" id="product_service_contactor_flag_0" name="product_service_contactor_flag" value="0" type="radio" checked >否</label><label title="是" for="product_service_contactor_flag_1"><input class="cbr cbr-success form-control" id="product_service_contactor_flag_1" name="product_service_contactor_flag" value="1" type="radio"  >是</label>
                        </div>
                    </div>

                    <div class="form-group-separator11"></div>
                    <div class="form-group hide">
                        <label class="col-sm-2 control-label" for="product_valid_refund_flag"><?=__('支持过期退款')?></label>
                        <div class="col-sm-10 radio-inline">
                            <label title="否" for="product_valid_refund_flag_0"><input class="cbr cbr-success form-control" id="product_valid_refund_flag_0" name="product_valid_refund_flag" value="0" type="radio" checked >否</label><label title="是" for="product_valid_refund_flag_1"><input class="cbr cbr-success form-control" id="product_valid_refund_flag_1" name="product_valid_refund_flag" value="1" type="radio"  >是</label>
                        </div>
                    </div>
                    
                </fieldset>
                <fieldset>
                    <legend>物流/其它</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="transport_type_id">运费设置</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="transport_type_id" name="transport_type_id" style="width:100%;"    data-placeholder="运费设置">
                                <?php foreach ($data['transport_type'] as $transport_type_row):?>
                                <option value="<?= @$transport_type_row['transport_type_id'] ?>" <?=($transport_type_row['transport_type_id']==@$product['transport_type_id']? 'selected' : '')?>><?= @$transport_type_row['transport_type_name'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_buy_limit" data-toggle="tooltip"
                               title="购买上限， 0代表不做限制">购买上限 <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_buy_limit" id="product_buy_limit"
                                   value="<?= @$product['product_buy_limit'] ?>" placeholder="购买上限， 0代表不做限制" autocomplete="off"/>
                        </div>
                    </div>
                    
                    <div class="form-group-separator111"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_state_id">开售时间</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label title="立即开售" for="product_state_id_1001"><input class="cbr cbr-success form-control" id="product_state_id_1001" name="product_state_id" value="1001" type="radio" <?=(1001==@$product['product_state_id']? 'checked' : '')?> >立即开售</label>
                                </div>
                                <div class="col-sm-12">
                                    <label title="定时开售" for="product_state_id_1002"><input class="cbr cbr-success form-control" id="product_state_id_1002" name="product_state_id" value="1002" type="radio" <?=(1002==@$product['product_state_id']? 'checked' : '')?> >定时开售</label><input type="text" class="form-control datepicker" name="product_sale_time" id="product_sale_time" value="<?= @$product['product_sale_time'] ?>" placeholder="预设上架时间,可以动态修正状态"  autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <legend>详细介绍</legend>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_detail"  data-toggle="tooltip"
                               title="文字商品详情，如果编辑的较美观，需要有一定的前端专业能力。 建议使用商品图详情。采用图片宽度至少为800px;"><?=__('商品描述')?>  <i class="fa-question"></i></label>
                        <div class="col-sm-10">
                            <textarea class="ckeditor" name="product_detail" id="product_detail" rows="10"><?= @$product['product_detail'] ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_param"><?=__('规格参数')?></label>
                        <div class="col-sm-10">
                            <textarea class="ckeditor" name="product_param" id="product_param" rows="4"><?= @$product['product_param'] ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="product_param"><?=__('售后服务')?></label>
                        <div class="col-sm-10">
                            <textarea class="ckeditor" name="product_service" id="product_service" rows="4"><?= @$product['product_service'] ?></textarea>
                        </div>
                    </div>
                </fieldset>

                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <a type="submit"
                           class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                           id="submit-btn">
                            <i class="fa-pencil"></i>
                            <span>保存</span>
                        </a>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
        </div>

    </div>
</div>
<link rel="stylesheet" href="<?=$this->css('plugins/zTree/css/zTreeStyle/zTreeStyle', true)?>">
<script src="<?=$this->js('plugins/zTree/js/jquery.ztree.all-3.5', true)?>"></script>

<div class="modal fade" id="modal_upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button
                <h4 class="modal-title">上传图片</h4>
            </div>
            <div class="modal-body">

                <form class="form-inline">
                <div class="form-inline">
                    <!--<label class="control-label">网络图片：</label>
                    <input type="text" class="form-control" id="pic_url" style="margin:0 10px;width:400px" placeholder="请贴入网络图片地址" autocomplete="off" />
                    <button type="button" class="btn btn-primary" onclick="getPicUrl()">提取</button>-->
                    <button type="button" class="btn btn-primary item J_choosePic">从图片空间选择</button>
                </div>
                <div class="form-inline clearfix" style="margin:15px 0 0">
                    <label class="control-label" style="float:left">本地图片：</label>
                    <div id="photos_area" class="photos_area">
                        <a class="cover_btn picture_cover_btn picture_upload_add" id="cover_btn_big"><span>+</span></a>
                    </div>
                </div>
                <div class="controls preview-container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="upload_complete()">上传完成</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_select">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button
                <h4 class="modal-title">从图片空间选择</h4>
            </div>
            <div class="modal-body">

                <form class="form-inline select-pic-box col-sm-12">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary select-img single">选择</button>
            </div>
        </div>
    </div>
</div>
<div class="btn" id="SSS"></div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>

<script src="<?=$this->js('bootstrap-treeview', true)?>"></script>

<script type="text/javascript" src="<?=$this->js('ckeditor/ckeditor', true)?>"></script>
<script type="text/javascript" src="<?=$this->js('ckeditor/config', true)?>"></script>
<script>

    var shop_type = <?=($shop_base['store_type'])?$shop_base['store_type']:StateCode::STORE_TYPE_GENERAL?>;

    var unit_id = <?= intval(@$product['unit_id']) ?>;
    var product = <?=encode_json($product)?>;

    if (typeof product['spec_img'] == 'undefined')
    {
        product['spec_img'] = {};
    }

    var category_id = <?=$category_id?>;
    var sc_is_enabled_invoicing = <?=intval($data['sc_is_enabled_invoicing'])?>;

    var spec_item_uniqid_row = <?=encode_json($spec_item_uniqid_row)?>;


    //商品类别
    var opts = {
        url: SYS.CONFIG.index_url + '?ctl=Base_ProductCategory&met=tree&typ=json',
        width : 300,
        selectOnlyLeaf : false,
        //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
        inputWidth :  300,
        defaultSelectValue : '<?=intval(@$category_id)?>',
        //defaultSelectValue : rowData.categoryId || '',
        showRoot : true
    }

    var typeCategoryTree = Public.categoryTree($('#category_id'), opts, 'product_category');
    //
    typeCategoryTree.obj.change(function(){
        if (category_id != typeCategoryTree.getValue())
        {
            window.location.href = window.location.href.replace('category_id', "t") + '&category_id=' + typeCategoryTree.getValue();
        }
    });

    //服务类商品处理。
    $('input[name="kind_id"]').change(function (e) {
        var $selectedvalue = $('input[name="kind_id"]:checked').val();
        
        if ($selectedvalue == 1201)
        {
            //实物
            $('.1201').show();
            $('.1202').hide();
        }
        else
        {
            //服务类
            $('.1201').hide();
            $('.1202').show();
        }
    });


    $("input[name='kind_id'][value='" + <?=(isset($product['kind_id']) ? $product['kind_id'] : 1201)?> + "']").click();


    $("input[name='product_valid_type'][value='" + <?=(isset($product['product_valid_type']) ? $product['product_valid_type'] : 1001)?> + "']").click();
    $("input[name='product_service_date_flag'][value='" + <?=(isset($product['product_service_date_flag']) ? $product['product_service_date_flag'] : 0)?> + "']").click();
    $("input[name='product_service_contactor_flag'][value='" + <?=(isset($product['product_service_contactor_flag']) ? $product['product_service_contactor_flag'] : 0)?> + "']").click();
    
    <?=(1002==@$product['product_state_id']? "$('#product_sale_time').show();" : "$('#product_sale_time').hide();")?>
    <?=(1002==@$product['product_valid_period']? "$('#product_validity_end').show();" : "$('#product_validity_end').hide();")?>


    $('input[name="product_valid_period"]').change(function (e) {
        var $selectedvalue = $('input[name="product_valid_period"]:checked').val();

        if ($selectedvalue == 1001)
        {
            $('#product_validity_end').hide();
        }
        else
        {
            $('#product_validity_end').show();
        }
    });

    <?php if (@$product['product_id']):?>
    //typeCategoryTree.selectByValue(<?=intval(@$category_id)?>);
    typeCategoryTree.setDisabled();
    $('input[name="kind_id"]').prop('disabled', true);

    $('input[name="product_valid_type"]').prop('disabled', true);
    $('input[name="product_valid_refund_flag"]').prop('disabled', true);
    <?php endif; ?>
    typeCategoryTree.setDisabled();
    
    specInfo = <?=encode_json(array_values((array)$data['spec']))?>;

    $('a[type=submit]').click(function(){
        //需要手动更新CKEDITOR字段
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
        return true;
    });

    $('.new-spec-item').click(function ()
    {
        var $obj = $(this);
        var spec_id = $(this).data('spec_id');

        $.dialog({
            title: __('添加规格值'),
            content: 'url:' + SYS.CONFIG.index_url + '?mdu=seller&ctl=Product_Base&met=specItemManage&typ=e',
            data: {oper: 'add', rowData:{spec_id: spec_id}, callback:function (data, oper, $handle, dialogWin)
            {
                if (oper == "edit")
                {
                    this.$grid.jqGrid('setRowData', key, data);
                    $handle && $handle.$api.close();
                }
                else
                {
                    $handle && $handle.resetForm(data);
                }

                //初始化数据
                $(specInfo).each(function(i, spec_row)
                {
                    if (spec_row['spec_id'] == data.spec_id)
                    {
                        specInfo[i].item[data.spec_item_id] = data;
                        return;
                    }
                });

                //
                var spec_item_str = sprintf('<input type="checkbox" class="cbr cbr-primary spec_item" id="spec_item_%d"  name="spec_item_id[]" value="%d" data-spec-id="%d"  data-spec-name="%s"  data-spec-item-name="%s"  ><label for="spec_item_%d">%s</label>&nbsp;&nbsp;', data.spec_item_id,  data.spec_item_id,  data.spec_id, 'z',  data.spec_item_name,  data.spec_item_id,  data.spec_item_name);

                $obj.before(spec_item_str);

                $('input[type="checkbox"].spec_item').change(initSkuData);
                initSkuData();

            }},
            width: 400,
            height: 200,
            max: true,
            min: false,
            cache: false,
            lock: true
        });
    })


    var opts = {
        url: SYS.CONFIG.index_url + '?mdu=seller&ctl=Store_ProductCategory&met=tree&typ=json',
        width : 300,
        selectOnlyLeaf : false,
        //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
        inputWidth :  300,
        defaultSelectValue : '<?=intval(@$product['store_category_ids'])?>',
        //defaultSelectValue : rowData.categoryId || '',
        rootTxt : '选择店铺分类',
        showRoot : true
    }

    //var storeCategoryTree = Public.storeCategoryTree($('#store_category_ids'), opts, 'store_category');
    function buildDomTree() {

        var data = [];

        function walk(nodes, data) {
            if (!nodes) { return; }
            $.each(nodes, function (id, node) {
                var obj = {
                    id: id,
                    text: node.nodeName + " - " + (node.innerText ? node.innerText : ''),
                    tags: [node.childElementCount > 0 ? node.childElementCount + ' child elements' : '']
                };
                if (node.childElementCount > 0) {
                    obj.nodes = [];
                    walk(node.children, obj.nodes);
                }
                data.push(obj);
            });
        }

        walk($('html')[0].children, data);
        return data;
    }

    $(function() {

        /*
        var defaultData = [
            {
                text: 'Parent 1',
                href: '#parent1',
                tags: ['4'],
                nodes: [
                    {
                        text: 'Child 1',
                        href: '#child1',
                        tags: ['2'],
                        nodes: [
                            {
                                text: 'Grandchild 1',
                                href: '#grandchild1',
                                tags: ['0']
                            },
                            {
                                text: 'Grandchild 2',
                                href: '#grandchild2',
                                tags: ['0']
                            }
                        ]
                    },
                    {
                        text: 'Child 2',
                        href: '#child2',
                        tags: ['0']
                    }
                ]
            },
            {
                text: 'Parent 2',
            },
            {
                text: 'Parent 3',
                href: '#parent3',
                tags: ['0']
            },
            {
                text: 'Parent 4',
                href: '#parent4',
                tags: ['0']
            },
            {
                text: 'Parent 5',
                href: '#parent5'  ,
                tags: ['0']
            }
        ];


        var options = {
            bootstrap2: false,
            showTags: true,
            levels: 5,
            data: defaultData,
            highlightSelected : true,// 选中项不高亮，避免和上述制定的颜色变化规则冲突
            multiSelect : true,// 不允许多选，因为我们要通过check框来控制

            onNodeSelected : function(event, node) {
                // 省级节点被选中，那么市级节点都要选中
                if (node.nodes != null) {

                    alert('只允许选择最后一级分类');
                    //$this.treeview('checkNode', node.nodeId, {
                    $('#store_category_ids').treeview('unselectNode', node.nodeId, {
                        silent : false
                    });
                } else {
                    //加入input value
                }
            },
            onNodeUnchecked : function(event, node) {
            }

            onNodeChecked : function(event, node) {
                YUNM.debug("选中项目为：" + node);

                // 省级节点被选中，那么市级节点都要选中
                if (node.nodes != null) {
                    $.each(node.nodes, function(index, value) {
                        $this.treeview('checkNode', value.nodeId, {
                            silent : true
                        });
                    });
                } else {
                    // 市级节点选中的时候，要根据情况判断父节点是否要全部选中

                    // 父节点
                    var parentNode = $this.treeview('getParent', node.nodeId);

                    var isAllchecked = true; // 是否全部选中

                    // 当前市级节点的所有兄弟节点，也就是获取省下面的所有市
                    var siblings = $this.treeview('getSiblings', node.nodeId);
                    for ( var i in siblings) {
                        // 有一个没选中，则不是全选
                        if (!siblings[i].state.checked) {
                            isAllchecked = false;
                            break;
                        }
                    }

                    // 全选，则打钩
                    if (isAllchecked) {
                        $this.treeview('checkNode', parentNode.nodeId, {
                            silent : true
                        });
                    } else {// 非全选，则变红
                        $this.treeview('selectNode', parentNode.nodeId, {
                            silent : true
                        });
                    }
                }
            },
            onNodeUnchecked : function(event, node) {
                YUNM.debug("取消选中项目为：" + node);

                // 选中的是省级节点
                if (node.nodes != null) {
                    // 这里需要控制，判断是否是因为市级节点引起的父节点被取消选中
                    // 如果是，则只管取消父节点就行了
                    // 如果不是，则子节点需要被取消选中
                    if (silentByChild) {
                        $.each(node.nodes, function(index, value) {
                            $this.treeview('uncheckNode', value.nodeId, {
                                silent : true
                            });
                        });
                    }
                } else {
                    // 市级节点被取消选中

                    var parentNode = $this.treeview('getParent', node.nodeId);

                    var isAllUnchecked = true; // 是否全部取消选中

                    // 市级节点有一个选中，那么就不是全部取消选中
                    var siblings = $this.treeview('getSiblings', node.nodeId);
                    for ( var i in siblings) {
                        if (siblings[i].state.checked) {
                            isAllUnchecked = false;
                            break;
                        }
                    }

                    // 全部取消选中，那么省级节点恢复到默认状态
                    if (isAllUnchecked) {
                        $this.treeview('unselectNode', parentNode.nodeId, {
                            silent : true,
                        });
                        $this.treeview('uncheckNode', parentNode.nodeId, {
                            silent : true,
                        });
                    } else {
                        silentByChild = false;
                        $this.treeview('selectNode', parentNode.nodeId, {
                            silent : true,
                        });
                        $this.treeview('uncheckNode', parentNode.nodeId, {
                            silent : true,
                        });
                    }
                }
                silentByChild = true;
            }
        };

        $('#store_category_ids').treeview(options);

        $('#store_category_ids').on('nodeSelected', function(event, node) {

            // 省级节点被选中，那么市级节点都要选中
            if (node.nodes != null) {

                alert('只允许选择最后一级分类');
                //$this.treeview('checkNode', node.nodeId, {
                $('#store_category_ids').treeview('unselectNode', node.nodeId, {
                    silent : false
                });
            } else {
                //加入input value
                var arr = $('#store_category_ids').treeview('getSelected');

                var ids = [];
                $.each(arr , function (index, val)
                {
                    ids.push(val.nodeId);
                });

                $('input[name="store_category_ids"]').val(ids);
            }
        });

         */


        Public.ajax({
            url : SYS.CONFIG.index_url + '?mdu=seller&ctl=Store_ProductCategory&met=treeview&typ=json', // 请求的URL
            data: {
                store_category_ids: product['store_category_ids']
            },
            dataType : 'json',
            cache : false,
            success : function(response) {
                if (response.status == 200) {
                    var options = {
                        bootstrap2: false,
                        showTags: true,
                        levels: 5,
                        data: response.data.items,
                        highlightSelected : true,// 选中项不高亮，避免和上述制定的颜色变化规则冲突
                        multiSelect : true,// 不允许多选，因为我们要通过check框来控制

                        onNodeSelected : function(event, node) {
                        },
                        onNodeUnchecked : function(event, node) {
                        }
                    };

                    $('#store_category_ids').treeview(options);

                    $('#store_category_ids').on('nodeSelected', function(event, node) {

                        // 省级节点被选中，那么市级节点都要选中
                        if (node.nodes != null) {

                            parent.Public.tips({type: 1, content : __('只允许选择最后一级分类')});

                            //$this.treeview('checkNode', node.nodeId, {
                            $(this).treeview('unselectNode', node.nodeId, {
                                silent : false
                            });
                        } else {
                            //加入input value
                            var arr = $('#store_category_ids').treeview('getSelected');

                            var ids = [];
                            $.each(arr , function (index, val)
                            {
                                ids.push(val.id);
                            });

                            $('input[name="' + $(this).prop('id') + '"]').val(ids);
                        }
                    });


                }
            }
        });
    });
</script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_base_list')?>"></script>
