<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="spec_item_id" id="spec_item_id"  placeholder="<?=__('商品规格值Id')?>" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="spec_id" id="spec_id"  placeholder="<?=__('商品规格值Id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="spec_item_name"><?=__('规格值名称')?></label>
                    <input type="text" class="input-text form-control" name="spec_item_name" id="spec_item_name"  placeholder="<?=__('规格值名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="spec_item_order"><?=__('排序')?></label>
                    <input type="text" class="input-text form-control" name="spec_item_order" id="spec_item_order"  placeholder="<?=__('排序,数字越小越靠前')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        var $grid = $("#grid");
        var $form = $("#manage-form");
        
        var $handle = $.extend(handle, {

            initField: function(rowData) {

                $('#spec_item_id').val(rowData.spec_item_id);
                $('#store_id').val(rowData.store_id);
                $('#category_id').val(rowData.category_id);
                $('#spec_id').val(rowData.spec_id);
                $('#spec_item_name').val(rowData.spec_item_name);
                $('#spec_item_order').val(rowData.spec_item_order);

                //$('#' + this.$priKey).attr("readonly", "readonly");
                //$('#' + this.$priKey).addClass('ui-input-dis');
                this.initState();
                return this;
            },

            resetForm: function(t) {
                $('#spec_item_id').val('');
                $('#store_id').val('');
                $('#category_id').val('');
                $('#spec_id').val('');
                $('#spec_item_name').val('');
                $('#spec_item_order').val('');

                this.initState();

                return this;
            }
        });

        $handle.init($grid, $form, 'spec_item_id', 'Product_SpecItem', 'seller');
        if (frameElement && frameElement.api) {
            //var curRow, curCol, curArrears;
            var api = frameElement.api;

            $handle.initPopBtns(api, {
                fields: {},
            });

            $handle.initField(api.data.rowData || {}).initState();
        }
    });
</script>