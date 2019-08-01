<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('plugins/citypicker/css/city-picker', true)?>">
<style type="text/css">
    body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";font-size:14px;}
    #l-map{height:300px;width:100%;}
    #r-result{width:100%;}
</style>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main row">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="chain_id" id="chain_id"  placeholder="<?=__('门店Id')?>" autocomplete="off" />

                <div id="l-map" style="margin-bottom: 20px;"></div>

                <div class="table-type" style="margin-left: -10px;">
                    管理员信息
                </div>

                <div class="row">
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="user_nickname"><?=__('门店管理员账号')?></label>
                        <input type="text" class="input-text form-control" name="user_nickname" id="user_nickname"  placeholder="<?=__('门店管理员账号')?>" autocomplete="off" />
                    </div>

                    <div class="form-section col-sm-6">
                        <label class="input-label" for="user_password"><?=__('门店管理员密码')?></label>
                        <input type="text" class="input-text form-control" name="user_password" id="user_password"  placeholder="<?=__('门店管理员密码')?>" autocomplete="off" />
                    </div>
                </div>


                <div class="table-type" style="margin-left: -10px;">
                    门店信息
                </div>


                <div class="row">
                    <div class="form-section col-sm-6">
                        <input type="text" class="input-text form-control" name="chain_district_info" id="chain_district_info" value=""  placeholder="公司所在地" autocomplete="off"  data-toggle="city-picker" data-rule="所在地区:required" required readonly style="width: 100%"  />
                        <input type="text" class="input-text form-control hide" name="chain_district_id" id="chain_district_id" value=""  />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_address"><?=__('实体店铺详细地址')?></label>
                        <input type="text" class="input-text form-control" name="chain_address" id="chain_address"  placeholder="<?=__('实体店铺详细地址')?>" autocomplete="off" />
                    </div>

                    <div class="form-section col-sm-6 hide">
                        <select class="input_txt form-inline title-form form-control select2" id="chain_admin_id" name="chain_admin_id" placeholder="请输入门店管理账号昵称" >
                        </select>
                    </div>


                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_name"><?=__('门店名称')?></label>
                        <input type="text" class="input-text form-control" name="chain_name" id="chain_name"  placeholder="<?=__('门店名称')?>" autocomplete="off" />
                    </div>
                    <div class="form-section hide">
                        <label class="input-label" for="chain_mobile"><?=__('手机号码')?></label>
                        <input type="text" class="input-text form-control" name="chain_mobile" id="chain_mobile"  placeholder="<?=__('手机号码')?>" autocomplete="off" />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_telephone"><?=__('联系电话')?></label>
                        <input type="text" class="input-text form-control" name="chain_telephone" id="chain_telephone"  placeholder="<?=__('联系电话')?>" autocomplete="off" />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_contacter"><?=__('联系人')?></label>
                        <input type="text" class="input-text form-control" name="chain_contacter" id="chain_contacter"  placeholder="<?=__('联系人')?>" autocomplete="off" />
                    </div>
                    <div class="form-section  col-sm-6">
                        <label class="input-label" for="chain_lng"><?=__('经度')?></label>
                        <input type="text" class="input-text form-control" name="chain_lng" id="chain_lng" value="0" placeholder="<?=__('经度')?>" autocomplete="off" readonly />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_lat"><?=__('纬度')?></label>
                        <input type="text" class="input-text form-control" name="chain_lat" id="chain_lat"  value="0"  placeholder="<?=__('纬度')?>" autocomplete="off" readonly />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_opening_hours"><?=__('营业时间')?></label>
                        <input type="text" class="input-text form-control timepicker"  data-template="dropdown" data-show-seconds="false" data-default-time="9:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"   name="chain_opening_hours"  value="9:00"  id="chain_opening_hours"  placeholder="<?=__('营业时间')?>" autocomplete="off" />
                    </div>
                    <div class="form-section col-sm-6">
                        <label class="input-label" for="chain_close_hours"><?=__( '关闭时间')?></label>
                        <input type="text" class="input-text form-control  timepicker"  data-template="dropdown" data-show-seconds="false" data-default-time="18:00" data-show-meridian="false" data-minute-step="5" data-second-step="5"  name="chain_close_hours"  value="18:00" id="chain_close_hours"  placeholder="<?=__('营业时间')?>" autocomplete="off" />
                    </div>
                    <div class="form-section hide">
                        <label class="input-label" for="chain_traffic_line"><?=__('交通路线')?></label>
                        <input type="text" class="input-text form-control" name="chain_traffic_line" id="chain_traffic_line"  placeholder="<?=__('交通路线')?>" autocomplete="off" />
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="chain_img">门店图片</label>
                        <div class="inline">
                            <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_replace_id" data-target="chain_img">
                                <input type="hidden" class="form-control" name="chain_img" id="chain_img" value="" placeholder="门店图片" autocomplete="off"/>
                                <img  data-placeholder="" width="100" height="100" data-toggle="tooltip" /></a>
                        </div>
                        <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?= $this->js('modules/seller/chain/chain_base') ?>"></script>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>



<script src="<?=$this->js('plugins/citypicker/js/city-picker.data', true)?>"></script>
<script src="<?=$this->js('plugins/citypicker/js/city-picker', true)?>"></script>

<script type="text/javascript">


    window.addressStr = '';
    window.coordinate = null;

    function initialize()
    {
        var chain_address = $('#chain_address').val();
        //$('#district_info').attr('placeholder', __('正在定位中，请稍后...'));

        // 百度地图API功能
        var geolocation = new BMap.Geolocation();
        var geoc = new BMap.Geocoder();

        var map = new BMap.Map("l-map");

        var name = $('#chain_district_info').val();
        var name_row = name.split('/');

        map.centerAndZoom(name_row[0], 12);                   // 初始化地图,设置城市和地图级别。
        
        //alert(window.addressStr);
        //map.centerAndZoom(addComp.province, 12);                   // 初始化地图,设置城市和地图级别。

        $('#chain_district_info').on("cp:updated", function () {
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
            {"input" : "chain_address"
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

                $('#chain_lat').val(local.getResults().getPoi(0).point.lat);
                $('#chain_lng').val(local.getResults().getPoi(0).point.lng);
            }

            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });

            local.search(myValue);
        }

        
        setTimeout(function () {
            $('#chain_address').val(chain_address);

            var pp = new BMap.Point($('#chain_lat').val(), $('#chain_lng').val())
            
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


                    $('#chain_district_info').on("cp:updated", function () {
                        var name = $(this).data('citypicker').getVal();
                        var name_row = name.split('/');

                        map.centerAndZoom(name_row[0], 12);                   // 初始化地图,设置城市和地图级别。
                    });

                    

                    // 百度地图API功能
                    function G(id) {
                        return document.getElementById(id);
                    }


                    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
                        {"input" : "chain_address"
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
                           $('#chain_lat').val(local.getResults().getPoi(0).point.lat);
                           $('#chain_lng').val(local.getResults().getPoi(0).point.lng);
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


