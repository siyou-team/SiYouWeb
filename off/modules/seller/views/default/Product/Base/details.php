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

			<form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_id">产品SPU</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_id" id="product_id" value="<?= @$data['product_id'] ?>"  placeholder="产品SPU" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_name">产品名称</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_name" id="product_name" value="<?= @$data['product_name'] ?>"  placeholder="产品名称" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_tips">商品广告词-商品卖点</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_tips" id="product_tips" value="<?= @$data['product_tips'] ?>"  placeholder="商品广告词-商品卖点" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="store_id">店铺编号</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="store_id" id="store_id" value="<?= @$data['store_id'] ?>"  placeholder="店铺编号" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="store_name">店铺名称</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="store_name" id="store_name" value="<?= @$data['store_name'] ?>"  placeholder="店铺名称" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_image">商品主图</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_image" id="product_image" value="<?= @$data['product_image'] ?>"  placeholder="商品主图" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_assist">属性JSON</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_assist" id="product_assist" value="<?= @$data['product_assist'] ?>"  placeholder="属性JSON" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_spec">规格</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_spec" id="product_spec" value="<?= @$data['product_spec'] ?>"  placeholder="规格" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_market_price">市场价</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_market_price" id="product_market_price" value="<?= @$data['product_market_price'] ?>"  placeholder="市场价" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_unit_price">商品单价</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_unit_price" id="product_unit_price" value="<?= @$data['product_unit_price'] ?>"  placeholder="商品单价" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_cost_price">成本价</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_cost_price" id="product_cost_price" value="<?= @$data['product_cost_price'] ?>"  placeholder="成本价" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_number">商品编号-货号</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_number" id="product_number" value="<?= @$data['product_number'] ?>"  placeholder="商品编号-货号" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_barcode">商品条形码</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_barcode" id="product_barcode" value="<?= @$data['product_barcode'] ?>"  placeholder="商品条形码" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="shop_category_id">店铺分类</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="shop_category_id" id="shop_category_id" value="<?= @$data['shop_category_id'] ?>"  placeholder="店铺分类id 首尾用,隔开" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_is_format_top">顶部关联板式</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_is_format_top" id="product_is_format_top" value="<?= @$data['product_is_format_top'] ?>"  placeholder="顶部关联板式" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_is_format_bottom">底部关联板式</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_is_format_bottom" id="product_is_format_bottom" value="<?= @$data['product_is_format_bottom'] ?>"  placeholder="底部关联板式" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_quota">每人限购 0 不限</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_quota" id="product_quota" value="<?= @$data['product_quota'] ?>"  placeholder="每人限购 0 不限" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_user_level_discount">参加会员等级折扣</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_user_level_discount" id="product_user_level_discount" value="<?= @$data['product_user_level_discount'] ?>"  placeholder="参加会员等级折扣" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_shop_card_discount">参加店铺发放的会员卡折扣</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_shop_card_discount" id="product_shop_card_discount" value="<?= @$data['product_shop_card_discount'] ?>"  placeholder="参加店铺发放的会员卡折扣" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_add_time">商品添加时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_add_time" id="product_add_time" value="<?= @$data['product_add_time'] ?>"  placeholder="商品添加时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_edit_time">编辑时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_edit_time" id="product_edit_time" value="<?= @$data['product_edit_time'] ?>"  placeholder="编辑时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_sale_time">预设上架时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_sale_time" id="product_sale_time" value="<?= @$data['product_sale_time'] ?>"  placeholder="预设上架时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="transport_type_id">选择售卖区域:完成售卖区域及运费设置</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="transport_type_id" id="transport_type_id" value="<?= @$data['transport_type_id'] ?>"  placeholder="选择售卖区域:完成售卖区域及运费设置" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_weight">商品重量-暂不使用</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_weight" id="product_weight" value="<?= @$data['product_weight'] ?>"  placeholder="商品重量-暂不使用" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_cubage">商品体积-暂不使用</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_cubage" id="product_cubage" value="<?= @$data['product_cubage'] ?>"  placeholder="商品体积-暂不使用" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_service_text">售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_service_text" id="product_service_text" value="<?= @$data['product_service_text'] ?>"  placeholder="售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_province_id">省</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_province_id" id="product_province_id" value="<?= @$data['product_province_id'] ?>"  placeholder="省" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_city_id">市</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_city_id" id="product_city_id" value="<?= @$data['product_city_id'] ?>"  placeholder="市" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_county_id">县</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_county_id" id="product_county_id" value="<?= @$data['product_county_id'] ?>"  placeholder="县" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_region">区域-省 市 区</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_region" id="product_region" value="<?= @$data['product_region'] ?>"  placeholder="区域-省 市 区" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_is_pre_sale">预售商品</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_is_pre_sale" id="product_is_pre_sale" value="<?= @$data['product_is_pre_sale'] ?>"  placeholder="预售商品" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_pre_sale_end">预售结束时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_pre_sale_end" id="product_pre_sale_end" value="<?= @$data['product_pre_sale_end'] ?>"  placeholder="预售结束时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_pss_start">预计发货时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_pss_start" id="product_pss_start" value="<?= @$data['product_pss_start'] ?>"  placeholder="预计发货时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="product_pss_end">预计发货时间</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="product_pss_end" id="product_pss_end" value="<?= @$data['product_pss_end'] ?>"  placeholder="预计发货时间" autocomplete="off" />
					</div>
				</div>
				<div class="form-group-separator"></div>

			</form>
			<form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
				<div class="form-section">
					<label class="input-label" for="product_id">产品SPU</label>
					<input type="text" class="input-text form-control" name="product_id" id="product_id"  placeholder="产品SPU" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_name">产品名称</label>
					<input type="text" class="input-text form-control" name="product_name" id="product_name"  placeholder="产品名称" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_tips">商品广告词-商品卖点</label>
					<input type="text" class="input-text form-control" name="product_tips" id="product_tips"  placeholder="商品广告词-商品卖点" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="store_id">店铺编号</label>
					<input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="店铺编号" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="store_name">店铺名称</label>
					<input type="text" class="input-text form-control" name="store_name" id="store_name"  placeholder="店铺名称" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_image">商品主图</label>
					<input type="text" class="input-text form-control" name="product_image" id="product_image"  placeholder="商品主图" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_assist">属性JSON</label>
					<input type="text" class="input-text form-control" name="product_assist" id="product_assist"  placeholder="属性JSON" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_spec">规格</label>
					<input type="text" class="input-text form-control" name="product_spec" id="product_spec"  placeholder="规格" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_market_price">市场价</label>
					<input type="text" class="input-text form-control" name="product_market_price" id="product_market_price"  placeholder="市场价" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_unit_price">商品单价</label>
					<input type="text" class="input-text form-control" name="product_unit_price" id="product_unit_price"  placeholder="商品单价" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_cost_price">成本价</label>
					<input type="text" class="input-text form-control" name="product_cost_price" id="product_cost_price"  placeholder="成本价" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_number">商品编号-货号</label>
					<input type="text" class="input-text form-control" name="product_number" id="product_number"  placeholder="商品编号-货号" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_barcode">商品条形码</label>
					<input type="text" class="input-text form-control" name="product_barcode" id="product_barcode"  placeholder="商品条形码" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="shop_category_id">店铺分类id 首尾用,隔开</label>
					<input type="text" class="input-text form-control" name="shop_category_id" id="shop_category_id"  placeholder="店铺分类id 首尾用,隔开" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_is_format_top">顶部关联板式</label>
					<input type="text" class="input-text form-control" name="product_is_format_top" id="product_is_format_top"  placeholder="顶部关联板式" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_is_format_bottom">底部关联板式</label>
					<input type="text" class="input-text form-control" name="product_is_format_bottom" id="product_is_format_bottom"  placeholder="底部关联板式" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_quota">每人限购 0 不限</label>
					<input type="text" class="input-text form-control" name="product_quota" id="product_quota"  placeholder="每人限购 0 不限" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_user_level_discount">参加会员等级折扣</label>
					<input type="text" class="input-text form-control" name="product_user_level_discount" id="product_user_level_discount"  placeholder="参加会员等级折扣" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_shop_card_discount">参加店铺发放的会员卡折扣</label>
					<input type="text" class="input-text form-control" name="product_shop_card_discount" id="product_shop_card_discount"  placeholder="参加店铺发放的会员卡折扣" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_add_time">商品添加时间</label>
					<input type="text" class="input-text form-control" name="product_add_time" id="product_add_time"  placeholder="商品添加时间" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_edit_time">编辑时间</label>
					<input type="text" class="input-text form-control" name="product_edit_time" id="product_edit_time"  placeholder="编辑时间" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_sale_time">预设上架时间</label>
					<input type="text" class="input-text form-control" name="product_sale_time" id="product_sale_time"  placeholder="预设上架时间" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="transport_type_id">选择售卖区域:完成售卖区域及运费设置</label>
					<input type="text" class="input-text form-control" name="transport_type_id" id="transport_type_id"  placeholder="选择售卖区域:完成售卖区域及运费设置" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_weight">商品重量-暂不使用</label>
					<input type="text" class="input-text form-control" name="product_weight" id="product_weight"  placeholder="商品重量-暂不使用" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_cubage">商品体积-暂不使用</label>
					<input type="text" class="input-text form-control" name="product_cubage" id="product_cubage"  placeholder="商品体积-暂不使用" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_service_text">售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
						售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的</label>
					<input type="text" class="input-text form-control" name="product_service_text" id="product_service_text"  placeholder="售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
					售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的
					售后服务-售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_province_id">省</label>
					<input type="text" class="input-text form-control" name="product_province_id" id="product_province_id"  placeholder="省" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_city_id">市</label>
					<input type="text" class="input-text form-control" name="product_city_id" id="product_city_id"  placeholder="市" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_county_id">县</label>
					<input type="text" class="input-text form-control" name="product_county_id" id="product_county_id"  placeholder="县" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_region">区域-省 市 区</label>
					<input type="text" class="input-text form-control" name="product_region" id="product_region"  placeholder="区域-省 市 区" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_is_pre_sale">预售商品</label>
					<input type="text" class="input-text form-control" name="product_is_pre_sale" id="product_is_pre_sale"  placeholder="预售商品" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_pre_sale_end">预售结束时间</label>
					<input type="text" class="input-text form-control" name="product_pre_sale_end" id="product_pre_sale_end"  placeholder="预售结束时间" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_pss_start">预计发货时间</label>
					<input type="text" class="input-text form-control" name="product_pss_start" id="product_pss_start"  placeholder="预计发货时间" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="product_pss_end">预计发货时间</label>
					<input type="text" class="input-text form-control" name="product_pss_end" id="product_pss_end"  placeholder="预计发货时间" autocomplete="off" />
				</div>

			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var curRow, curCol, curArrears, $grid = $("#grid"), $_form = $("#manage-form"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

	initPopBtns();
	initField();

	function initField()
	{
		if (rowData.id)
		{
			$('#product_id').val(rowData.product_id);
			$('#product_name').val(rowData.product_name);
			$('#product_tips').val(rowData.product_tips);
			$('#store_id').val(rowData.store_id);
			$('#store_name').val(rowData.store_name);
			$('#product_image').val(rowData.product_image);
			$('#product_assist').val(rowData.product_assist);
			$('#product_spec').val(rowData.product_spec);
			$('#product_market_price').val(rowData.product_market_price);
			$('#product_unit_price').val(rowData.product_unit_price);
			$('#product_cost_price').val(rowData.product_cost_price);
			$('#product_number').val(rowData.product_number);
			$('#product_barcode').val(rowData.product_barcode);
			$('#shop_category_id').val(rowData.shop_category_id);
			$('#product_is_format_top').val(rowData.product_is_format_top);
			$('#product_is_format_bottom').val(rowData.product_is_format_bottom);
			$('#product_quota').val(rowData.product_quota);
			$('#product_user_level_discount').val(rowData.product_user_level_discount);
			$('#product_shop_card_discount').val(rowData.product_shop_card_discount);
			$('#product_add_time').val(rowData.product_add_time);
			$('#product_edit_time').val(rowData.product_edit_time);
			$('#product_sale_time').val(rowData.product_sale_time);
			$('#transport_type_id').val(rowData.transport_type_id);
			$('#product_weight').val(rowData.product_weight);
			$('#product_cubage').val(rowData.product_cubage);
			$('#product_service_text').val(rowData.product_service_text);
			$('#product_province_id').val(rowData.product_province_id);
			$('#product_city_id').val(rowData.product_city_id);
			$('#product_county_id').val(rowData.product_county_id);
			$('#product_region').val(rowData.product_region);
			$('#product_is_pre_sale').val(rowData.product_is_pre_sale);
			$('#product_pre_sale_end').val(rowData.product_pre_sale_end);
			$('#product_pss_start').val(rowData.product_pss_start);
			$('#product_pss_end').val(rowData.product_pss_end);


			//$('#keyword_find').attr("readonly", "readonly");
			//$('#keyword_find').addClass('ui-input-dis');
		}
	}

	function initPopBtns()
	{
		var btn = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
		api.button({
			id: "confirm", name: btn[0], focus: !0, callback: function ()
			{
				postData(oper, rowData.id);
				return cancleGridEdit(), $_form.trigger("validate"), !1;
			}
		}, {id: "cancel", name: btn[1]})
	}

	function postData(oper, id)
	{
		$_form.validator({
			ignore: ':hidden',
			theme: 'yellow_bottom',
			timely: 1,
			stopOnError: true,
			fields: {
				//'keyword_find': 'required;'
			},
			valid: function (form)
			{
				var me = this;
				// 提交表单之前，hold住表单，防止重复提交
				me.holdSubmit();

				$.dialog.confirm('修改立马生效,是否继续？', function ()
					{
						/*
						 var keyword_find = $.trim($("#keyword_find").val());

						 var params = {keyword_find: keyword_find, keyword_replace: keyword_replace};
						 */
						var n = "add" == oper ? __("新增") : __("修改");

						Public.ajaxPost(SYS.CONFIG.index_url + "?ctl=Product_Base&typ=json&met=" + ("add" == oper ? "add" : "edit"), $_form.serialize(), function (resp)
						{
							if (200 == resp.status)
							{
								resp.data['id'] = resp.data['product_id'];
								parent.parent.Public.tips({content: n + "成功！"});
								callback && "function" == typeof callback && callback(resp.data, oper, window)
							}
							else
							{
								parent.parent.Public.tips({type: 1, content: n + "失败！" + resp.msg})
							}

							// 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
							me.holdSubmit(false);
						})
					},
					function ()
					{
						me.holdSubmit(false);
					});
			},
		}).on("click", "a.submit-btn", function (e)
		{
			$(e.delegateTarget).trigger("validate");
		});
	}

	function cancleGridEdit()
	{
		null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
	}

	//设置表单元素回车事件
	function bindEventForEnterKey()
	{
		Public.bindEnterSkip($_form, function()
		{
			$('#grid tr.jqgrow:eq(0) td:eq(0)').trigger('click');
		});
	}

	function resetForm(t)
	{
		$('#product_id').val('');
		$('#product_name').val('');
		$('#product_tips').val('');
		$('#store_id').val('');
		$('#store_name').val('');
		$('#product_image').val('');
		$('#product_assist').val('');
		$('#product_spec').val('');
		$('#product_market_price').val('');
		$('#product_unit_price').val('');
		$('#product_cost_price').val('');
		$('#product_number').val('');
		$('#product_barcode').val('');
		$('#shop_category_id').val('');
		$('#product_is_format_top').val('');
		$('#product_is_format_bottom').val('');
		$('#product_quota').val('');
		$('#product_user_level_discount').val('');
		$('#product_shop_card_discount').val('');
		$('#product_add_time').val('');
		$('#product_edit_time').val('');
		$('#product_sale_time').val('');
		$('#transport_type_id').val('');
		$('#product_weight').val('');
		$('#product_cubage').val('');
		$('#product_service_text').val('');
		$('#product_province_id').val('');
		$('#product_city_id').val('');
		$('#product_county_id').val('');
		$('#product_region').val('');
		$('#product_is_pre_sale').val('');
		$('#product_pre_sale_end').val('');
		$('#product_pss_start').val('');
		$('#product_pss_end').val('');

	}

	$(".box-main .form-section:has(label)").each(function(i, el)
	{
		var $this = $(el),
			$label = $this.find('label'),
			$input = $this.find('.form-control');

		$input.on('focus', function()
		{
			$this.addClass('form-section-active');
			$this.addClass('form-section-focus');
		});

		$input.on('keydown', function()
		{
			$this.addClass('form-section-active');
			$this.addClass('form-section-focus');
		});

		$input.on('blur', function()
		{
			$this.removeClass('form-section-focus');

			if(!$.trim($input.val()))
			{
				$this.removeClass('form-section-active');
			}
		});

		$label.on('click', function()
		{
			$input.focus();
		});

		if($.trim($input.val()))
		{
			$this.addClass('form-section-active');
		}
	});
</script>