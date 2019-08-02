
<?php $rand_key = rand(); ?>
<div class="row">
    <div class="col-sm-12">
        <h2><?= __('实名认证') ?></h2>
    </div>
    <div class="col-sm-12">
        <?php if ($data['user_certification'] == StateCode::USER_CERTIFICATION_NO || $data['user_certification'] == StateCode::USER_CERTIFICATION_VERIFY) : ?>
            <?php if ($data['user_certification'] == StateCode::USER_CERTIFICATION_NO) : ?>
                <div id="certification_no">
                    <div class="alert alert-info">
                        <strong><?=__('提示')?>：</strong><?=__('设置身份信息请务必准确填写本人的身份信息，注册后不能更改，隐私信息未经本人许可严格保密。')?><br/>
                        <?=__('若你的身份信息和支付身份信息不一致，将会自动关闭已开通的提现服务。')?>
                    </div>
                    <form  method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form"  action="<?= urlh('account.php', 'User_Security', 'saveSaveCertificate', '', '', array('typ' => 'json'))?>" data-validator-option="{stopOnError:false, timely:false}">
                        <div class="form-group-separator">&nbsp;</div>
                        <div class="form-group">
                            <label class="col-lg-2 col-md-4 col-sm-6 control-label" for="user_realname"><?=__('真实姓名')?></label>
                            <div class="col-lg-10 col-md-8 col-sm-6">
                                <input type="text" class="form-control" name="user_realname" id="user_realname" value=""  placeholder="<?=__('请输入真实姓名')?>" autocomplete="off" data-rule="required;" required />
                            </div>
                        </div>

                        <div class="form-group-separator">&nbsp;</div>
                        <div class="form-group">
                            <label class="col-lg-2 col-md-4 col-sm-6 control-label" for="user_idcard"><?=__('身份证号码')?></label>
                            <div class="col-lg-10 col-md-8 col-sm-6">
                                <input type="text" class="form-control" name="user_idcard" id="user_idcard" value=""  placeholder="<?=__('请输入18位身份证号码')?>" autocomplete="off" data-rule="required;" required />
                            </div>
                        </div>
                        <div class="form-group-separator">&nbsp;</div>
                        <div class="form-group">
                            <label class="col-lg-2 col-md-4 col-sm-6 control-label" for="user_idcard_images"><?=__('身份证照片')?></label>
                            <div class="col-lg-10 col-md-8 col-sm-6">
                                <a href="#"  data-toggle="image" style="" class="img-thumbnail  picture_upload_replace" id="user_idcard_images">
                                    <input type="hidden" class="form-control" name="user_idcard_images" value="" autocomplete="off" data-rule="required;" required />
                                    <img  width="100" height="100" />
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <a type="submit" class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone" id="J_certification">
                                    <i class="fa-pencil"></i>
                                    <span><?=__('提交')?></span>
                                </a>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <div id="certification_verify" class="alert alert-info <?= $data['user_certification'] == StateCode::USER_CERTIFICATION_VERIFY ? '' : 'hide'; ?>">
                <?=__('已身份信息已提交，正在审核中！')?>
            </div>
        <?php else: ?>
            <div class="">
                <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive cart_summary">
                    <thead>
                    <tr>
                        <th colspan="2"><?=__('已通过实名认证')?></th>
                    </tr>
                    </thead>
                    <tr>
                        <td><?=__('姓名')?></td>
                        <td><?= $data['user_realname']?></td>
                    </tr>
                    <tr>
                        <td><?=__('18位身份证号')?></td>
                        <td><?= $data['user_idcard']?></td>
                    </tr>
                </table>
            </div>

        <?php endif; ?>
    </div>
</div>
<?php $this->lazyJs('img-upload') ?>
<?php $this->lazyJs('user_certification') ?>


