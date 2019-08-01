<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>

<div id="manage-wrap">
    <div class="page-container">
        <div class="main-content">
            <div class="box-content-container">
                <!--<div class="box-main">-->
                <fieldset>

                    <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                        <div class="form-group">
                            <input type="hidden" class="input-text form-control" name="rights_group_id" id="rights_group_id"  placeholder="<?=__('权限组id')?>" autocomplete="off" />
                            <div class="row mt20 mb20">
                                <legend class="col-sm-12">
                                    <div class="row mb5 mt20">
                                        <div class="col-sm-4 ">
                                            <?=__('权限组名称')?>
                                        </div>
                                    </div>
                                </legend>
                                <div class="col-sm-12">
                                    <div class="col-sm-10 wrapper">
                                        <input readonly type="text" class="input-text form-control" name="rights_group_name" id="rights_group_name"  placeholder="<?=__('权限组名称')?>" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <?php
                            foreach($data['base'] as $key => $val){ ?>
                            <div class="form-group">
                                <div class="row mb20">
                                    <legend class="col-sm-12">
                                        <div class="row mt20 mb5">
                                            <div class="col-sm-4">
                                                <div>
                                                    <input type="checkbox" name="" value="" id="" class="select_all" data-type="<?php echo $key ?>" >
                                                    <?php if(!empty($val['rights_name']))echo $val['rights_name'];?>
                                                </div>
                                            </div>
                                            <!--<div class="col-sm-8 text-right">
                                                <label class="f14">
                                                    <span>全选</span>
                                                </label>
                                            </div>-->
                                        </div>
                                    </legend>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12 vertical-middle-sm">
                                                <div class="row">
                                                    <?php if(!empty($val['son'])){
                                                        foreach($val['son'] as $skey => $sval){
                                                            ?>
                                                            <label class="col-sm-2">
                                                                <input class="vp" type="checkbox" data="<?php echo $key ?>" name="rights_group_rights_ids[<?php echo $sval['id']?>]" value="<?php echo $sval['id'] ?>"  <?php if(in_array($sval['id'],$data['group']))echo 'checked';?>>
                                                                <?php echo $sval['rights_name'] ?>
                                                            </label>
                                                        <?php }}else{ ?>
                                                        <label class="col-sm-2">
                                                            <input class="vp" type="checkbox" data="<?php echo $key ?>" name="rights_group_right_ids[<?php echo $val['id']?>]" value="<?php echo $val['id'] ?>"  <?php if(in_array($val['id'],$data['group']))echo 'checked';?>>
                                                            <span><?php echo $val['rights_name'] ?></span>
                                                        </label>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                    </form>
                    <!--</div>-->
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store/store_employee_rights_group')?>"></script>