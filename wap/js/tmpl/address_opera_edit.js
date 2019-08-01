$(function() {
	var address_id = getQueryString('address_id');
	var ud_id = address_id;
	var key = getLocalStorage('ukey');

	$.request({
		type: 'post',
		url: SYS.URL.user.address_get,
		data: {
            ud_id: address_id
		},
		dataType: 'json',
		success: function(result) {
			if (result.status == 200)
			{
                $('#true_name').val(result.data.ud_name);
                $('#mob_phone').val(result.data.ud_mobile);
                $('#district_info').val(result.data.district_info).attr({'data-areaid':result.data.ud_province_id, 'data-areaid1':result.data.ud_city_id, 'data-areaid2':result.data.ud_county_id});
                $('#address').val(result.data.ud_address);
                $('#ud_postalcode').val(result.data.ud_postalcode);
                var _checked = result.data.ud_is_default == '1' ? true : false;
                $('#is_default').prop('checked',_checked);
                if (_checked) {
                    $('#is_default').parents('label').addClass('checked');
                }
			}
		}
	});

	$.sValid.init({
		rules:{
            true_name:"required",
            mob_phone:"required",
            district_info:"required",
            address:"required"
        },
        messages:{
            true_name:__("姓名必填！"),
            mob_phone:__("手机号必填！"),
            district_info:__("地区必填！"),
            address:__("街道必填！")
        },
		callback:function (eId,eMsg,eRules){
			if(eId.length >0){
				var errorHtml = "";
				$.map(eMsg,function (idx,item){
					errorHtml += "<p>"+idx+"</p>";
				});
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide();
			}
		}  
	});
	$('.btn').click(function() {
		if($.sValid()){
            var true_name = $('#true_name').val();
            var mob_phone = $('#mob_phone').val();
            var address = $('#address').val();
            var ud_postalcode = $('#ud_postalcode').val();
            var county_id = $('#district_info').attr('data-areaid2');
            var city_id = $('#district_info').attr('data-areaid1');
            var province_id = $('#district_info').attr('data-areaid');
            var district_info = $('#district_info').val();
            var is_default = $('#is_default').prop("checked") ? 1 : 0;

			$.request({
				type: 'post',
				url: SYS.URL.user.address_edit,
				data: {


                    ud_name :  true_name,
                    ud_mobile :  mob_phone,
                    ud_address :  address,
                    ud_county_id : county_id,
                    ud_city_id :  city_id,
                    ud_province_id:  province_id,
                    ud_postalcode:  ud_postalcode,
                    ud_district_id :  province_id,
                    district_info : district_info,
                    ud_is_default :  is_default,


                    is_default:is_default,
					ud_id: address_id
				},
				dataType: 'json',
				success: function(result) {
					if (result) {
						location.href = WapSiteUrl + '/tmpl/member/address_list.html';
					} else {
						location.href = WapSiteUrl;
					}
				}
			});
		}
	});

    // 选择地区
    $('#district_info').on('click', function(){
        $.areaSelected({
            success : function(data){
                $('#district_info').val(data.district_info).attr({'data-areaid':data.district_id_1, 'data-areaid1':data.district_id_2,  'data-areaid2':data.district_id_3});
            }
        });
    });
    
});