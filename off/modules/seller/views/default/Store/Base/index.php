<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>

<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>"
        charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>"
        charset="utf-8"></script>

<style type="text/css">
    body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";font-size:14px;}
    #l-map{height:100px;width:100%;display: none;}
    #r-result{width:100%;}
    .tangram-suggestion-main{z-index: 1000}
</style>
<link rel="stylesheet" href="<?=$this->css('plugins/citypicker/css/city-picker', true)?>">
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
        <!--<style type="text/css">
            body {
                background-color: #fff;
                min-width: 200px;
            }
        </style>-->
        <!--表头-->
        <div class="page-title">
            <div class="title-env">
                <h1 class="title"><?= __('店铺运营设置') ?></h1>
                <p class="description"><?= __('店铺运营设置-网站店铺内容基本选项设置') ?></p>
            </div>
        </div>

        <div id="manage-wrap">
            <div class="form-group">
                <div class="tabs-vertical-env">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-shop" data-toggle="tab">店铺设置</a></li>
                            <li><a href="#tab-ppt" data-toggle="tab">幻灯片设置</a></li>
                            <li><a href="#tab-o2o" data-toggle="tab">实体店铺信息</a></li>
                            <!--<li><a href="#tab-shop-thime " data-toggle="tab">店铺主题</a></li>
                            <li><a href="#tab-phone-shop" data-toggle="tab">手机店铺设置</a></li>-->
                        </ul>
                    <div class="tab-content col-xs-12">
                        <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?mdu=seller&ctl=Store_Base&met=edit&typ=json"  data-validator-option="{stopOnError:false, timely:false}">
                            <div class="tab-pane active" id="tab-shop">
                                <div class="wrapper page">
                                    <input type="hidden" class="form-control" name="store_id" id="store_id" value="<?= @$data['store_id'] ?>"  placeholder="<?=__('店铺编号')?>" autocomplete="off" />
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_name"><?=__('店铺名称')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_name" id="store_name"  value="<?= @$data['store_name'] ?>" placeholder="<?=__('店铺名称')?>" autocomplete="off" readonly required />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group-separator"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="product_image"><?=__('店铺logo')?></label>
                                        <div class="col-xs-10">
                                            <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="shop_store_logo" data-target="store_logo">
                                                <input type="hidden" class="form-control" name="store_logo" id="store_logo"
                                                    value="<?= @$data['store_logo'] ?>" placeholder="店铺logo" autocomplete="off"/>
                                                <img id='store_logo_src' src="<?= @$data['store_logo'] ?>"  width="100" height="100" /></a>
                                        </div>
                                    </div>

                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="product_image"><?=__('店铺banner')?></label>
                                        <div class="col-xs-10">
                                            <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="shop_store_banner" data-target="store_banner">
                                                <input type="hidden" class="form-control" name="store_banner" id="store_banner"
                                                    value="<?= @$data['info']['store_banner'] ?>" placeholder="店铺banner" autocomplete="off"/>
                                                <img  id="store_banner_src" src="<?= @$data['info']['store_banner'] ?>"  width="240" height="48"  title="1200*240" data-toggle="tooltip" /></a>
                                        </div>
                                    </div>

                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="store_area"><?=__('店铺所在地')?></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="store_area" id="store_area" value="<?= @$data['store_area'] ?>"  placeholder="<?=__('店铺所在地')?>" autocomplete="off"  data-toggle="city-picker" data-rule="<?=__('店铺所在地')?>:required" required  />
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="store_address"><?=__('详细地址')?></label>
                                        <div class="col-sm-10" style="position: relative;">
                                            <input type="text" class="form-control" name="store_address" id="store_address" value="<?= @$data['store_address'] ?>"  placeholder="<?=__('请输入店铺详细地址')?>" autocomplete="off" data-rule="<?=__('请输入店铺详细地址')?>:required" required />
                                        </div>
                                    </div>


                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_longitude"><?=__('经度')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_longitude" id="store_longitude"  value="<?= @$data['store_longitude'] ?>" placeholder="<?=__('经度')?>" autocomplete="off" data-rule="required;" required />
                                        </div>
                                    </div>


                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_latitude"><?=__('纬度')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_latitude" id="store_latitude"  value="<?= @$data['store_latitude'] ?>" placeholder="<?=__('纬度')?>" autocomplete="off" data-rule="required;" required />
                                        </div>
                                    </div>

                                    
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_tel"><?=__('卖家电话')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_tel" id="store_tel"  value="<?= @$data['info']['store_tel'] ?>" placeholder="<?=__('卖家电话')?>" autocomplete="off" data-rule="required;mobile;" required />
                                        </div>
                                    </div>

                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_qq"><?=__('qq')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_qq" id="store_qq"  placeholder="<?=__('qq')?>" autocomplete="off" value="<?= @$data['info']['store_qq'] ?>"/>

                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_ww"><?=__('旺旺')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_ww" id="store_ww"  placeholder="<?=__('旺旺')?>" autocomplete="off" value="<?= @$data['info']['store_ww'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-ppt">
                                <div class="wrapper page ">
                                    <div class="form-group-separator"></div>
                                    <div class="form-group tab-ppt">
                                        <!--<label class="col-xs-2 control-label" for="store_slide"><?=__('店铺幻灯片')?></label>-->
                                        <div class=" col-xs-offset-1 col-xs-10 col-xs-offset-1">
                                        <div class="row">
                                            <?php for($i =0 ;$i<5;$i++){?>
                                                <dl class="col-xs-2">
                                                    <dt class="col-img">
                                                        <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="shop_store_slide<?php echo $i?>" data-target="store_slide[<?=$i?>][img]">
                                                            <input type="hidden" class="form-control" name="store_slide[<?=$i?>][img]" id="store_slide[<?=$i?>][img]"
                                                                value="<?= @$data['info']['store_slide'][$i]['img'] ?>" placeholder="幻灯片" autocomplete="off"/>
                                                            <img  class="img-responsive" src="<?= @$data['info']['store_slide'][$i]['img']  ?>" id="store_slide<?=$i?>" style="width:130px;height: 60px" />
                                                        </a>
                                                    </dt>

                                                    <dd data = "<?=$i?>url">
                                                        <input type="text" class="input-text form-control url<?=$i?>" name="store_slide[<?=$i?>][url]"  value="<?= @$data['info']['store_slide'][$i]['url'] ?>" id="store_slide[<?=$i?>][url]"  placeholder="<?=__('填写幻灯片链接')?>" autocomplete="off" />
                                                    </dd>

                                                    <br/>

                                                    <dd data = "<?=$i?>name">
                                                        <input type="text" class="input-text form-control name<?=$i?>" name="store_slide[<?=$i?>][name]"  value="<?= @$data['info']['store_slide'][$i]['name'] ?>" id="store_slide[<?=$i?>][name]"  placeholder="<?=__('标题')?>" autocomplete="off" />
                                                    </dd>
                                                    
                                                    <div class="form-group-separator"></div>
                                                </dl>
                                            <?php }?>
                                        </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-o2o">
                                <div class="wrapper page">

                                    <div class="form-group hide">
                                        <label class="col-sm-2 control-label" for="store_o2o_flag"><?=__('是否O2O')?></label>
                                        <div class="col-sm-10">
                                            <input id="store_o2o_flag" name="store_o2o_flag" type="checkbox" value="1"  data-on-text="是" data-off-text="否">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_notice"><?=__('购买须知')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_notice" id="store_notice"  placeholder="<?=__('购买须知')?>" autocomplete="off" value="<?= @$data['info']['store_notice'] ?>"/>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="store_o2o_tags"data-toggle="tooltip"
                                               title="提供服务。">提供服务 </label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" multiple="multiple" id="store_o2o_tags" name="store_o2o_tags[]" style="width:100%;"    data-placeholder="提供服务">
                                                <option value="<?=Store_TypeModel::FREE_PARKING ?>" <?=(in_array(Store_TypeModel::FREE_PARKING, (array)@$data['store_o2o_tags']) ? 'selected' : '')?>>免费停车</option>
                                                <option value="<?=Store_TypeModel::FREE_WIFI ?>" <?=(in_array(Store_TypeModel::FREE_WIFI, (array)@$data['store_o2o_tags']) ? 'selected' : '')?>>免费wifi</option>
                                                <option value="<?=Store_TypeModel::FREE_DELIVERY ?>" <?=(in_array(Store_TypeModel::FREE_DELIVERY, (array)@$data['store_o2o_tags']) ? 'selected' : '')?>>免费送货</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_opening_hours"><?=__('营业时间')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control timepicker"  data-template="dropdown" data-show-seconds="false" data-default-time="9:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"      name="store_opening_hours" id="store_opening_hours"  placeholder="<?=__('营业时间')?>" autocomplete="off" value="<?= @$data['info']['store_opening_hours'] ?>"/>

                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_close_hours"><?=__('打烊时间')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control timepicker"  data-template="dropdown" data-show-seconds="false" data-default-time="18:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"   name="store_close_hours" id="store_close_hours"  placeholder="<?=__('打烊时间')?>" autocomplete="off" value="<?= @$data['info']['store_close_hours'] ?>"/>

                                        </div>
                                    </div>


                                    <div class="form-group-separator"></div>
                                    <div class="form-group">
                                        <label class="col-xs-2 control-label" for="store_circle"><?=__('所属商圈')?></label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" name="store_circle" id="store_circle"  placeholder="<?=__('所属商圈')?>" autocomplete="off" value="<?= @$data['info']['store_circle'] ?>"/>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="tab-shop-thime">

                            </div>
                            <div class="tab-pane" id="tab-phone-shop">

                            </div>

                            <!--<div class="form-group-separator"></div>-->
                            <div class="form-group">
                                <a type="submit" class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone" id="submit-btn">
                                    <i class="fa-pencil"></i>
                                    <span>修改</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="manage-edit-box">

                <div class="box-main">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function(){
        $("input[checked]").click();
        console.info()
    })()
