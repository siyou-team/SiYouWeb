<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">

            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal">
                <input type="hidden" class="form-control" name="store_distributor_id" id="store_distributor_id" value="<?= @$data['store_distributor_id'] ?>"  placeholder="产品SPU-定为SPU编号" autocomplete="off" />


                <span id="distributor_level_id"></span>

            </form>
        </div>
    </div>
</div>
<script>
    distributor_level_id = 0;
</script>
<script src="<?=$this->js('modules/seller/supplier/supplier_index')?>"></script>