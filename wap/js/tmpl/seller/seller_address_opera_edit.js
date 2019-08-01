$(function() { 
    var ss_id = getQueryString("address_id");
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}
    $.request({
        type: "post",
        url: SYS.CONFIG.URL.seller.get_shipping_address,
        data: {
            ss_id: ss_id
        },
        dataType: "json",
        success: function(a) {
            checkLogin(a.login);
            $("#true_name").val(a.data[0].ss_name);
            $("#mob_phone").val(a.data[0].ss_mobile);
            var district_info = a.data[0].ss_province + " " + a.data[0].ss_city + " " + a.data[0].ss_county
            $("#district_info").val(district_info).attr({
                "data-areaid1": a.data[0].ss_province_id,
                "data-areaid2": a.data[0].ss_city_id,
                "data-areaid3": a.data[0].ss_county_id
            });
            $("#address").val(a.data[0].ss_address);
            var e = a.data[0].ss_is_default == "1" ? true: false;
            $("#is_default").prop("checked", e);
            if (e) {
                $("#is_default").parents("label").addClass("checked")
            }
        }
    });
    $.sValid.init({
        rules: {
            true_name: "required",
            mob_phone: "required",
            district_info: "required",
            address: "required"
        },
        messages: {
            true_name: __("姓名必填！"),
            mob_phone: __("手机号必填！"),
            district_info: __("地区必填！"),
            address: __("街道必填！")
        },
        callback: function(a, e, r) {
            if (a.length > 0) {
                var d = "";
                $.map(e,
                function(a, e) {
                    d += "<p>" + a + "</p>"
                });
                errorTipsShow(d)
            } else {
                errorTipsHide()
            }
        }
    });
	$("#header-nav").click(function() {
        $(".btn").click()
    });
    $(".btn").click(function() {
        if ($.sValid()) {
            var ss_name = $("#true_name").val();
            var address = $("#address").val();
            var ss_mobile = $("#mob_phone").val();

            var ss_county_id = $("#district_info").attr("data-areaid1");
            var ss_city_id = $("#district_info").attr("data-areaid2");
            var ss_province_id = $("#district_info").attr("data-areaid3");
            var ss_district_info = $("#district_info").val();
            var district_arr = ss_district_info.split(" ");
            var ss_county = district_arr[2];
            var ss_city = district_arr[1];
            var ss_province = district_arr[0];
            var ss_is_default = $("input:checkbox[name='is_default']").is(':checked') ? 1 : 0;
            $.request({
                type: "post",
                url: SYS.CONFIG.URL.seller.edit_shipping_address,
                data: {
                    ss_name         : ss_name,
                    ss_mobile       : ss_mobile,
                    ss_district_info: ss_district_info,
                    ss_city_id      : ss_city_id,
                    ss_county_id    : ss_county_id,
                    ss_province_id  : ss_province_id,
                    ss_county       : ss_county,
                    ss_city         : ss_city,
                    ss_province     : ss_province,
                    ss_is_default   : ss_is_default,
                    ss_address      : address,
                    ss_id           : ss_id
                },
                dataType: "json",
                success: function(a) {
                   if (a && a.status == 200) {
						$.sDialog({
							skin: "block",
							content: __("地址编辑成功"),
							okBtn: true,
							cancelBtn: true,
							okFn: function() {
								 location.href = WapSiteUrl + "/tmpl/seller/seller_address_list.html"
							}
						 })
                       
                    } else {
                        $.sDialog({
                            skin: "block",
                            content: __("地址编辑失败")+JSON.stringify(a),
                            okBtn: true,
                            cancelBtn: false
                        })
                    }
                }
            })
        }
    });
    $("#district_info").on("click",
        function() {
            $.areaSelected({
                success: function(a) {
                    console.info(a);

                    $("#district_info").val(a.district_info).attr({
                        "data-areaid1": a.district_id_1,
                        "data-areaid2": a.district_id_2,
                        "data-areaid3": a.district_id_3
                    })
                }
            })
        })
    });