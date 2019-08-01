<?php
$category_rows = array();

$brand_category_rows = array();
foreach ($data['brand_rows'] as $brand_id=>$brand_row)
{
    $brand_category_rows[$brand_row['category_id']][] = $brand_row;
}
ksort($brand_category_rows);

$category_rows = $data['category_rows'];

$category_rows[0]['category_name'] = __('未分类');

?>
<style type="text/css">
	body {
		background-color: #fff;
		min-width: 200px;
		min-height: 200px;
	}
</style>
<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<script src="<?=$this->js('plugins/icheck/icheck.min', true)?>"></script>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content" style="padding-top: 10px;">
        <div class="row">
			<form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal"   style="background-color: #fff;padding: 30px;">
            <?php
            foreach ($brand_category_rows as $category_id=>$brand_rows)
            {
            ?>
            <div class="form-group">
                <label class="col-sm-2"><?=$category_rows[$category_id]['category_name']?></label>
                <div class="col-sm-10">
            <?php
                foreach ($brand_rows as $brand_row)
                {
           ?>
                    <input type="checkbox" class="icheck" id="brand_<?=$brand_row['brand_id']?>"  name="brand_id" value="<?=$brand_row['brand_id']?>" data-text="<?=$brand_row['brand_name']?>">
                    <label for="brand_<?=$brand_row['brand_id']?>"><?=$brand_row['brand_name']?></label> &nbsp;&nbsp;
            <?php
                }
            ?>
                </div>
            </div>

			<div class="form-group-separator"></div>

            <?php
            }
            ?>
			</form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        // Styles
        $('input.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-yellow'
        });
    });

    function callback()
    {
        var ids = "";
        var str = "";
        var dot = "";
        $("input[type='checkbox']:checked").each(function(){
                ids +=  dot + $(this).val();
                str +=  dot + $(this).data('text');
                dot = ",";
        })

        api.data.callback(ids, str);
    }

    var api = frameElement.api,  brand_ids = api.data.brand_ids;

    var brand_id_row = brand_ids.split(",");

    $.each(brand_id_row, function(index, id){
        $('#brand_' + id).attr('checked', true);
    });
</script>