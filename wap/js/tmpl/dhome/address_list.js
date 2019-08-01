var key = getLocalStorage('ukey');

function changeAddress(obj){
    var address_id = obj.attr('addressid');
    var city_id = obj.attr('city_id');
    var district_id = obj.attr('district_id');
    var curr_lng = obj.attr('addresslng');
    var curr_lat = obj.attr('addresslat');
    var current_area = obj.attr('current_area');

    var area_info = obj.attr('area_info');

    var area_arr = area_info.split(' ');

    var district_name = area_arr[2];
    var city_name = area_arr[1];

    getLocalStorage('city_name',city_name);
    getLocalStorage('city_id',city_id);
    getLocalStorage('district_name',district_name);
    getLocalStorage('district_id',district_id);
    getLocalStorage('curr_lng',curr_lng);
    getLocalStorage('curr_lat',curr_lat);
    getLocalStorage('current_area',current_area);
    getLocalStorage('address_id',address_id);
    location.href = WapSiteUrl + '/dhome.html';
}

$(function(){
    $('#get_location').on('click',function(){
        delLocalStorage('city_name');
        delLocalStorage('city_id');
        delLocalStorage('district_name');
        delLocalStorage('district_id');
        delLocalStorage('curr_lng');
        delLocalStorage('curr_lat');
        delLocalStorage('current_area');
        window.location = WapSiteUrl + "/home.html";
    });
    $('.adr-input').on('click',function(){
        window.location = WapSiteUrl + "/tmpl/dhome/change_address.html";
    });
    if(key){
        $.ajax({
            type: 'post',
            url: ApiUrl + "/index.php?act=dhome_buy&op=address_list",
            data: {key: key},
            dataType: 'json',
            success: function(result) {
                if(!result){
                    result = [];
                    result.datas = [];
                    result.datas.address_list = [];
                }
                data = result.datas;
                var count =  data.address_list.length;
                if(count > 0){
                    $('.adr-notext').hide();
                    var html = template.render('address_list_tpl', data);
                    $('.adr-list').html(html);
                    $('.adr-list').show();
                }else{
                    $('.adr-notext').show();
                }
            }
        });
    }
    $('.adr-list').on('click','li',function(){
        changeAddress($(this));
    });
});