<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/multiselect/css/multi-select', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-new', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-bootstrap', true)?>">

<div class="page-container">
    <div class="main-content">

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">用户服务协议（注册协议）</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="reg_protocols_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[reg_protocols_title]" id="reg_protocols_title" value="<?/*= (@$data['reg_protocols_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="reg_protocols_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[reg_protocols_time]" id="reg_protocols_time" value="<?/*= (@$data['reg_protocols_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="reg_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[reg_protocols_description]" id="reg_protocols_description" rows="4"><?= @$data['reg_protocols_description']['config_value'] ?></textarea>
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

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">开店协议</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="open_store_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[open_store_title]" id="open_store_title" value="<?/*= (@$data['open_store_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="open_store_protocol_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[open_store_time]" id="open_store_time" value="<?/*= (@$data['open_store_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="open_store_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[open_store_description]" id="open_store_description" rows="4"><?= @$data['open_store_description']['config_value'] ?></textarea>
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
                        <div class="panel-title">团购活动协议</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="purchase_activity_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[purchase_activity_title]" id="purchase_activity_title" value="<?/*= (@$data['purchase_activity_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="purchase_activity_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[purchase_activity_time]" id="purchase_activity_time" value="<?/*= (@$data['purchase_activity_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="purchase_activity_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[purchase_activity_description]" id="purchase_activity_description" rows="4"><?= @$data['purchase_activity_description']['config_value'] ?></textarea>
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

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">圈子使用须知</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="circle_used_protocols_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[circle_used_protocols_title]" id="circle_used_protocols_title" value="<?/*= (@$data['circle_used_protocols_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="circle_used_protocols_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[circle_used_protocols_time]" id="circle_used_protocols_time" value="<?/*= (@$data['circle_used_protocols_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="circle_used_protocols_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[circle_used_protocols_description]" id="circle_used_protocols_description" rows="4"><?= @$data['circle_used_protocols_description']['config_value'] ?></textarea>
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
                        <div class="panel-title">分销商认知协议</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="distribution_protocols_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[distribution_protocols_title]" id="distribution_protocols_title" value="<?/*= (@$data['distribution_protocols_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="distribution_protocols_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[distribution_protocols_time]" id="distribution_protocols_time" value="<?/*= (@$data['distribution_protocols_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="distribution_protocols_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[distribution_protocols_description]" id="distribution_protocols_description" rows="4"><?= @$data['distribution_protocols_description']['config_value'] ?></textarea>
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

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">拼团玩法详情</div>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" class="setting-form">
                            <input type="hidden" name="config_type[]" value="protocols"/>

                            <!--<div class="form-group">
                                <label class="control-label" for="tour_diy_protocols_title">标题</label>

                                <div class="">
                                    <input class="form-control" name="protocols[tour_diy_protocols_title]" id="tour_diy_protocols_title" value="<?/*= (@$data['tour_diy_protocols_title']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <!--<div class="form-group">
                                <label class="control-label" for="tour_diy_protocols_time">协议修改时间</label>

                                <div class="">
                                    <input class="input-text form-control datepicker" name="protocols[tour_diy_protocols_time]" id="tour_diy_protocols_time" value="<?/*= (@$data['tour_diy_protocols_time']['config_value']) */?>"/>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>-->

                            <div class="form-group">
                                <label class="control-label" for="tour_diy_protocols_description">协议内容</label>

                                <div class="">
                                    <textarea class="ckeditor form-control" name="protocols[tour_diy_protocols_description]" id="tour_diy_protocols_description" rows="4"><?= @$data['tour_diy_protocols_description']['config_value'] ?></textarea>
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

<script src="<?=$this->js('controllers/message/message_template')?>"></script>
<script type="text/javascript" src="<?=$this->js('ckeditor/ckeditor', true)?>"></script>
<script type="text/javascript" src="<?=$this->js('ckeditor/config', true)?>"></script>
<script>

    $('a[type=submit]').click(function(){
        //需要手动更新CKEDITOR字段
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
        return true;
    });
</script>
<script type="text/javascript" src="<?=$this->js('plugins/tagsinput/bootstrap-tagsinput.min', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('controllers/config')?>" charset="utf-8"></script>
