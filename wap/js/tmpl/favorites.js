$(function(){
    if (!ifLogin()){return}

    //渲染list
	var load_class = new ssScrollLoad();
	load_class.loadInit({
		'url': SYS.URL.user.wish_item_lists,
		'getparam':{},
		'tmplid':'sfavorites_list',
		'containerobj':$("#favorites_list"),
		'iIntervalId':true,
		'data':{WapSiteUrl:WapSiteUrl}
	});

	$("#favorites_list").on('click',"[shopsuite_type='fav_del']",function(){
		var favorites_item_id = $(this).attr('data_id');
		if (favorites_item_id <= 0) {
			$.sDialog({skin: "red", content: __('删除失败'), okBtn: false, cancelBtn: false});
		}
		if(dropFavoriteGoods(favorites_item_id)){
			$("#favitem_"+favorites_item_id).remove();
			if (!$.trim($("#favorites_list").html())) {
				location.href = WapSiteUrl+'/tmpl/member/favorites.html';
			}
		}
	});
});