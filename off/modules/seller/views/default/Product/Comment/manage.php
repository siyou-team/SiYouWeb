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
                <input type="hidden" class="input-text form-control" name="comment_id" id="comment_id"  placeholder="<?=__('')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="order_id"><?=__('订单Id')?></label>
                    <input type="text" class="input-text form-control" name="order_id" id="order_id"  placeholder="<?=__('订单Id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="product_id"><?=__('产品SPU')?></label>
                    <input type="text" class="input-text form-control" name="product_id" id="product_id"  placeholder="<?=__('产品SPU')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="item_id"><?=__('商品id')?></label>
                    <input type="text" class="input-text form-control" name="item_id" id="item_id"  placeholder="<?=__('商品id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="item_name"><?=__('商品规格')?></label>
                    <input type="text" class="input-text form-control" name="item_name" id="item_name"  placeholder="<?=__('商品规格')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_id"><?=__('卖家店铺编号-冗余')?></label>
                    <input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="<?=__('卖家店铺编号-冗余')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_name"><?=__('店铺名称')?></label>
                    <input type="text" class="input-text form-control" name="store_name" id="store_name"  placeholder="<?=__('店铺名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_id"><?=__('买家id')?></label>
                    <input type="text" class="input-text form-control" name="user_id" id="user_id"  placeholder="<?=__('买家id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_name"><?=__('买家姓名')?></label>
                    <input type="text" class="input-text form-control" name="user_name" id="user_name"  placeholder="<?=__('user_nickname')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_points"><?=__('获得积分-冗余，独立表记录')?></label>
                    <input type="text" class="input-text form-control" name="comment_points" id="comment_points"  placeholder="<?=__('获得积分-冗余，独立表记录')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_scores"><?=__('评价星级1-5积分')?></label>
                    <input type="text" class="input-text form-control" name="comment_scores" id="comment_scores"  placeholder="<?=__('评价星级1-5积分')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_content"><?=__('评价内容')?></label>
                    <input type="text" class="input-text form-control" name="comment_content" id="comment_content"  placeholder="<?=__('评价内容')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_image"><?=__('评论上传的图片')?></label>
                    <input type="text" class="input-text form-control" name="comment_image" id="comment_image"  placeholder="<?=__('评论上传的图片(DOT)')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_helpful"><?=__('有帮助')?></label>
                    <input type="text" class="input-text form-control" name="comment_helpful" id="comment_helpful"  placeholder="<?=__('有帮助')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_nohelpful"><?=__('无帮助')?></label>
                    <input type="text" class="input-text form-control" name="comment_nohelpful" id="comment_nohelpful"  placeholder="<?=__('无帮助')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_time"><?=__('评价时间')?></label>
                    <input type="text" class="input-text form-control" name="comment_time" id="comment_time"  placeholder="<?=__('评价时间')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_is_anonymous"><?=__('匿名评价')?></label>
                    <input type="text" class="input-text form-control" name="comment_is_anonymous" id="comment_is_anonymous"  placeholder="<?=__('匿名评价')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <input id="comment_enable" name="comment_enable" type="checkbox" value="1" checked="checked" data-on-text="正常显示" data-off-text="禁止显示">
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_store_desc_credit"><?=__('描述相符评分 - order_buyer_evaluation_status , 评价状态改变后不需要再次评论，根据订单走')?></label>
                    <input type="text" class="input-text form-control" name="comment_store_desc_credit" id="comment_store_desc_credit"  placeholder="<?=__('描述相符评分 - order_buyer_evaluation_status , 评价状态改变后不需要再次评论，根据订单走')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_store_service_credit"><?=__('服务态度评分 - order_buyer_evaluation_status')?></label>
                    <input type="text" class="input-text form-control" name="comment_store_service_credit" id="comment_store_service_credit"  placeholder="<?=__('服务态度评分 - order_buyer_evaluation_status')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_store_delivery_credit"><?=__('发货速度评分 - order_buyer_evaluation_status')?></label>
                    <input type="text" class="input-text form-control" name="comment_store_delivery_credit" id="comment_store_delivery_credit"  placeholder="<?=__('发货速度评分 - order_buyer_evaluation_status')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/product/product_comment')?>"></script>