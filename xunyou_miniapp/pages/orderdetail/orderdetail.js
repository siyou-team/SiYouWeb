(function(_x54972){'use strict';var app=getApp(),$=require(_x54972[0]),notice=require(_x54972[1]);Page({data:{OrderInfo:{},formId:_x54972[2],pointAsCashMoney:_x54972[2],discount:_x54972[2],MemberDiscount:_x54972[2],showRPK:!0,ActivityGroupId:0,maxRPK:0,deduction:0,StateCode:app[_x54972[3]]},call:function(){wx[_x54972[4]]({phoneNumber:this[_x54972[7]][_x54972[6]][_x54972[5]]+_x54972[2]});},onLoad:function(a){this[_x54972[8]]({discount:a[_x54972[9]],pointAsCashMoney:a[_x54972[10]],MemberDiscount:a[_x54972[11]]});var e=this;$[_x54972[12]](app[_x54972[14]][_x54972[13]])?app[_x54972[15]](function(t){t&&e[_x54972[16]](a);},a[_x54972[17]]):setTimeout(function(){e[_x54972[16]](a);},1000),wx[_x54972[18]]();},InitPage:function(a){var e={user_id:app[_x54972[14]][_x54972[13]][_x54972[19]],order_id:a[_x54972[20]]},t=this;$[_x54972[21]]({url:app[_x54972[25]][_x54972[24]][_x54972[23]][_x54972[22]],data:e,success:function(a,e,o,n){200==e&&(a[_x54972[26]]=$[_x54972[27]](a[_x54972[26]]),t[_x54972[8]]({OrderInfo:a,deduction:0}));}});},cancelOrder:function(a){var e={order_id:a[_x54972[29]][_x54972[28]][_x54972[20]]};$[_x54972[30]](_x54972[31],function(a){a[_x54972[30]]&&$[_x54972[21]]({url:app[_x54972[25]][_x54972[24]][_x54972[23]][_x54972[32]],data:e,success:function(a,e,t,o){200==e&&$[_x54972[33]](_x54972[34],function(){$[_x54972[35]](1,function(){var a={};notice[_x54972[36]](_x54972[37],a);});});}});},!0);},gotopay:function(a){this[_x54972[8]]({formId:a[_x54972[39]][_x54972[38]]});var e={order_id:this[_x54972[7]][_x54972[6]][_x54972[40]],openid:app[_x54972[14]][_x54972[13]][_x54972[41]],typ:_x54972[42],payment_channel_code:_x54972[43],prepay_flag:1},t=this;$[_x54972[21]]({url:app[_x54972[25]][_x54972[24]][_x54972[44]][_x54972[44]],data:e,success:function(a,e,o,n){200==e?wx[_x54972[45]]({timeStamp:a[_x54972[46]],nonceStr:a[_x54972[47]],'package':a[_x54972[48]],signType:a[_x54972[49]],paySign:a[_x54972[50]],success:function(a){t[_x54972[51]](t[_x54972[7]][_x54972[6]][_x54972[40]]),$[_x54972[33]](_x54972[52],function(){$[_x54972[35]](1,function(){var a={};notice[_x54972[36]](_x54972[37],a);});});},fail:function(a){$[_x54972[33]](_x54972[53]),console[_x54972[54]](_x54972[55],a);}}):$[_x54972[33]](o);},fail:function(a){}});},sendMessage:function(a){var e={api:orderapi[_x54972[56]],pages:_x54972[57]+a,formId:this[_x54972[7]][_x54972[38]],WeiXinOpenId:app[_x54972[14]][_x54972[13]][_x54972[41]],value:{store_id:app[_x54972[14]][_x54972[59]][_x54972[58]],order_id:a}};$[_x54972[60]](e);},onShareAppMessage:function(){var a=this;return{title:_x54972[61]+this[_x54972[7]][_x54972[62]]+_x54972[63],imageUrl:_x54972[64],path:_x54972[65]+this[_x54972[7]][_x54972[66]]+_x54972[67]+this[_x54972[7]][_x54972[62]]+_x54972[68]+app[_x54972[14]][_x54972[70]][_x54972[69]],success:function(){$[_x54972[71]]($[_x54972[72]](orderapi[_x54972[73]],{sponsorId:app[_x54972[14]][_x54972[70]][_x54972[69]],audienceType:1,audienceId:0,ContentType:22,contentId:a[_x54972[7]][_x54972[66]]}),function(a){});}};},shareQRCode:function(a){var e=this,t={store_id:app[_x54972[14]][_x54972[59]][_x54972[69]],sponsorId:app[_x54972[14]][_x54972[70]][_x54972[69]],imageUrl:_x54972[64],path:_x54972[65]+this[_x54972[7]][_x54972[66]]+_x54972[67]+this[_x54972[7]][_x54972[62]]+_x54972[68]+app[_x54972[14]][_x54972[70]][_x54972[69]],luckyOrder:this[_x54972[7]][_x54972[62]]};$[_x54972[21]]({url:app[_x54972[25]][_x54972[24]][_x54972[75]][_x54972[74]],data:t,success:function(a,t,o,n){e[_x54972[8]]({PageQRCodeInfo:{Path:a[_x54972[76]],IsShare:!0,IsShareBox:!1,IsJT:!0}});}});},shareBox:function(){this[_x54972[8]]({PageQRCodeInfo:{Path:_x54972[2],IsShare:!0,IsShareBox:!0,IsJT:!1}});},cancelShare:function(){this[_x54972[8]]({PageQRCodeInfo:{Path:_x54972[2],IsShare:!1,IsShareBox:!1,IsJT:!1}});},saveImg:function(){var a=this;$[_x54972[77]](),wx[_x54972[78]]({url:this[_x54972[7]][_x54972[80]][_x54972[79]],success:function(e){$[_x54972[81]](),wx[_x54972[82]]({filePath:e[_x54972[83]],success:function(){a[_x54972[8]]({PageQRCodeInfo:{Path:_x54972[2],IsShare:!1,IsShareBox:!1,IsJT:!1}}),$[_x54972[33]](_x54972[84]),$[_x54972[71]]($[_x54972[72]](orderapi[_x54972[73]],{sponsorId:app[_x54972[14]][_x54972[70]][_x54972[69]],audienceType:3,audienceId:0,ContentType:22,contentId:a[_x54972[7]][_x54972[66]]}));},fail:function(a){$[_x54972[81]](),$[_x54972[33]](_x54972[85]),console[_x54972[54]](_x54972[86],a);}});},fail:function(a){$[_x54972[81]]();}});},showCodeImg:function(){wx[_x54972[87]]({current:this[_x54972[7]][_x54972[80]][_x54972[79]],urls:[this[_x54972[7]][_x54972[80]][_x54972[79]]]});},IsShowRPK:function(){var a=this;a[_x54972[7]][_x54972[88]]?setTimeout(function(){a[_x54972[8]]({showRPK:!1});},250):a[_x54972[8]]({showRPK:!0});}});}.call(this,['../../helpers/util.js','../../helpers/notice.js','','StateCode','makePhoneCall','chain_mobile','OrderInfo','data','setData','discount','pointAsCashMoney','MemberDiscount','isNull','userInfo','globalData','getUserInfo','InitPage','uid','hideShareMenu','user_id','on','request','order_detail','user','URL','Config','order_time','datetimeFormatter','dataset','currentTarget','confirm','\u662f\u5426\u53d6\u6d88\u8ba2\u5355','order_cancel','alert','\u53d6\u6d88\u6210\u529f\uff01','navigateBack','postNotificationName','RefreshMessage','formId','detail','order_id','openId','json','wx_native','pay','requestPayment','timeStamp','nonceStr','package','signType','paySign','sendMessage','\u652f\u4ed8\u6210\u529f\uff01','\u652f\u4ed8\u5931\u8d25\uff01','log','\u652f\u4ed8\u5931\u8d25\uff1a','OrderPaySuccessWXMessage','pages/orderdetail/orderdetail?on=','store_id','shopInfo','sendTpl','\u62fc\u624b\u6c14\u7ea2\u5305\uff0c\u7b2c','maxRPK','\u4e2a\u9886\u53d6\u7684\u7ea2\u5305\u6700\u5927!','https://static.shopsuite.cn/xcxfile/appicon/shareImg.png','pages/redpacket/redpacket?g=','ActivityGroupId','&n=','&uid=','Id','UserInfo','xsr1','makeUrl','ShareCount','getMiniAppQRCodeUnlimit','wx','url','loading','downloadFile','Path','PageQRCodeInfo','hideloading','saveImageToPhotosAlbum','tempFilePath','\u4fdd\u5b58\u56fe\u7247\u6210\u529f\uff01','\u4fdd\u5b58\u56fe\u7247\u5931\u8d25\uff01','\u4fdd\u5b58\u56fe\u7247\u5931\u8d25\uff1a','previewImage','showRPK']));