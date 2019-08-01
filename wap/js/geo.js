
    window.addressStr = '';
    window.coordinate = null;

    function initialize()
    {
        if (!SYS.O2O_ENABLE || $("#district_info").val())
        {
            return;
        }

        $('#district_info').attr('placeholder', __('正在定位中，请稍后...'));

        // 百度地图API功能
        var geolocation = new BMap.Geolocation();
        var geoc = new BMap.Geocoder();

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


                    $.request({
                        url: SYS.URL.district_id,
                        type: 'get',
                        data: {district_name_row: district_info_row},
                        dataType: 'json',
                        success: function (result) {
                            if (result.status == 200)
                            {
                                $("#district_info").val(district_info).attr({
                                    "data-areaid": result.data[0],
                                    "data-areaid1": result.data[1],
                                    "data-areaid2": result.data[2]
                                }).trigger('change');
                            }
                            else
                            {
                                $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));
                            }
                        }
                    });

                    //$('#district_info').val(district_info);

                    //alert(window.addressStr);
                });

            }
            else
            {
                //alert('failed'+this.getStatus());

                $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));

                /*
                 function myFun(result){
                 var cityName = result.name;
                 map.setCenter(cityName);
                 alert("当前定位城市:"+cityName);
                 }
                 var myCity = new BMap.LocalCity();
                 myCity.get(myFun);
                 */
            }
        }, {enableHighAccuracy: true})

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
        script.src = "//api.map.baidu.com/api?v=3.0&ak=Yi9XWlwa7sUGSuKGDiPBrS261bMeu6YF&callback=initialize";//此为v2.0版本的引用方式
        // //api.map.baidu.com/api?v=1.4&ak=您的密钥&callback=initialize"; //此为v1.4版本及以前版本的引用方式
        document.body.appendChild(script);
    }

    window.onload = loadScript;