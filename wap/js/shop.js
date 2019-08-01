/**
 * all shop qianyistore v4.2
 */

template.helper("distance", function (distance) {
    return Math.round(distance/1000).toFixed(2);
});

//GEO
window.addressStr = '';
window.coordinate = null;

function initialize()
{
    $('#district_info').attr('placeholder', __('正在定位中，请稍后...'));
    if( navigator.geolocation ){
        navigator.geolocation.getCurrentPosition( codeAddress );
    }  else {

        $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));

    }

    function codeAddress( position ) {
        console.log( position );
        var geocoder = new google.maps.Geocoder();
        var latlng   = new google.maps.LatLng(-34.397, 150.644);
        //var latlng   = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var region   = getCookie('lang') ? getCookie('lang') : 'zh-CN';
        window.coordinate = {'lng': position.coords.latitude, lat: position.coords.longitude};
        console.log( latlng.lat );
        geocoder.geocode( { 'location':latlng}, function(result
            , status) {
            console.log( result );
            if (status == 'OK') {

                //返回的是一系列地址数组 最精确的排在最前面
                var address_row = result;
                var address_components = address_row[0] ? address_row[0].address_components : [];

                var district_info_row = [];
                var country,
                    province,
                    city,
                    area,
                    street,
                    street_number;
                for( var i = 0; i < address_components.length; i++ ){

                    //可能不太准确
                    switch(address_components[i]['types'][0]){
                        case 'country':
                            country  = address_components[i].long_name;
                            break;
                        case 'administrative_area_level_1':
                            province = address_components[i].long_name
                            break;
                        case 'locality':
                        case 'administrative_area_level_2':
                            city = address_components[i].long_name
                            break;
                        case 'political':
                        case 'administrative_area_level_3':
                            area = address_components[i].long_name
                            break;
                        case 'route':
                            street = address_components[i].long_name
                            break;
                        case 'street_number':
                            street_number = address_components[i].long_name
                            break;
                    }
                }
                window.addressStr = province + ", " + city + ", " + area + ", " + street + ", " + street_number;

                province && district_info_row.push(province);
                city     && district_info_row.push(city);
                area     && district_info_row.push(area);
                street   && district_info_row.push(street);
                console.log( district_info_row );
                district_info = district_info_row.join('');
                $('#district_info').val(district_info);


                // mapholder=document.getElementById('mapholder')
                // mapholder.style.height='250px';
                // mapholder.style.width='500px';

                // var myOptions={
                //     center:latlon,zoom:14,
                //     mapTypeId:google.maps.MapTypeId.ROADMAP,
                //     mapTypeControl:false,
                //     navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
                // };
                // var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
                // var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});

            } else {
                $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));
            }
        });
    }
}




function loadScript()
{
    var script = document.createElement("script");
    script.type = "text/javascript";

    //We think security on the web is pretty important, and recommend using HTTPS whenever possible. As part of our efforts to make the web more secure, we've made all of the Maps JavaScript API available over HTTPS. Using HTTPS encryption makes your site more secure, and more resistant to snooping or tampering.
    // script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyByJmxYEcAPAiWfP-CDK8O5Rh2P1-otSiQ&sensor=false&callback=initialize";

    //for users in China.
    script.src = "https://maps.google.cn/maps/api/js?key=AIzaSyByJmxYEcAPAiWfP-CDK8O5Rh2P1-otSiQ&sensor=false&callback=initialize";
    document.body.appendChild(script);
}



// function initialize()
// {
//     $('#district_info').attr('placeholder', __('正在定位中，请稍后...'));

//     // 百度地图API功能
//     var geolocation = new BMap.Geolocation();
//     var geoc = new BMap.Geocoder();

//     geolocation.getCurrentPosition(function (r) {
//         if (this.getStatus() == BMAP_STATUS_SUCCESS)
//         {
//             var mk = new BMap.Marker(r.point);
//             //alert('您的位置：'+r.point.lng+','+r.point.lat);

//             window.coordinate = {'lng': r.point.lng, lat: r.point.lat};

