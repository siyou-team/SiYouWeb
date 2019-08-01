;(function($) {
    $.extend($, {
        goodsClassSelected: function(options) {
            /*
             * 发布商品时选择分类
             * */
            var defaults = {
                success: function(e) {}
            };
            var options = $.extend({}, defaults, options);
            var ASID = 0;
            var ASID_1 = 0;
            var ASID_2 = 0;
            var ASID_3 = 0;
            var ASNAME = "";
            var ASINFO = "";
            var ASDEEP = 1;
            var ASINIT = true;
            var skey = getLocalStorage('ukey')
            function _classinit() {
                if ($("#areaSelected").length > 0) {
                    $("#areaSelected").remove()
                }
                var e = '<div id="areaSelected">' + '<div class="sstouch-full-mask left">' + '<div class="sstouch-full-mask-bg"></div>' + '<div class="sstouch-full-mask-block">' + '<div class="header">' + '<div class="header-wrap">' + '<div class="header-l"><a href="javascript:void(0);"><i class="zc zc-back back"></i></a></div>' + '<div class="header-title">' + "<h1>" + __('选择商品分类') + "</h1>" + "</div>" + '<div class="header-r"><a href="javascript:void(0);"><i class="close"></i></a></div>' + "</div>" + "</div>" + '<div class="sstouch-main-layout">' + '<div class="sstouch-single-nav">' + '<ul id="filtrate_ul" class="area">' + '<li class="selected"><a href="javascript:void(0);">' + __('一级分类') + '</a></li>' + '<li><a href="javascript:void(0);" >' + __('二级分类') + '</a></li>' + '<li><a href="javascript:void(0);" >' + __('三级分类') + '</a></li>' + "</ul>" + "</div>" + '<div class="sstouch-main-layout-a"><ul class="sstouch-default-list"></ul></div>' + "</div>" + "</div>" + "</div>" + "</div>";
                $("body").append(e);
                _getGoodsClassList();
                _gcBindEvent();
                _gcclose()
            }
            function _getGoodsClassList() {
                $.request({
                    type: "post",
                    url: SYS.URL.product.category,
                    data: {
                        category_id: ASID,
                        deep:ASDEEP,
                        client:'mobile'
                    },
                    dataType: "json",
                    async: false,
                    success: function(e) {
                        //alert(JSON.stringify(e));
                        if (e.data.items.length == 0) {
                            _gcfinish();
                            return false
                        }
                        if (ASINIT) {
                            ASINIT = false
                        } else {
                            ASDEEP++
                        }
                        $("#areaSelected").find("#filtrate_ul").find("li").eq(ASDEEP - 1).addClass("selected").siblings().removeClass("selected");
                        checkLogin(e.login);
                        var t = e.data;
                        var a = "";
                        for (var n = 0; n < t.items.length; n++) {
                            a += '<li><a href="javascript:void(0);" data-id="' + t.items[n].category_id + '" data-name="' + t.items[n].category_name + '"><h4>' + t.items[n].category_name + '</h4><span class="zc zc-arrow-r arrow-r"></span> </a></li>'
                        }
                        $("#areaSelected").find(".sstouch-default-list").html(a);
                        if (typeof myScrollArea == "undefined") {
                            if (typeof IScroll == "undefined") {
                                $.request({
                                    type:'get',
                                    cache:true,
                                    url: WapSiteUrl + "/js/libs/iscroll.js",
                                    dataType: "script",
                                    async: false
                                })
                            }
                            myScrollArea = new IScroll("#areaSelected .sstouch-main-layout-a", {
                                mouseWheel: true,
                                click: true
                            })
                        } else {
                            myScrollArea.refresh()
                        }
                    }
                });
                return false
            }
            function _gcBindEvent() {
                $("#areaSelected").find(".sstouch-default-list").off("click", "li > a");
                $("#areaSelected").find(".sstouch-default-list").on("click", "li > a",
                    function() {
                        ASID = $(this).attr("data-id");
                        eval("ASID_" + ASDEEP + "=$(this).attr('data-id')");
                        ASNAME = $(this).attr("data-name");
                        ASINFO += ASNAME + " >";
                        var _li = $("#areaSelected").find("#filtrate_ul").find("li").eq(ASDEEP);
                        _li.prev().find("a").attr({
                            "data-id": ASID,
                            "data-name": ASNAME
                        }).html(ASNAME);
                        if (ASDEEP == 3) {
                            _gcfinish();
                            return false
                        }
                        _getGoodsClassList()
                    });
                $("#areaSelected").find("#filtrate_ul").off("click", "li > a");
                $("#areaSelected").find("#filtrate_ul").on("click", "li > a",
                    function() {
                        if ($(this).parent().index() >= $("#areaSelected").find("#filtrate_ul").find(".selected").index()) {
                            return false
                        }
                        ASID = $(this).parent().prev().find("a").attr("data-id");
                        ASNAME = $(this).parent().prev().find("a").attr("data-name");
                        ASDEEP = $(this).parent().index();
                        ASINFO = "";
                        for (var e = 0; e < $("#areaSelected").find("#filtrate_ul").find("a").length; e++) {
                            if (e < ASDEEP) {
                                ASINFO += $("#areaSelected").find("#filtrate_ul").find("a").eq(e).attr("data-name") + " "
                            } else {
                                var t = "";
                                switch (e) {
                                    case 0:
                                        t = __("一级分类");
                                        break;
                                    case 1:
                                        t = __("二级分类");
                                        break;
                                    case 2:
                                        t = __("三级分类");
                                        break
                                }
                                $("#areaSelected").find("#filtrate_ul").find("a").eq(e).html(t)
                            }
                        }
                        _getGoodsClassList()
                    })
            }
            function _gcfinish() {
                ASINFO=ASINFO.substring(0,ASINFO.length-1);
                var e = {
                    category_id: ASID,
                    category_id_1: ASID_1,
                    category_id_2: ASID_2,
                    category_id_3: ASID_3,
                    category_name: ASNAME,
                    category_info: ASINFO
                };
                options.success.call("success", e);
                if (!ASINIT) {
                    $("#areaSelected").find(".sstouch-full-mask").addClass("right").removeClass("left")
                }
                return false
            }
            function _gcclose() {
                $("#areaSelected").find(".header-l").off("click", "a");
                $("#areaSelected").find(".header-l").on("click", "a",
                    function() {
                        $("#areaSelected").find(".sstouch-full-mask").addClass("right").removeClass("left")
                    });
                return false
            }
            return this.each(function() {
                return _classinit()
            })()
        }
    });
})(window.jQuery || window.Zepto);


