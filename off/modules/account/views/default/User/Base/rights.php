<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<script src="<?=$this->js('plugins/icheck/icheck.min', true)?>"></script>
<div id="manage-wrap">
    <div class="page-container">
        <div class="main-content">
            <div class="box-content-container">
                <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <div class="form-group">
                        <?php
                        foreach($data['base'] as $key => $val){ ?>
                        <div class="col-sm-12" style="margin-top: 10px;">
                            <input type="checkbox" class="icheck"  name="rights_group_id[]" id="rights_group_id_<?= $val['id'] ?>"  value="<?=$val['rights_group_id']?>"  data-text="<?=$val['rights_group_id']?>"  >&nbsp;<?=$val['rights_group_name']?>&nbsp;&nbsp;
                         </div>
                        <?php }?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=$this->js('modules/account/user/rights')?>" charset="utf-8"></script>

<script type="text/javascript">
    var rightsGroupIds = new Array();

    $(function() {
        // Styles
        $('input.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-yellow'
        });


        $("input.icheck").on('ifChanged', function ()
        {
            rightsGroupIds = new Array();
            $("input[type='checkbox']:checked").each(function () {
                $(this).is(':checked') && rightsGroupIds.push($(this).data('text'));

            });
        })
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

    var api = frameElement.api,  brand_ids = api.data.group_rights_id  + '';

    var brand_id_row = brand_ids.split(",");

    $.each(brand_id_row, function(index, id){
        $('#rights_group_id_' + id).attr('checked', true);
    });

</script>
