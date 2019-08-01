<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">


<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="page-title">
            <div class="title-env">
                <h1 class="title"><?= __('经验设置') ?></h1>
                <p class="description"><?= __('经验设置') ?></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal setting-form" >
                    <input type="hidden" name="config_type[]" value="experience"/>

                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exp_reg"><?=__('会员注册')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="experience[exp_reg]" id="exp_reg" value="<?= Base_ConfigModel::getConfig('exp_reg') ?>"  placeholder="<?=__('会员注册')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exp_evaluate_good"><?=__('订单商品评论')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="experience[exp_evaluate_good]" id="exp_evaluate_good" value="<?= Base_ConfigModel::getConfig('exp_evaluate_good') ?>"  placeholder="<?=__('订单商品评论')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exp_login"><?=__('会员每天登录')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="experience[exp_login]" id="exp_login" value="<?= Base_ConfigModel::getConfig('exp_login') ?>"  placeholder="<?=__('会员每天登录')?>" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exp_consume_rate"><?=__('消费额与赠送经验比例')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="experience[exp_consume_rate]" id="exp_consume_rate" value="<?= Base_ConfigModel::getConfig('exp_consume_rate') ?>"  placeholder="<?=__('消费额与赠送经验比例')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="exp_consume_max"><?=__('每订单最多赠送经验')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="experience[exp_consume_max]" id="exp_consume_max" value="<?= Base_ConfigModel::getConfig('exp_consume_max') ?>"  placeholder="<?=__('每订单最多赠送经验')?>" autocomplete="off" />
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

<script type="text/javascript" src="<?=$this->js('controllers/config')?>" charset="utf-8"></script>