//    function urlshow(obj){
//        var $data = $(obj).attr("data-click");
//        $("[data="+$data+"]").show();
//        $("[data="+$data.slice(0,1)+"id]").hide();
//    }

    $('.select2').on('select2:select', function (e) {
        var index = e.currentTarget.dataset.index;
        $('#store_slide' + index).attr('src', e.params.data.product_image);
        $("[name='store_slide[" + index + '][img]').val(e.params.data.product_image);
    });


    $('input').on('focus', function () {
        var that = $(this);
        /*if (!that.data('loaded')) {
            that.val('');
            that.data('loaded', true);
        }*/
    });

    function itemshow(obj){
        var $data = $(obj).attr("data-click");
        $("[data="+$data+"]").show();
        $("[data="+$data.slice(0,1)+"url]").hide();
    }


    $('#store_o2o_flag').bootstrapSwitch('state', <?= intval($data['store_o2o_flag']) ?>);

</script>

<link rel="stylesheet" href="<?=$this->css('plugins/zTree/css/zTreeStyle/zTreeStyle', true)?>">
<script src="<?=$this->js('plugins/zTree/js/jquery.ztree.all-3.5', true)?>"></script>

<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>

<script type="text/javascript" src="<?= $this->js('img-upload')?>"></script>



<script src="<?=$this->js('plugins/citypicker/js/city-picker.data', true)?>"></script>
<script src="<?=$this->js('plugins/citypicker/js/city-picker', true)?>"></script>

