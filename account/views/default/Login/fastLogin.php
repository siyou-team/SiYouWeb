<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<div>
    <div class="login-container" style="">
        <div class="row" >
            <div class="col-sm-7"></div>
            <div class="col-sm-5">
                <!-- Errors container -->
                <div class="errors-container">
                </div>

                <!-- Add class "fade-in-effect" for login form effect -->
                <form method="post" role="form" id="login" class="login-form fade-in-effect">

                    <div class="login-header">
                        <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                            <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                            <span><?=__('登录')?></span>
                        </a>
                        <p style="display: none;"><?= sprintf(__('登录到').' %s', Base_ConfigModel::getConfig('account_site_name'))?></p>
                        
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="user_account"><?=__('账号')?></label>
                        <input type="text" class="form-control" name="user_account" id="user_account" autocomplete="off" value="" />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="user_password"><?=__('密码')?></label>
                        <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" value="" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  btn-block text-left">
                            <i class="fa-lock"></i>
                            <?=__('登录')?>
                        </button>
                    </div>

                    <div class="login-footer text-right">
                        <a href="<?=urlh('account.php', 'Login', 'findpwd') . LoginModel::callbackStr()?>"><?=__('登录遇到问题')?></a> | <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>
                        <div class="info-links">
                        </div>

                    </div>

                    <!-- External login -->
                    <div class="external-login-small" >
                        <?=__('其他账号登录')?>
                        
                        <?php if ($data['connect']['weixin_status']['config_value']):?>
                            <a href="<?=urlh('account.php', 'Connect_Weixin', 'login') . LoginModel::callbackStr()?>" class="wechat">
                                <i class="weixin"></i>
                                
                            </a>
                        <?php endif;?>
                        
                        <?php if ($data['connect']['qq_status']['config_value']):?>
                            <a href="<?=urlh('account.php', 'Connect_Qq', 'login') . LoginModel::callbackStr()?>" class="qq">
                                <i class="qq"></i>
                                
                            </a>
                        <?php endif;?>
                        
                        
                        <?php if ($data['connect']['weibo_status']['config_value']):?>
                            <a href="<?=urlh('account.php', 'Connect_Weibo', 'login') . LoginModel::callbackStr()?>" class="weibo">
                                <i class="weibo"></i>
                                
                            </a>
                        <?php endif;?>
                        
                        <?php if ($data['connect']['facebook_status']['config_value']):?>
                            <a href="#" class="facebook">
                                <i class="fa-facebook"></i>
                                
                            </a>
                        <?php endif;?>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
<?php $this->lazyJs('login') ?>

