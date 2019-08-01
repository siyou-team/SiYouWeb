<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="comment_reply_id" id="comment_reply_id"  placeholder="<?=__('评论回复id')?>" autocomplete="off" />
                <div class="form-section hide">
                    <label class="input-label" for="comment_id"><?=__('评论id')?></label>
                    <input type="text" class="input-text form-control" name="comment_id" id="comment_id"  placeholder="<?=__('评论id')?>" autocomplete="off" value="<?= i('comment_id', 0)?>" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="comment_reply_content"><?=__('评论回复内容')?></label>
                    <textarea type="text" class="input-text form-control autosize" name="comment_reply_content" id="comment_reply_content"  placeholder="<?=__('评论回复内容')?>" autocomplete="off"></textarea>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/product/product_comment_reply')?>"></script>
