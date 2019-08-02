
<?php
$bind_type_row = array_column_unique($data, 'bind_type');
?>
<div class="page ">
    <div class="page-header">
        <h1 class="page-title"><?= __('绑定') ?></h1>
        <div class="page-description"><?= __('帐号绑定的第三方帐号，可用于直接登录网等网站') ?></div>
        <!--<div class="page-header-actions">
            <button type="button" class="btn btn-sm btn-outline btn-default btn-round">
                <span class="text hidden-xs">设置</span> <i class="icon wb-chevron-right" aria-hidden="true"></i>
            </button>
        </div>-->
    </div>
    <div class="page-content">
        <div class="row">
            <?php if ($data['connect']['weixin_status']['config_value']):?>
                <div class="col-sm-4">
                    <div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
                        <div class="xe-icon">
                            <i class="fa-wechat"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num"><?=__('微信')?></strong>
                            <?php if (in_array(User_BindConnectModel::WEIXIN, $bind_type_row)):?>
                            <span><a data-bind_type="<?=User_BindConnectModel::WEIXIN?>" href="javascript:" id="btn-status-del"><?=__('解除绑定')?></a></span>
                            <?php else: ?>
                                <span><a href="<?=urlh('account.php', 'Connect_Weixin', 'login') . LoginModel::callbackStr()?>"><span class="badge badge-info" style="color: #fff;"><?=__('绑定')?></span></a></span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            
            <?php if ($data['connect']['qq_status']['config_value']):?>
                <div class="col-sm-4">

                    <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="1" data-to="117" data-suffix="k" data-duration="3" data-easing="false">
                        <div class="xe-icon">
                            <i class="fa-qq"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num"><?=__('QQ')?></strong>
                            <?php if (in_array(User_BindConnectModel::QQ, $bind_type_row)):?>
                                <span><a data-bind_type="<?=User_BindConnectModel::QQ?>" href="javascript:" id="btn-status-del"><?=__('解除绑定')?></a></span>
                            <?php else: ?>
                                <a href="<?=urlh('account.php', 'Connect_Qq', 'login') . LoginModel::callbackStr()?>"><span class="badge badge-info" style="color: #fff;"><?=__('绑定')?></span></a>
                            <?php endif;?>
                        </div>
                    </div>

                </div>
            <?php endif;?>
            
            <?php if ($data['connect']['weibo_status']['config_value']):?>
                <div class="col-sm-4">

                    <div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="1000" data-to="2470" data-duration="4" data-easing="true">
                        <div class="xe-icon">
                            <i class="fa-weibo"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num"><?=__('微博')?></strong>
                            <?php if (in_array(User_BindConnectModel::SINA_WEIBO, $bind_type_row)):?>
                                <span><a data-bind_type="<?=User_BindConnectModel::SINA_WEIBO?>" href="javascript:" id="btn-status-del"> <?=__('解除绑定')?></a></span>
                            <?php else: ?>
                                <a href="<?=urlh('account.php', 'Connect_Weibo', 'login') . LoginModel::callbackStr()?>"><span class="badge badge-info" style="color: #fff;"><?=__('绑定')?></span></a>
                            <?php endif;?>
                        </div>
                    </div>

                </div>
            <?php endif;?>
        </div>
    </div>
</div>



<?php $this->lazyJs('connect-index') ?>



