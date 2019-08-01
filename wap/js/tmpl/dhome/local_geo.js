if(!SYS.AK_BROWSER){
    $.sDialog({
        content: __('未配置百度地图key！<br>请联系管理员配置…'),
        okBtn: false,
        cancelBtnText: __('返回'),
        cancelFn: function () {
            history.back();
        }
    });
}
var C = {};


document.write(unescape("%3Cscript src='//api.map.baidu.com/api?v=3.0&ak="+SYS.AK_BROWSER+"' type='text/javascript'%3E%3C/script%3E"));

//暂停函数
function sleep(n) { //n表示的毫秒数
    var start = new Date().getTime();
    while (true) if (new Date().getTime() - start > n) break;
}
//成功时
function onSuccess(position){
    //经度
    C.lng = position.coords.longitude + 0.008774687519;
    //纬度
    C.lat = position.coords.latitude + 0.00374531687912;
    getAddressInfo();
}

//失败时
function onError(error){
    C.lng = 0;
    C.lat = 0;
    getLocationByApi();
}

//获取当前地址信息
function getAddressInfo(){
    $.ajax({
        url:ApiUrl + '/index.php?act=area&op=get_area_info',
        type: 'get',
        data:{lng:C.lng,lat:C.lat},
        dataType: 'json',
        success: function(result) {
            var data = result.datas;
            setLocalStorage('city_name',data.city_info.area_name);
            setLocalStorage('city_id',data.city_info.area_id);
            setLocalStorage('district_name',data.district_info.area_name);
            setLocalStorage('district_id',data.district_info.area_id);
            setLocalStorage('curr_lng',C.lng);
            setLocalStorage('curr_lat',C.lat);
            setLocalStorage('current_area',data.area_text);
            location.href = WapSiteUrl + '/dhome.html';
        },
        error: function(){
            location.href = WapSiteUrl + "/tmpl/dhome/change_city.html?get_state=fail";
        }
    });
}

//通过百度接口获取定位信息
function getLocationByApi(){
    var api_geolocation = new BMap.Geolocation(); //实例化浏览器定位对象。
    api_geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){  //通过Geolocation类的getStatus()可以判断是否成功定位。
            C.lng = Number(r.point.lng);
            C.lat = Number(r.point.lat);
            getAddressInfo();
        }
    },{enableHighAccuracy: true,timeout: 5000,maximumAge:1000});
}

//获取定位信息
function getLocation(){
    if(navigator.geolocation){
        //浏览器支持geolocation
        navigator.geolocation.getCurrentPosition(onSuccess,onError,{
            enableHighAccuracy:true,
            timeout: 5000,
            maximumAge:1000
        });
    }else{
        getLocationByApi();
    }
}




$(function(){
    var current_area = getLocalStorage('city_name');
    if( current_area !== '' && current_area != null && current_area.toLowerCase() !== 'undefined'){
        location.href = WapSiteUrl + "/dhome.html";
    }
    getLocation();
});