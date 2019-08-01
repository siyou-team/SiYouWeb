var rows = pagesize;
var curpage = 1;
var hasmore = true;
var footer = false;
var keyword = decodeURIComponent(getQueryString('keyword'));
var category_id = getQueryString('category_id');
var b_id = getQueryString('b_id');
var sidx = getQueryString('sidx');
var sord = getQueryString('sord');
var district_id = getQueryString('district_id');
var price_from = getQueryString('price_from');
var price_to = getQueryString('price_to');
var selfsupport = getQueryString('selfsupport');
var gift = getQueryString('gift');
var groupbuy = getQueryString('groupbuy');
var xianshi = getQueryString('xianshi');
var virtual = getQueryString('virtual');
var ci = getQueryString('ci');
var myDate = new Date();
var searchTimes = myDate.getTime();


var points_from = getQueryString('points_from');
var points_to = getQueryString('points_to');

$(function(){
    $.animationLeft({
        valve : '#search_filter',
        wrapper : '.sstouch-full-mask',
        scroll : '#list-items-scroll'
    });
    $("#header").on('click', '.header-inp', function(){
        location.href = WapSiteUrl + '/tmpl/seller/supplier_search.html?keyword=' + keyword;
    });
    if (keyword != '') {
    	$('#keyword').html(keyword);
    }

    // 商品展示形式
    $('#show_style').click(function(){
        if ($('#product_list').hasClass('grid')) {
            $(this).find('span').removeClass('browse-grid').addClass('browse-list');
            $('#product_list').removeClass('grid').addClass('list');
        } else {
            $(this).find('span').addClass('browse-grid').removeClass('browse-list');
            $('#product_list').addClass('grid').removeClass('list');
        }
    });

    // 排序显示隐藏
    $('#sort_default').click(function(){
        if ($('#sort_inner').hasClass('hide')) {
            $('#sort_inner').removeClass('hide');
        } else {
            $('#sort_inner').addClass('hide');
        }
    });
    $('#nav_ul').find('a').click(function(){
        $(this).addClass('current').parent().siblings().find('a').removeClass('current');
        if (!$('#sort_inner').hasClass('hide') && $(this).parent().index() > 0) {
            $('#sort_inner').addClass('hide');
        }
    });
    $('#sort_inner').find('a').click(function(){
        $('#sort_inner').addClass('hide').find('a').removeClass('cur');
        var text = $(this).addClass('cur').text();
        $('#sort_default').html(text + '<i></i>');
    });

    $('#product_list').on('click', '.goods-store a',function(){
        var $this = $(this);
        var store_id = $(this).attr('data-id');
        var store_name = $(this).text();
        $.getJSON(SYS.URL.store.credit, {store_id:store_id}, function(result){
            var html = '<dl>'
                + '<dt><a href="store.html?store_id=' + store_id + '">' + store_name + '<span class="zc zc-arrow-r arrow-r"></span></a></dt>'
                + '<dd class="' + result.data.store_credit.store_desccredit.percent_class + '">' + __('描述相符：') + '<em>' + result.data.store_credit.store_desccredit.credit + '</em><i></i></dd>'
                + '<dd class="' + result.data.store_credit.store_servicecredit.percent_class + '">' + __('服务态度：') + '<em>' + result.data.store_credit.store_servicecredit.credit + '</em><i></i></dd>'
                + '<dd class="' + result.data.store_credit.store_deliverycredit.percent_class + '">' + __('发货速度：')+ '<em>' + result.data.store_credit.store_deliverycredit.credit + '</em><i></i></dd>'
                + '</dl>';
            //渲染页面

            $this.next().html(html).show();
        });
    }).on('click', '.sotre-creidt-layout', function(){
        $(this).hide();
    });

    get_list();
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            get_list();
        }
    });
    search_filter();
});

function get_list() {
    $('.loading').show();
    if (!hasmore) {
        return false;
    }
    hasmore = false;
    param = {};
    param.rows = rows;
    param.curpage = curpage;
    if (category_id != '') {
        param.category_id = category_id;
    } else if (keyword != '') {
        param.keyword = keyword;
    } else if (b_id != '') {
        param.b_id = b_id;
    }
    if (sidx != '') {
        param.sidx = sidx;
    }
    if (sord != '') {
        param.sord = sord;
    }
    
    $.getJSON(SYS.URL.supplier.product + window.location.search.replace('?','&'), param, function(result){

        $('.loading').hide();

        if (200 == result.status)
        {

        }

    	if(!result) {
    		result = [];
    		result.data = [];
    		result.data.items = [];
    		result.data.hasmore = false;
    	}


        curpage++;
        var html = template.render('home_body', result);
        $("#product_list .goods-secrch-list").append(html);
        hasmore = result.data.total != result.data.page;


        //搜索更新
        if (keyword != '') {
            getSearchName(true);
        }

    }, {});
}

