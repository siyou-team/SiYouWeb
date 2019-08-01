var page = pagesize;
var curpage = 1;
var hasmore = true;
var footer = false;
var firstRow = 0;
var address = []; //地址
var cutpriceData  = []; //商品信息
var activity_id   = 0;
var product_item_id     = 0;
var ac_id = 0;

$(function ()
{   
    //初始化页面
    init_page();

    //获取砍价列表
    get_list();

    //绑定事件
    eventBind();

    addAddress();
    //页面向下滚动加载新的内容
    $(window).scroll(function ()
    {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1)
        {
            get_list()
        }
    });
});

//初始化页面 Brand 收货地址
function init_page(){
    $.request({
        url: SYS.URL.user.pageCutPriceActivity ,
        type: 'post',
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            if( data.cutprice_banner ){
                $('#brand').find('img').prop('src',data.cutprice_banner );
            }

            if( data.cutprice_banner_url ){
                $('#brand').find('a').prop('href',data.cutprice_banner_url );
            }

            if( data.cutprice_success_list ){
                var r = template.render("success_main", data);
                $(".success_wrap").append(r);
                var swiper = new Swiper('.swiper-container', {
                    direction: 'vertical',
                    autoplay:3000,
                    autoplayDisableOnInteraction : false,
                });
            }

            //渲染消息提示框
            if( data.user_row && data.user_row.user_avatar ){
                $('.user-img-ab').children('img').prop('src',data.user_row.user_avatar);
            }

            if( data.address ){
                 //保留收货地址数据 选择收货地址时使用
                for( var i = 0 ; i < data.address.length; i++ ){
                    address[data.address[i].ud_id] = data.address[i];
                }

                renderAddress( data );
            }
        }
    });
}

//获取砍价列表
function get_list()
{
    $(".loading").remove();
    if (!hasmore)
    {
        return false
    }
    hasmore = false;
    param = {};
    param.rows = page;
    param.page = curpage;
    param.firstRow = firstRow;

    $.request({
        url    : SYS.URL.user.listsCutPriceActivity,
        data   : param,
        success: function (e)
        {
            curpage++;   
            var r = template.render("cutprice_main", e);
            $("#cutprice_list").append(r);

            if(e.data.page < e.data.total)
            {
                firstRow = e.data.page*pagesize;
                hasmore = true;
            }
            else
            {
               hasmore = false;
            }

            var data = e.data.items;
            for( var j = 0; j < data.length;j++ ){
                cutpriceData[data[j].activity_id] = data[j];
            }
        }
    });
}



//选择规格后执行回调函数
function goodsSpecCallBack( bid ) {
    if( $("#spec_detail").find(".spec-list").length != $("#spec_detail").find("a.active").length ){
        alert( __('请选择规格'));
        return false;
    }
    //重置当前的bargain_id
    activity_id = bid;

    //根据规格查找goods_id 
    product_item_id = getGoodsIdFromSpec( activity_id );
    //判断库存
    if( cutpriceData[bid].item_rows[product_item_id].item_quantity <= 0 ){
         $.sDialog({
            skin: "red",
            content: __('库存不足！'),
            okBtn: false,
            cancelBtn: false
        });
        return;
    }

    hiddenBottom('select_spec');
    showBottom('select_address');
}

//渲染收货地址
function renderAddress( data ){
    var r = template.render("address_main", data);
    $("#address_list").append(r);
}

//选择收货地址
function selectAddress( id ){
    var address_data = address[id];
    console.log( address_data );
    var r = template.render("address_dialog", address_data);

    $("#confirm_address").html(r);

    hiddenBottom('select_address');
    showCenter('popup_address');
}