<div id="l-map" style="margin-bottom: 20px;"></div>

<script type="text/javascript">
    window.addressStr = '';
    window.coordinate = null;

    function initialize()
    {
        var store_address = $('#store_address').val();
        //$('#district_info').attr('placeholder', __('正在定位中，请稍后...'));

        // 百度地图API功能
        var geolocation = new BMap.Geolocation();
        var geoc = new BMap.Geocoder();

        var map = new BMap.Map("l-map");

        var name = $('#store_area').val();
        var name_row = name.split('/');

        map.centerAndZoom(name_row[0], 12);                   // 初始化地图,设置城市和地图级别。

        //alert(window.addressStr);
        //map.centerAndZoom(addComp.province, 12);                   // 初始化地图,设置城市和地图级别。

        $('#store_area').on("cp:updated", function () {
            var code = $(this).data('citypicker').getCode();
            $('#chain_district_id').val(code);

            var name = $(this).data('citypicker').getVal();
            var name_row = name.split('/');

            map.centerAndZoom(name_row[0], 12);                   // 初始化地图,设置城市和地图级别。
        });

        // 百度地图API功能
        function G(id) {
            return document.getElementById(id);
        }


        var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {"input" : "store_address"
                ,"location" : map
            });

        ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
            var str = "";
            var _value = e.fromitem.value;
            var value = "";
            if (e.fromitem.index > -1) {
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            //G("searchResultPanel").innerHTML = str;
        });

        var myValue;
        ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
            var _value = e.item.value;
            myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;

            //G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

            setPlace();
        });

        function setPlace(){
            map.clearOverlays();    //清除地图上所有覆盖物

            function myFun(){
                var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
                console.info(pp)
                map.centerAndZoom(pp, 18);
                map.addOverlay(new BMap.Marker(pp));    //添加标注

                $('#store_latitude').val(local.getResults().getPoi(0).point.lat);
                $('#store_longitude').val(local.getResults().getPoi(0).point.lng);
            }

            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });

            local.search(myValue);
        }


        setTimeout(function () {
            $('#store_address').val(store_address);

            var pp = new BMap.Point($('#store_latitude').val(), $('#store_longitude').val())

            map.centerAndZoom(pp, 18);
            map.addOverlay(new BMap.Marker(pp));    //添加标注

        }, 1000);


        /*
         geolocation.getCurrentPosition(function (r) {
         if (this.getStatus() == BMAP_STATUS_SUCCESS)
         {
         var mk = new BMap.Marker(r.point);
         //alert('您的位置：'+r.point.lng+','+r.point.lat);

         window.coordinate = {'lng': r.point.lng, lat: r.point.lat};

         console.info(window.coordinate);

         geoc.getLocation(r.point, function (rs) {
         var addComp = rs.addressComponents;
         window.addressStr = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
         console.info(addComp);
         console.info(window.addressStr);

         var district_info_row = [];
         district_info_row.push(addComp.province)
         district_info_row.push(addComp.city)
         district_info_row.push(addComp.district)

         //var district_info = addComp.province + " " + addComp.city + " " + addComp.district;
         var district_info = district_info_row.join(" ");

         //$('#district_info').val(district_info);

         //alert(window.addressStr);
         map.centerAndZoom(addComp.province, 12);                   // 初始化地图,设置城市和地图级别。


         $('#store_area').on("cp:updated", function () {
         var name = $(this).data('citypicker').getVal();
         var name_row = name.split('/');

         map.centerAndZoom(name_row[0], 12);                   // 初始化地图,设置城市和地图级别。
         });



         // 百度地图API功能
         function G(id) {
         return document.getElementById(id);
         }


         var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
         {"input" : "store_address"
         ,"location" : map
         });

         ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
         var str = "";
         var _value = e.fromitem.value;
         var value = "";
         if (e.fromitem.index > -1) {
         value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
         }
         str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

         value = "";
         if (e.toitem.index > -1) {
         _value = e.toitem.value;
         value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
         }
         str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
         //G("searchResultPanel").innerHTML = str;
         });

         var myValue;
         ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
         var _value = e.item.value;
         myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;

         //G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

         setPlace();
         });

         function setPlace(){
         map.clearOverlays();    //清除地图上所有覆盖物

         function myFun(){
         var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
         map.centerAndZoom(pp, 18);
         map.addOverlay(new BMap.Marker(pp));    //添加标注

         alert(local.getResults().getPoi(0).point.lat)
         $('#store_latitude').val(local.getResults().getPoi(0).point.lat);
         $('#store_longitude').val(local.getResults().getPoi(0).point.lng);
         }

         var local = new BMap.LocalSearch(map, { //智能搜索
         onSearchComplete: myFun
         });

         local.search(myValue);
         }
         });

         }
         else
         {
         $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));

         }
         }, {enableHighAccuracy: true})
         */

        //关于状态码
        //BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
        //BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
        //BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
        //BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
        //BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
        //BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
        //BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
        //BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
        //BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)

    }

    function loadScript()
    {
        var script = document.createElement("script");
        script.src = "//api.map.baidu.com/api?v=2.0&ak=Yi9XWlwa7sUGSuKGDiPBrS261bMeu6YF&callback=initialize";//此为v2.0版本的引用方式
        // //api.map.baidu.com/api?v=1.4&ak=您的密钥&callback=initialize"; //此为v1.4版本及以前版本的引用方式
        document.body.appendChild(script);
    }

    window.onload = loadScript;


</script>


