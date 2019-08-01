<div name="shareMskTpl">
    <div :class="'shareMsk ' + (PageQRCodeInfo.IsShare?'':'hide')">
        <div :class="'sharebox ' + (PageQRCodeInfo.IsShareBox?'bounceInUp animated':'bounceOutDown animated')">
            <div class='shareList g-flex '>
                <div class='shareItem g-flex-item'>
                    <div class='shareBtn'>
                        <button open-type="share" style='line-height:0' hover-class="none">
                            <img src='../../images/activity/friend.png' style='width:2.6667rem;height:2.6667rem;margin-bottom:0.16rem' />
                        </button>
                        <label><?=__('分享给朋友')?></label>
                    </div>
                </div>
                <div class='shareItem g-flex-item'>
                    <div class='shareBtn' bindtap='shareQRCode'>
                        <img src='../../images/activity/allfriend.png' style='width:2.6667rem;height:2.6667rem' />
                        <label><?=__('分享到朋友圈')?></label>
                    </div>
                </div>
            </div>
            <div class='cancelShare' bindtap='cancelShare'><?=__('取消')?></div>
        </div>
        <div class="'shareCodeImg ' + (PageQRCodeInfo.IsJT?'':'hide')">
            <i type="clear" size="20" bindtap='cancelShare'> </i>
            <div  bindtap='showCodeImg'>
                <img mode="widthFix" :src='PageQRCodeInfo.Path' />
            </div>
            <label><?=__('保存至相册 分享到朋友圈')?></label>
            <button type="primary" size="mini" bindtap="saveImg"> <?=__('保存图片')?> </button>
        </div>
    </div>
</div>