//点击收货地址确定按钮 执行回调函数 进行砍价
function addressCallback( address_id ){
    var param = {
        activity_id : activity_id,
        product_item_id :product_item_id,
        address_id : address_id,
    };
    $.request({
        url    : SYS.URL.user.addUserCutPriceActivity,
        data   : param,
        type   : 'post',
        dataType: 'json',
        success: function (e)
        {
            if( e.status == 200 ){
                window.location.href = 'cutprice_detail.html?ac_id=' + e.data.ac_id;
            } else {
                hiddenCenter('popup_address');
                $.sDialog({
                    skin: "red",
                    content: e.msg,
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }   
        },
        failure:function( e ){ 
        }
    });
}

//处理函数
function eventHand( id,gid ){

    if(!getLocalStorage('ukey') ){
        setLocalStorage('redirect_uri', '/tmpl/cutprice_list.html');
        checkLogin(0);
        return false;
    }
    //重置bargain_id
    activity_id = id;
    //重置goods_id
    product_item_id   = gid;
    //获取数据
    var cutprice_data = cutpriceData[id];

    if( cutprice_data.activity_parted ){ 
        ac_id = cutprice_data.ac_id;
        showBottom('bargain_dialog');
    }
    else if( cutprice_data.product_spec.length > 0 )
    { //如果该商品为多规格 渲染商品规格
        var r = template.render("spec_main", cutprice_data);
        $("#spec_detail").html(r);
        showBottom('select_spec');
    } 
    else if( address && address.length > 0 )
    { //如果存在收货地址 渲染收货地址
        showBottom('select_address');
    } 
    else 
    { 
        addressCallback(0);
    }
}



//事件处理函数
function eventBind(){

    //选则规格
    $(document).on('click','.spec-item',function(){
        var self = this;
        var bid  = $(this).parent().attr('activity_id');
        myData =   cutpriceData[bid];
        console.log( myData );
        arrowClick(self, myData);
    });

    //关闭地址
    $(document).on('click','.header-back',function(){
        $('#new-address-wrapper').removeClass('left').addClass('right');
    })

    $('.sbtn').click(function(){
        window.location.href = 'cutprice_detail.html?ac_id=' + ac_id;
    })
}

 // 点击规格属性时，如果当前为选中状态则取消
// 只有当每种规格属性都选择，才可以发起请求，拉去商品信息

// 点击规格属性时，判断是否发起请求
function checkSpec(spec) {
    var $spec = $(spec);

    $spec.hasClass("active")
        ? ( $spec.removeClass("active"), $("span.goods-storage").text() )
        : $spec.addClass("active").siblings().removeClass("active");

    return $("#spec_detail").find(".spec-list").length == $("#spec_detail").find("a.active").length
        ? true
        : false;
}

//点击商品规格，获取新的商品
function arrowClick(self, myData) {
    if (! checkSpec(self)) {
        return false;
    }
    var bid = myData.activity_id;
    //获取商品ID
    product_item_id = getGoodsIdFromSpec( bid );
    var item_detail = myData.item_rows[product_item_id];
    console.log( item_detail );
    $('.goods_spec_price').html('￥' + item_detail.activity_item_price );
    $('.goods_spec_storage').html(item_detail.item_quantity + '件' );

    var goods_spec_name = '';
    $("#spec_detail").find(".spec-item.active").each(function(){
        goods_spec_name += $(this).text();
    })
    //alert( goods_spec_name );
    $('.goods_spec_name').html( '已选择' + goods_spec_name );
}

//通过规格获取商品ID
function getGoodsIdFromSpec( bid ){
    //拼接属性
    var curEle = $("#spec_detail").find(".spec-item.active");
    var curSpec = [];
    
    $.each(curEle, function (i, v) {
        // convert to int type then sort
        curSpec.push(parseInt($(v).attr("specs_value_id")) || 0);
    });
    var spec_string = curSpec.sort(function (a, b) {
        return a - b;
    }).join("-");
    //获取商品ID

    var g_id = cutpriceData[bid].product_uniqid[spec_string][0];

    return g_id;
}


//显示新增收货地址页
function showAddressAddWrap(){
    hiddenBottom('select_address');
    $('#new-address-wrapper').removeClass('hide').removeClass('right').addClass('left');
}

//新增收货地址
function addAddress(){
    $.sValid.init({
        rules:{
            true_name:"required",
            mob_phone:"required",
            district_info:"required",
            address:"required"
        },
        messages:{
            true_name:"姓名必填！",
            mob_phone:"手机号必填！",
            district_info:"地区必填！",
            address:"街道必填！"
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

    $('.main-btn').click(function(){
        if($.sValid()){
            var true_name = $('#true_name').val();
            var mob_phone = $('#mob_phone').val();
            var ud_address= $('#address').val();
            var ud_postalcode = $('#ud_postalcode').val();
            var county_id = $('#district_info').attr('data-areaid2');
            var city_id = $('#district_info').attr('data-areaid1');
            var province_id = $('#district_info').attr('data-areaid');
            var district_id = $('#district_info').attr('data-areaid');
            var district_info = $('#district_info').val();
            var is_default = $('#is_default').attr("checked") ? 1 : 0;

            $.request({
                type:'post',
                url: SYS.URL.user.address_edit,
                data:{

                    ud_name :  true_name,
                    ud_mobile :  mob_phone,
                    ud_address :  ud_address,
                    ud_county_id : county_id,
                    ud_city_id :  city_id,
                    ud_province_id:  province_id,
                    ud_district_id :  district_id,
                    district_info : district_info,
                    ud_postalcode : ud_postalcode,
                    ud_is_default :  is_default,

                },
                dataType:'json',
                success: function (a) {
                    if (a)
                    {   
                        $('#new-address-wrapper').addClass('hide').addClass('right').removeClass('left');
                        address[a.data.ud_id] = a.data;
                        selectAddress( a.data.ud_id )
                    }
                }
            });
        }
    });
}