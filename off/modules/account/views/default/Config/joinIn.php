<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true) ?>">
<link rel="stylesheet" href="<?=$this->css('plugins/multiselect/css/multi-select', true) ?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-new', true) ?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-bootstrap', true) ?>">

<div class="page-container">
    <div class="main-content">

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">招商方向</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="joinin"/>


                            <div class="form-group">
                                <label class="control-label" for="joinin_investment_direction">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="joinin[joinin_investment_direction]" id="joinin_investment_direction" rows="4"><?= @$data['joinin_investment_direction']['config_value']; ?></textarea>
                                </div>
                            </div>

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

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">入驻标准</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="joinin"/>

                            <div class="form-group">
                                <label class="control-label" for="joinin_standard">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="joinin[joinin_standard]" id="joinin_standard" rows="4"><?= @$data['joinin_standard']['config_value']; ?></textarea>
                                </div>
                            </div>

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


        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">入驻资质</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="joinin"/>


                            <div class="form-group">
                                <label class="control-label" for="joinin_condition">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="joinin[joinin_condition]" id="joinin_condition" rows="4"><?= @$data['joinin_condition']['config_value'] ?></textarea>
                                </div>
                            </div>

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

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">合作细则</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="joinin"/>

                            <div class="form-group">
                                <label class="control-label" for="joinin_cooperation_details">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="joinin[joinin_cooperation_details]" id="joinin_cooperation_details" rows="4"><?= @$data['joinin_cooperation_details']['config_value'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <a type="submit"
                                   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                   id="submit-btn">
                                    <i class="fa-pencil"></i>
                                    <span>修改</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">资费标准</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="joinin"/>

                            <div class="form-group">
                                <label class="control-label" for="joinin_expenses_details">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="joinin[joinin_expenses_details]" id="joinin_expenses_details" rows="4"><?= @$data['joinin_expenses_details']['config_value'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <a type="submit"
                                   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                   id="submit-btn">
                                    <i class="fa-pencil"></i>
                                    <span>修改</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>
</div>

<script src="<?= $this->js('controllers/message/message_template') ?>"></script>
<script type="text/javascript" src="<?= $this->js('ckeditor/ckeditor', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('ckeditor/config', true) ?>"></script>
<script>

    $('a[type=submit]').click(function () {
        //需要手动更新CKEDITOR字段
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
        return true;
    });
</script>
<script type="text/javascript" src="<?= $this->js('plugins/tagsinput/bootstrap-tagsinput.min', true) ?>/.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->js('plugins/multiselect/js/jquery.multi-select', true) ?>/.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->js('plugins/select2/js/select2.full', true) ?>/.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->js('controllers/config') ?>/.js" charset="utf-8"></script>
