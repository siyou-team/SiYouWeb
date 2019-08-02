
wx.config({
    debug: false,
    appId: '<?=$data['appId']?>',
    timestamp: <?=$data['timestamp']?>,
    nonceStr: '<?=$data['nonceStr']?>',
    signature: '<?=$data['signature']?>',
    href: '<?=$data['data']['href']?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
});
