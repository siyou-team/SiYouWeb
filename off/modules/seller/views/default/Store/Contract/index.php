<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/multiselect/css/multi-select', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-new', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-bootstrap', true)?>">

<div class="page-container">
    <div class="main-content">

    <?php
//        echo '<pre>';
//        print_r($data);
    ?>

        <div class="row">
            <?php foreach($data['items'] as $key=>$item){ ?>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"><?=@$item['contract_type_name']?></div>
                    </div>
                    <div class="panel-body">

                        <?php if($item['contract_id']){?>
                        <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?&ctl=Store_Contract&met=edit&typ=json" ">
                            <input type="hidden" name="contract_id" value="<?=$item['contract_id']?>">
                            <input type="hidden" name="contract_type_id" value="2">

                            <input type="hidden" name="store_name" value="<?=$item['store_name']?>">
                            <input type="hidden" name="contract_use_state" value="<?php echo $item['contract_use_state']==1?2:1;?>">
                            <input type="hidden" name="contract_despoit" value="<?=$item['contract_despoit']?>">

                        <?php }else{?>
                        <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?&ctl=Store_Contract&met=add&typ=json" ">
                            <input type="hidden" name="contract_use_state" value="1">

                        <?php }?>
                            <input type="hidden" name="contract_type_name" value="<?=$item['contract_type_name']?>">
                            <input type="hidden" name="contract_type_id" value="<?=@$item['contract_type_id']?>">
                            <input type="hidden" name="contract_state" value="9">
                            <input type="hidden" name="store_id" value="<?=$item['store_id']?>">

                            <div class="form-group">
                                <div class="">
                                    <img src="<?=@$item['contract_type_icon'] ?>" alt="">

                                </div>
                            </div>
                            <div class="form-group-separator"></div>

                            <div class="form-group">
                                <div class="">
                                    <?=$item['contract_type_text'] ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <a type="submit"
                                   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                   id="submit-btn">
                                    <i class="fa-pencil"></i>
                                    <span><?php echo $item['contract_use_state']==1?'退出':'加入';?></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
<script type="text/javascript" src="<?=$this->js('plugins/tagsinput/bootstrap-tagsinput.min', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>" charset="utf-8"></script>


