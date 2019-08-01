<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>

<link rel="stylesheet" href="<?=$this->css('area')?>">
<script type="text/javascript" src="<?=$this->js('plugins/citypicker/jquery.areaSelection', true)?>"></script>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main row">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="transport_item_id" id="transport_item_id"  placeholder="<?=__('ID')?>" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="transport_city_ids" id="transport_city_ids"  placeholder="" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="transport_item_city_ids" id="transport_item_city_ids"  placeholder="" autocomplete="off" />
                <input type="hidden" name="all_ids" id="all_ids">

                <?php if(@i('transport_type_id')):?>
                 <input type="hidden" name="transport_type_id" value="<?=i('transport_type_id')?>">
                <?php endif;?>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="transport_item_default_num"><?=__('默认数量')?></label>
                    <input type="text" class="input-text form-control" name="transport_item_default_num" id="transport_item_default_num"  placeholder="<?=__('默认数量')?>" autocomplete="off" />
                </div>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="transport_item_default_price"><?=__('默认运费')?></label>
                    <input type="text" class="input-text form-control" name="transport_item_default_price" id="transport_item_default_price"  placeholder="<?=__('默认运费')?>" autocomplete="off" />
                </div>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="transport_item_add_num"><?=__('增加数量')?></label>
                    <input type="text" class="input-text form-control" name="transport_item_add_num" id="transport_item_add_num"  placeholder="<?=__('增加数量')?>" autocomplete="off" />
                </div>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="transport_item_add_price"><?=__('增加运费')?></label>
                    <input type="text" class="input-text form-control" name="transport_item_add_price" id="transport_item_add_price"  placeholder="<?=__('增加运费')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store_transport_item')?>"></script>
<script>
    $('#city-picker').click(function(){

        var obj = $(this);

        var city_ids_tmp = $('#transport_city_ids').val();
        var city_ids = city_ids_tmp.substring(0, city_ids_tmp.length-1);
        var transport = city_ids.split('|');

        var areaid = [];

        for(var z=0; z<transport.length; z++)
        {
            areaid[z] = transport[z].split(',');
        }

        var a = [
            ["110000","110100","0"],["130000","130100","0"]
        ];

        var option = {
            allareaid:a,

            areaid:areaid,

            isScroll:true,					//是否阻止滚动
            fnYesBack:function(data){

                var transport_city_ids = '';
                var transport_item_city_ids = '';
                var transport_item_city_name = '';

                for(var i=0;i<data.id.length;i++)
                {
                    transport_city_ids += data.id[i];
                    transport_city_ids += '|';
                    transport_item_city_ids += data.id[i][1];
                    transport_item_city_ids += ',';
                }

                $('#transport_city_ids').val(transport_city_ids);

                $('#transport_item_city_ids').val(transport_item_city_ids);

                for (var j=0; j<data.NameinJson.length; j++)
                {
                    var name = data.NameinJson[j].citys;
                    for(var k=0; k<name.length; k++)
                    {
                        transport_item_city_name += name[k];
                        transport_item_city_name += ',';
                    }
                }

                $('#transport_item_city_name').val(transport_item_city_name);

            }			//回调函数
        };
        obj.areaSelection(option);

    });

</script>