//             console.info(window.coordinate);

//             geoc.getLocation(r.point, function (rs) {
//                 var addComp = rs.addressComponents;
//                 window.addressStr = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
//                 console.info(addComp);
//                 console.info(window.addressStr);

//                 var district_info_row = [];
//                 district_info_row.push(addComp.province)
//                 district_info_row.push(addComp.city)
//                 district_info_row.push(addComp.district)

//                 //var district_info = addComp.province + " " + addComp.city + " " + addComp.district;
//                 var district_info = district_info_row.join(" ");


//                 $.request({
//                     url: SYS.URL.district_id,
//                     type: 'get',
//                     data: {district_name_row: district_info_row},
//                     dataType: 'json',
//                     success: function (result) {
//                         if (result.status == 200)
//                         {
//                             $("#district_info").val(district_info).attr({
//                                 "data-areaid": result.data[0],
//                                 "data-areaid1": result.data[1],
//                                 "data-areaid2": result.data[2]
//                             }).trigger('change');
//                         }
//                         else
//                         {
//                             $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));
//                         }
//                     }
//                 });

//                 //$('#district_info').val(district_info);

//                 //alert(window.addressStr);
//             });

//         }
//         else
//         {
//             //alert('failed'+this.getStatus());

//             $('#district_info').attr('placeholder', __('未获取到定位城市，请手动选择'));

//             /*
//              function myFun(result){
//              var cityName = result.name;
//              map.setCenter(cityName);
//              alert("当前定位城市:"+cityName);
//              }
//              var myCity = new BMap.LocalCity();
//              myCity.get(myFun);
//              */
//         }
//     }, {enableHighAccuracy: true})

//     //关于状态码
//     //BMAP_STATUS_SUCCESS   检索成功。对应数值“0”。
//     //BMAP_STATUS_CITY_LIST 城市列表。对应数值“1”。
//     //BMAP_STATUS_UNKNOWN_LOCATION  位置结果未知。对应数值“2”。
//     //BMAP_STATUS_UNKNOWN_ROUTE 导航结果未知。对应数值“3”。
//     //BMAP_STATUS_INVALID_KEY   非法密钥。对应数值“4”。
//     //BMAP_STATUS_INVALID_REQUEST   非法请求。对应数值“5”。
//     //BMAP_STATUS_PERMISSION_DENIED 没有权限。对应数值“6”。(自 1.1 新增)
//     //BMAP_STATUS_SERVICE_UNAVAILABLE   服务不可用。对应数值“7”。(自 1.1 新增)
//     //BMAP_STATUS_TIMEOUT   超时。对应数值“8”。(自 1.1 新增)

// }

// function loadScript()
// {
//     var script = document.createElement("script");
//     script.src = "//api.map.baidu.com/api?v=3.0&ak=Yi9XWlwa7sUGSuKGDiPBrS261bMeu6YF&callback=initialize";//此为v2.0版本的引用方式
//     // //api.map.baidu.com/api?v=1.4&ak=您的密钥&callback=initialize"; //此为v1.4版本及以前版本的引用方式
//     document.body.appendChild(script);
// }



