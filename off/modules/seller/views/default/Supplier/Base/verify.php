<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">

            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal">
                <input type="hidden" class="form-control" name="shop_distributor_id" id="shop_distributor_id" value="<?= @$data['shop_distributor_id'] ?>"  placeholder="分销商" autocomplete="off" />

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="distributor_enable">审核状态</label>
                    <div class="col-sm-10">
                        <select class="select2 form-control" id="distributor_enable" name="distributor_enable">
                            <option value="0">选择审核状态</option>
                            <option value="-1">等待审核</option>
                            <option value="1">审核通过</option>
                            <option value="-1">审核失败</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="store_distributor_reason">产品SPU</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="store_distributor_reason" id="store_distributor_reason" placeholder="审核理由"></textarea>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/supplier/supplier_index')?>"></script>
<script>
    distributor_enable = 0;
    $(document).on('change', "#distributor_enable", function () {
       distributor_enable = $(this).children('option:selected').val();
    });
</script>