function search_filter() {
    $.getJSON(SYS.URL.search_filter, function(result) {
    	var data = result.data;
    	$('#list-items-scroll').html(template.render('search_items',data));
    	if (district_id) {
    		$('#district_id').val(district_id);
    	}
    	if (price_from) {
    		$('#price_from').val(price_from);
    	}
    	if (price_to) {
    		$('#price_to').val(price_to);
    	}

        if (points_from) {
            $('#points_from').val(points_from);
        }
        if (points_to) {
            $('#points_to').val(points_to);
        }




    	if (selfsupport) {
    		$('#selfsupport').addClass('current');
    	}
    	if (gift) {
    		$('#gift').addClass('current');
    	}
    	if (groupbuy) {
    		$('#groupbuy').addClass('current');
    	}
    	if (xianshi) {
    		$('#xianshi').addClass('current');
    	}
    	if (virtual) {
    		$('#virtual').addClass('current');
    	}
    	if (ci) {
    		var ci_arr = ci.split('_');
    		for(var i in ci_arr) {
    			$('a[name="ci"]').each(function(){
    				if ($(this).attr('value') == ci_arr[i]) {
    					$(this).addClass('current');
    				}
    			});
    		}
    	}
    	$('#search_submit').click(function(){
    		var queryString = '?keyword=' + keyword, ci = '', sci = '';
    		queryString += '&district_id=' + $('#district_id').val();
    		if ($('#price_from').val() != '') {
    			queryString += '&price_from=' + $('#price_from').val();
    		}
    		if ($('#price_to').val() != '') {
    			queryString += '&price_to=' + $('#price_to').val();
    		}

            if ($('#points_from').val() != '') {
                queryString += '&points_from=' + $('#points_from').val();
            }

            if ($('#points_to').val() != '') {
                queryString += '&points_to=' + $('#points_to').val();
            }



    		if ($('#selfsupport')[0].className == 'current') {
    			queryString += '&selfsupport=1';
    		}
    		if ($('#gift')[0].className == 'current') {
    			queryString += '&gift=1&activity_type_ids[]=' + StateCode.ACTIVITY_TYPE_GIFT;
    		}
			if ($('#groupbuy')[0].className == 'current') {
				queryString += '&groupbuy=1&activity_type_ids[]=' + StateCode.ACTIVITY_TYPE_DIY_PACKAGE;
			}
			if ($('#xianshi')[0].className == 'current') {
				queryString += '&xianshi=1&activity_type_ids[]=' + StateCode.ACTIVITY_TYPE_LIMITED_DISCOUNT;
			}
			if ($('#virtual')[0].className == 'current') {
				queryString += '&virtual=1';
			}
    		$('a[name="ci"]').each(function(){
    			if ($(this)[0].className == 'current') {
    				ci += '&contract_type_ids[]=' + $(this).attr('value');
                    sci += $(this).attr('value') + '_';
    			}


    		});

    		if (ci != '') {
    			queryString += '&ci=' + sci + '&' + ci;
    		}

    		window.location.href = WapSiteUrl + '/tmpl/seller/supplier_product_list.html' + queryString;
    	});
    	$('a[sstype="items"]').click(function(){
    		var myDate = new Date();
    		if(myDate.getTime() - searchTimes > 300) {
    			$(this).toggleClass('current');
    			searchTimes = myDate.getTime();
    		}
    	});
    	$('input[sstype="price"]').on('blur',function(){
    		if ($(this).val() != '' && ! /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
    			$(this).val('');
    		}
    	});
    	$('#reset').click(function(){
    		$('a[sstype="items"]').removeClass('current');
    		$('input[sstype="price"]').val('');
    		$('#district_id').val('');
    	});
    }, {timeout: SYS.CACHE_EXPIRE * 24});
}

function init_get_list(order, k) {
    sord = order;
    sidx = k;
    curpage = 1;
    hasmore = true;
    $("#product_list .goods-secrch-list").html('');
    $('#footer').removeClass('posa');
    get_list();
}