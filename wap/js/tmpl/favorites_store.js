$(function(){
	var key = getLocalStorage('ukey');
	if(!key){
		location.href = 'login.html';
	}
	//渲染list
	var load_class = new ssScrollLoad();
	load_class.loadInit({
		'url': SYS.URL.user.wish_store_lists,
		'getparam':{},
		'tmplid':'sfavorites_list',
		'containerobj':$("#favorites_list"),
		'iIntervalId':true,
		'data':{WapSiteUrl:WapSiteUrl}
	});

	$("#favorites_list").on('click',"[shopsuite_type='fav_del']",function(){
		var favorites_store_id = $(this).attr('data_id');
		var store_id = $(this).data('store_id');
		if (favorites_store_id <= 0) {
			$.sDialog({skin: "red", content: __('删除失败'), okBtn: false, cancelBtn: false});
		}
		if(dropFavoriteStore(store_id)){
			$("#favitem_"+favorites_store_id).remove();
			if (!$.trim($("#favorites_list").html())) {
				location.href = WapSiteUrl+'/tmpl/member/favorites_store.html';
			}
		}
	});
});