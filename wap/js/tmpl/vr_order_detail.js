var order_id = getQueryString('order_id');
var store_id = '';
var map_index_id = '';
var map_list = [];
$(function(){
    if (!ifLogin()){return}


    $.getJSON(SYS.CONFIG.URL.user.order_detail,{order_id:order_id}, function(result) {
    	if (result.status != 200) {
    		return ;
    	} 
    	//result.data.WapSiteUrl = WapSiteUrl;
    	$('#order-info-container').html(template.render('order-info-tmpl',result.data));
    	$('#buyer_phone').val(result.data.delivery.da_mobile);

        // 取消
        $(".cancel-order").click(cancelOrder);
        // 评价
        $(".evaluation-order").click(evaluationOrder);
        // 全部退款
        $('.all_refund_order').click(allRefundOrder);
        $('#resend').click(reSend);
        $('#tosend').click(toSend);

        $.getJSON(SYS.URL.store.listsChain, {store_id: store_id}, function (result)
        {
            if (result.status == 200)
            {
                if (result.data.items.length > 0)
                {
                    $('#list-address-ul').html(template.render('list-address-script', result.data));
                    map_list = result.data.items;
                    console.info(map_list)
                    var _html = '';
                    _html += '<dl index_id="0">';
                    _html += '<dt>' + map_list[0].chain_name + '</dt>';
                    _html += '<dd>' + map_list[0].chain_district_info + '</dd>';
                    _html += '</dl>';
                    _html += '<p><a href="tel:' + map_list[0].chain_mobile + '"></a></p>';
                    $('#goods-detail-o2o').html(_html);

                    $('#goods-detail-o2o').on('click', 'dl', map);

                    if (result.data.records > 1)
                    {
                        $('#store_addr_list').html(__('查看全部') + result.data.records + __('家分店地址'));
                    }
                    else
                    {
                        $('#store_addr_list').html(__('查看商家地址'));
                    }
                    $('#map_all > em').html(map_list.length);
                }
                else
                {
                    $('.goods-detail-o2o').hide();
                }
            }
        });
        $.animationLeft({
            valve: '#store_addr_list',
            wrapper: '#list-address-wrapper',
            scroll: '#list-address-scroll'
        });
    });

    //取消订单
    function cancelOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: __('确定取消订单？'),
            okFn: function() { cancelOrderId(order_id); }
        });
    }

    function cancelOrderId(order_id) {
        $.request({
            type:"post",
            url:SYS.CONFIG.URL.user.order_cancel,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.status == 200){
                    window.location.reload();
                }
            }
        });
    }

    //确认订单
    function sureOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: __('确定收到了货物吗？'),
            okFn: function() { sureOrderId(order_id); }
        });
    }

    function sureOrderId(order_id) {
        $.request({
            type:"post",
            url: SYS.CONFIG.URL.user.order_receive,
            data:{order_id:order_id},
            dataType:"json",
            success:function(result){
                if(result.data && result.data == 1){
                    window.location.reload();
                }
            }
        });
    }

    /* todo 重新发送兑换码 */
    function reSend(){
        // 从下到上动态显示隐藏内容
    	$.animationUp({valve:'',scroll:''});
    	$('#buyer_phone').on('blur',function(){
    		if ($(this).val() != '' && ! /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
    			$(this).val(/\d+/.exec($(this).val()));
    		}
    	});
    };

    function toSend(){
    	var buyer_phone = $('#buyer_phone').val();
    	$.request({
            type:"post",
            url: ApiUrl+"/index.php?act=member_vr_order&op=resend",
            data:{order_id:order_id,buyer_phone:buyer_phone},
            dataType:"json",
            success:function(result){
                if(result.data && result.data == 1){
                	$('.sstouch-bottom-mask').addClass('down').removeClass('up');
                } else {
                	$('.rpt_error_tip').html(result.status != 200).show();
                }
            }
        });
    }

    // 评价
    function evaluationOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_vr_evaluation.html?order_id=' + orderId;
        
    }
    // 全部退款
    function allRefundOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/refund_all.html?order_id=' + orderId;
    }

    $('#list-address-scroll').on('click','dl > a,#map_all',map);
    $('#map_all').on('click',map);

    function map(){
    	  $('#map-wrappers').removeClass('hide').removeClass('right').addClass('left');
    	  $('#map-wrappers').on('click', '.header-l > a', function(){
    		  $('#map-wrappers').addClass('right').removeClass('left');
    	  });
    	  $('#baidu_map').css('width', document.body.clientWidth);
    	  $('#baidu_map').css('height', document.body.clientHeight);
    	  map_index_id = $(this).attr('index_id');
    	  if (typeof map_index_id != 'string'){
    		  map_index_id = '';
    	  }
          if (typeof(map_js_flag) == 'undefined') {
              $.request({
                  type:'get',
                  url: WapSiteUrl+'/js/map.js',
                  dataType: "script",
                  cache:true,
                  async: false
              });
          }
    	if (typeof BMap == 'object') {
    	    baidu_init();
    	} else {
    	    load_script();
    	}
   }
});