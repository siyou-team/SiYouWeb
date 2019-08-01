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
                <input type="hidden" class="input-text form-control" name="ask_id" id="ask_id"  placeholder="<?=__('咨询id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="product_id"><?=__('商品id')?></label>
                    <input type="text" class="input-text form-control" name="product_id" id="product_id"  placeholder="<?=__('商品id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="ask_question"><?=__('咨询内容')?></label>
                    <input type="text" class="input-text form-control" name="ask_question" id="ask_question"  placeholder="<?=__('咨询内容')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="ask_answer"><?=__('答案')?></label>
                    <input type="text" class="input-text form-control" name="ask_answer" id="ask_answer"  placeholder="<?=__('答案')?>" autocomplete="off" />
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/product/product_ask_base')?>"></script>