<!--<link rel="stylesheet" href="<?/*=$this->css('plugins/citypicker/css/city-picker', true)*/?>">-->

        <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=urlh('account.php', 'User_Account', 'edit')?>"  data-validator-option="{stopOnError:false, timely:false}">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_realname"><?=__('账号')?></label>
                <div class="col-sm-10 text-inline">
                    <span ><?= @$data['base']['user_account'] ?></span> <span class="badge badge-info"><?= @$data['member_info']['user_level_name'] ?></span>
                    
                    <?php /*if(Base_ConfigModel::getConfig('sale_prize_sp_enable')):*/?><!--
                        <span class=""><a href="javascript:void(0)" class="role-upgrade" data-role="<?/*=  (@$data['user_role']['user_role_name'] ? '0' : '1') */?>">  <?/*=  (@$data['user_role']['user_is_sp'] ? '服务商' : '升级服务商') */?>   <?/*=  (@$data['user_role']['user_is_ca'] ? '市代理' : '') */?> <?/*= (@$data['user_role']['user_is_da'] ? '区代理' : '') */?></a> </span>
                    --><?php /*endif;*/?>
                </div>
            </div>


            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_nickname"><?=__('昵称')?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="user_nickname" id="user_nickname" value="<?= @$data['member_info']['user_nickname'] ?>"  placeholder="<?=__('昵称')?>" autocomplete="off" data-rule="required;" required />
                </div>
            </div>

            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_avatar"><?=__('头像')?></label>
                <div class="col-sm-10">
                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="user_avatar_link">
                        <input type="hidden" class="form-control" name="user_avatar" value="<?=@$data['member_info']['user_avatar']?>" />
                        <img  src="<?=img(@$data['member_info']['user_avatar'])?>"   width="100" height="100" /></a>
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_gender"><?=__('性别')?></label>
                <div class="col-sm-10 radio-inline">
                    <label title="<?=__('男')?>" for="user_gender_1"><input class="cbr cbr-success form-control" id="user_gender_1" name="user_gender" value="1" type="radio" <?=eq('1', $data['member_info']['user_gender'], 'checked')?> ><?=__('男')?></label><label title="<?=__('女')?>" for="user_gender_2"><input class="cbr cbr-success form-control" id="user_gender_2" name="user_gender" value="2" type="radio" <?=eq('2', $data['member_info']['user_gender'], 'checked')?> ><?=__('女')?></label>
                </div>
            </div>

            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_qq"><?=__('生日')?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control datepicker" data-format="Y/m/d"  data-timepicker="false"   name="user_birthday" id="user_birthday" value="<?= @$data['member_info']['user_birthday'] ?>"  placeholder="<?=__('生日')?>" autocomplete="off" />
                </div>
            </div>
            <div class="form-group-separator"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_qq"><?=__('签名')?></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="user_sign" id="user_sign" value="<?= @$data['member_info']['user_sign'] ?>"  placeholder="<?=__('签名')?>" autocomplete="off" />
                </div>
            </div>
            <!--jQuery('#datetimepicker7').datetimepicker({
 timepicker:false,
 formatDate:'Y/m/d',
 minDate:'-1970/01/02',//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate:'+1970/01/02'//tomorrow is maximum date calendar
});
    <div class="form-group-separator"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_realname"><?=__('真实姓名')?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_realname" id="user_realname" value="<?= @$data['member_info']['user_realname'] ?>"  placeholder="<?=__('真实姓名')?>" autocomplete="off" data-rule="required;" required />
        </div>
    </div>
    <div class="form-group-separator"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_qq"><?=__('QQ')?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user_qq" id="user_qq" value="<?= @$data['member_info']['user_qq'] ?>"  placeholder="<?=__('QQ')?>" autocomplete="off" />
        </div>
    </div>
    <div class="form-group-separator"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="user_address"><?=__('详细地址')?></label>
        <div class="col-sm-10" style="display: inline-block;">

            <input type="text" class="form-control" data-toggle="city-picker" name="user_address" id="user_address" value="<?= @$data['member_info']['user_address'] ?>"  placeholder="<?=__('详细地址')?>" autocomplete="off" />
        </div>
    </div>
    
    <div class="form-group-separator"></div>
    -->

            <div class="form-group">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <a type="submit"
                       class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                       id="submit-btn">
                        <i class="fa-pencil"></i>
                        <span><?=__('修改')?></span>
                    </a>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>

<?php $this->lazyJs('img-upload') ?>
<?php /*$this->lazyJs('plugins/citypicker/city-picker.data.min', true) */?><!--
--><?php /*$this->lazyJs('plugins/citypicker/city-picker.min', true) */?>
<?php $this->lazyJs('user-account') ?>
<?php
$upgrade_url = urlh('account.php', 'User_Account', 'upgrade', '', 'typ=json');

$str = <<<JS_STRING
    var upgrade_url = "{$upgrade_url}";
    $(function(){
        $(".role-upgrade").click(function(){
            var user_is_sp = $(this).data('role');
            
            if (parseInt(user_is_sp))
            {
                Public.tipMsg('确认升级？', function(){
                    $.ajax({
                        type: "POST",
                        url: upgrade_url,
                        data:{role:'sp'},
                        dataType:'json',
                        async: false,
                        error: function() {
                            alert("<?=__('升级失败')?>！");
                        },
                        success: function(data) {
                            if (data.status == 200)
                            {
                                var result = data.data;
                            }
                            else
                            {
                                alert(data.msg);
                            }
            
                            $.fancybox.close();
                        }
                    });
                });
            }
        });
    });
JS_STRING;
?>
<?php $this->lazyJsString($str) ?>

<script>
    if (window.parent!=window)
    {
        window.parent.location.reload();
    }
    else
    {
    }
</script>