$(function ()
{
    $("#district_info").on("click",
        function ()
        {
            $.areaSelected({
                success: function (a)
                {
                    window.coordinate = null;

                    $("#district_info").val(a.district_info).attr({
                        "data-areaid": a.district_id_1,
                        "data-areaid1": a.district_id_2,
                        "data-areaid2": a.district_id_3 == 0 ? a.district_id_1 : a.district_id_2
                    }).trigger('change');
                }
            })
        }).on("change", function () {
        $('#serach_store').trigger('click')
    }).on("empty", function () {
        $("#district_info").attr('placeholder', __('所有店铺'));
        $("input[name=store_category_id]").val('0');
        $('#serach_store').trigger('click');
    });


    var keyword = decodeURIComponent(getQueryString("keyword"));
    if (keyword != "")
    {
        $("#keyword").val(keyword);
    }
    var district_info = decodeURIComponent(getQueryString("district_info"));
    if (district_info != "")
    {
        $("#district_info").val(district_info);
    }
    $("input[name=store_category_id]").val(getQueryString('store_category_id'));
    $(".page-warp").click(function ()
    {
        $(this).find(".pagew-size").toggle();
    });


    function get_store(data)
    {
        data['store_category_id'] = $("input[name=store_category_id]").val();
        data['keyword'] = $("#keyword").val();
        data['district_info'] = $("#district_info").val();
        data['coordinate'] = window.coordinate;
        console.log( window.coordinate );
        //渲染list
        var load_class = new ssScrollLoad();
        load_class.loadInit({'url':SYS.URL.store.lists,'getparam':data,'tmplid':'category-one','containerobj':$("#categroy-cnt"),'iIntervalId':true});

        return;

        $.request({
            url: SYS.URL.store.lists,
            data: data,
            type: 'get',
            dataType: 'json',
            success: function (result)
            {
                $("input[name=hasmore]").val(result.hasmore);
                if (!result.hasmore)
                {
                    $('.next-page').addClass('disabled');
                }

                var curpage = $("input[name=curpage]").val();//分页
                var page_total = result.data.total;
                var page_html = '';
                for (var i = 1; i <= result.data.total; i++)
                {
                    if (i == curpage)
                    {
                        page_html += '<option value="' + i + '" selected>' + i + '</option>';
                    }
                    else
                    {
                        page_html += '<option value="' + i + '">' + i + '</option>';
                    }
                }

                $('select[name=page_list]').empty();
                $('select[name=page_list]').append(page_html);

                var html = template.render('category-one', result.data);
                $("#categroy-cnt").append(html);

                $(window).scrollTop(0);
            }
        });
    }


    var data = {}

    data['page'] = 1;
    data['rows'] = pagesize;


    if (SYS.O2O_ENABLE && !$("#district_info").val())
    {
        loadScript()
    }
    else
    {
        get_store(data);
    }

    $('body').on('click','.store_map', function (e)
    {
        e.preventDefault();

        var long = $(this).data('long');
        var lat = $(this).data('lat');

        if (long && lat)
        {

            // $('#map-wrappers').removeClass('hide').removeClass('right').addClass('left');
            // $('#map-wrappers').on('click', '.header-l > a', function ()
            // {
            //     $('#map-wrappers').addClass('right').removeClass('left');
            // });
            $('#baidu_map').css('width', document.body.clientWidth);
            //$('#baidu_map').css('height', document.body.clientHeight);




            // var baidu_map = new BMap.Map("baidu_map");

            // var p1 = new BMap.Point(window.coordinate.lng, window.coordinate.lat);
            // var p2 = new BMap.Point(long, lat);

            // var walking = new BMap.WalkingRoute(baidu_map, {renderOptions: {map: baidu_map,  panel: "r-result", autoViewport: true}});
            // walking.search(p1, p2);

            //mode是模式driving（驾车）、walking（步行）、transit（公交）、riding（骑行）
            var mode = 'walking'
            //var baidu_url = "//api.map.baidu.com/direction?origin=150.644&destination=" + lat + "," + long + "&mode=" + mode + "&region=北京&output=html";

            var map_url = "https://www.google.com/maps/dir/?api=1&origin=%e4%b8%8a%e6%b5%b7%e9%97%b5%e8%a1%8c&destination=%e4%b8%8a%e6%b5%b7%e8%99%b9%e6%a1%a5&travelmode=driving";
            if (isWeixin())
            {
                location.href = map_url;
            }
            else
            {
                window.open(map_url, '_blank')
            }
        }
    });



    $('#serach_store').click(function ()
    {
        get_store(data);
        return;

        var keyword = encodeURIComponent($('#keyword').val());
        var district_info = encodeURIComponent($('#district_info').val());
        var store_category_id = encodeURIComponent($('#store_category_id').val());
        location.href = WapSiteUrl + '/shop.html?keyword=' + keyword + '&district_info=' + district_info + '&store_category_id=' + store_category_id;
    });
});