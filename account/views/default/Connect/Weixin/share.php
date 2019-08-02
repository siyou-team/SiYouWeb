
wx.config({
    debug: false,
    appId: '<?=$data['appId']?>',
    timestamp: <?=$data['timestamp']?>,
    nonceStr: '<?=$data['nonceStr']?>',
    signature: '<?=$data['signature']?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
});

wx.ready(function () {
    wx.onMenuShareTimeline({
        title: "<?=s('item_name')?>", //分享标题
        link: "<?=s('href')?>", //分享链接
        imgUrl: "http:<?=s('product_image')?>", //分享图标
        success: function () {
        },
        cancel: function () {
        }
    });
    wx.onMenuShareAppMessage({
        title: "<?=s('item_name')?>", //分享标题
        desc: "<?=s('product_tips')?>", //分享描述
        link: "<?=s('href')?>", //分享链接
        imgUrl: "http:<?=s('product_image')?>", //分享图标
        type: '',
        dataUrl: '',
        success: function () {
        },
        cancel: function () {
        }
    });

    /*
    wx.openAddress({
        success : function(result){
            
            //此处获取到地址信息，可做自己的业务操作
            alert(<?=__('收货人姓名')?> + result.userName);
            alert(<?=__('收货人电话')?> + result.telNumber);
            alert(<?=__('邮编')?> + result.postalCode);
            alert(<?=__('国标收货地址第一级地址')?> + result.provinceName);
            alert(<?=__('国标收货地址第二级地址')?> + result.cityName);
            alert(<?=__('国标收货地址第三级地址')?> + result.countryName);
            alert(<?=__('详细收货地址信息')?> + result.detailInfo);
            alert(<?=__('收货地址国家码')?> + result.nationalCode);
        }
    });
    */


});

_wap_wx = 0;