$(function() {
    var a = getLocalStorage('ukey');
    $.sValid.init({
        rules: {
            g_name: "required",
            g_price: "required",
            g_discount: "required",
            category_info: "required",
            goods_image: "required",
            g_body: "required",
            g_storage: "required",
            goods_image_main: "required",
            g_freight:"required"
        },
        messages: {
            g_name: __("请填写商品名字"),
            g_price: __("请填写商品价格！"),
            g_discount:__("请输入折扣"),
            category_info: __("请选择商品分类"),
            goods_image_main: __("请至少上传一张商品主图"),
            g_storage: __("请填写商品库存"),
            g_body: __("请填写商品描述"),
            g_freight:__("输入物流费用")
        },
        callback: function(a, e, r) {
            if (a.length > 0) {
                var i = "";
                $.map(e,
                    function(a, e) {
                        i += "<p>" + a + "</p>"
                    });
                errorTipsShow(i)
            } else {
                errorTipsHide()
            }
        }
    });
    $("#header-nav").click(function() {
        $(".btn").click()
    });

    $("#g_freight").on("blur",
        function() {

            var catid=$("#category_info").attr("data-cid1");
            var minvalue=0;
            //var alertstr="运费至少3元.";
            var feelvalue=$(this).val();
            var sourcefee=0;
            var grapfee=0;

            //判断物流费数字
            if(!(/^\d+(\.\d+)?$/.test(feelvalue))){
                alert(__("运费请输入数字"));
                $(this).val("");
                $(this).focus();
                $("#feeinfo").html("");

            }else{
                if(feelvalue<minvalue){
                    alert(__('请输入正确物流费用') + '，'+alertstr);
                    $(this).val("");
                    $(this).focus();
                    $("#feeinfo").html("");
                }else{

                    //grapfee= feelvalue.toFixed(2);
                    //$("#feeinfo").html("物流费："+(feelvalue).toFixed(2)+"元，总费用："+grapfee);

                }
            }
        });

    $('input[name="upfile"]').ajaxUploadImage({
        url :SYS.URL.upload,
        data:{
            key:a,
            name:"file"
        },
        start :  function(element){
            element.parent().after('<div class="upload-loading"><i></i></div>');
            element.parent().siblings('.pic-thumb').remove();
        },
        success : function(element, result){
            // checkLogin(result.login);
            if (result.datas.error) {
                element.parent().siblings('.upload-loading').remove();
                $.sDialog({
                    skin:"red",
                    content:__('图片尺寸过大！'),
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }
            element.parent().after('<div class="pic-thumb"><img src="'+result.datas.thumb_name+'"/></div>');
            element.parent().siblings('.upload-loading').remove();
            element.parents('a').next().val(result.datas.name);
            element.parents('a').next().attr('data-img',result.datas.thumb_name);
        }
    });


    $(".btn").click(function() {
        if ($.sValid()) {
            var g_img_1=$("#image_body_0").val();
            var g_img_2=$("#image_body_1").val();
            var g_img_3=$("#image_body_2").val();
            var g_img_4=$("#image_body_3").val();
            var g_img_5=$("#image_body_4").val();
            var imgall="";
            if(g_img_1!="")
                imgall=imgall+g_img_1+",";
            if(g_img_2!="")
                imgall=imgall+g_img_2+",";
            if(g_img_3!="")
                imgall=imgall+g_img_3+",";
            if(g_img_4!="")
                imgall=imgall+g_img_4+",";
            if(g_img_5!="")
                imgall=imgall+g_img_5+",";
            if(imgall!="")
                imgall=imgall.substring(0,imgall.length-1);
            $.sDialog({
                autoTime:'10000',
                skin: "red",
                content: __('正在发布商品...'),
                okBtn: false,
                cancelBtn: false
            });
            $.ajax({
                type: "post",
                url: SYS.URL.seller.product_add,
                data: {
                    key: a,
                    cate_id: $("#category_info").attr("data-cid3"),
                    cate_name: $("#category_info").attr("data-catname"),
                    g_name: $("#g_name").val(),
                    g_jingle:'',
                    b_id:0,
                    b_name:'',
                    g_price: $("#g_price").val(),
                    g_marketprice: $("#g_marketprice").val(),
                    g_costprice: $("#g_price").val(),
                    g_discount: $("#g_discount").val(),
                    //image_path:$("#goods_image_main").val(),
                    image_all:imgall,
                    g_storage: $("#g_storage").val(),
                    g_serial: $("#g_serial").val(),
                    g_alarm:1,
                    g_barcode:'',
                    attr:'',
                    custom:'',
                    g_body: $("#g_body").val(),
                    m_body: $("#g_body").val(),
                    starttime:'2017-03-27',
                    starttime_H:'00',
                    starttime_i:'05',
                    province_id:0,
                    city_id:0,
                    freight:0,
                    transport_title:'',
                    sgcate_id:'',
                    plate_top:0,
                    plate_bottom:0,
                    g_freight:$("#g_freight").val(),
                    g_vat:0,
                    g_state:$('#goodstate input[name="g_state"]:checked').val(),
                    g_commend:1,
                    is_gv:0,
                    g_vlimit:0,
                    g_vinvalidrefund:0,
                    sup_id:0,
                    type_id:0

                },
                dataType: "json",
                success: function(a) {
                    if (a.code==200) {
                        $.sDialog({
                            skin: "red",
                            content: __('商品发布成功！'),
                            okBtn: true,
                            cancelBtn: true,
                            okFn:function(){window.location.href = WapSiteUrl + "/tmpl/seller/store_goods_list.html";},
                            cancelFn:function(){window.location.reload();}
                        });

                    } else {
                        $.sDialog({
                            skin: "red",
                            content: __('发布失败:')+JSON.stringify(a),
                            okBtn: true,
                            cancelBtn: false
                        });
                        //location.href = WapSiteUrl
                    }
                },error:function(e){

                    alert(JSON.stringify(e));
                }
            })
        }
    });
    $("#g_marketprice").blur(function(){

        var dis=$(this).val();

        var gp= $("#g_price").val();

        if(gp==""){
            gp=0;
            $(this).val(0);
        }

        if(/^[0-9]+.?[0-9]*$/.test(dis)){
            $("#g_discount").val(Math.round((gp/dis)*100));
        }else{
            $.sDialog({
                skin: "red",
                content: __('请输入数字'),
                okBtn: true,
                okFn:function(){$("#g_marketprice").val("");},
                cancelBtn: false
            });
        }

    });
    $("#category_info").on("click",
        function() {
            $.goodsClassSelected({
                success: function(a) {
                    $("#category_info").val(a.category_info).attr({
                        "data-cid1":  a.category_id_1,
                        "data-cid2":  a.category_id_2,
                        "data-cid3":  a.category_id_3,
                        "data-catname": a.category_info
                    })
                }
            })
        })
});