(function(_x10825){'use strict';var app=getApp(),$=require(_x10825[0]),notice=require(_x10825[1]),WxParse=require(_x10825[2]),thatProm={ProductInfo:{},addCar:!1,count:0,windowHeight:0,categoryname:_x10825[3],click6:!0,cid:0,cartlist:{},isdata:!1,Sel_Id:[],tapindex:1,viewtype:0,shopInfo:{},pdlist:[],sort:2,ispage:!0,flag:!0,distance:0,istop:!1,TemplateKey:_x10825[3],smallCategory:{},AdContent:{},post:{store_id:0,orderby:1,sort:2,isnew:!1,curpage:1},formdate:_x10825[3],pageId:0};Page({data:{Coupons:[],isCancelSuccess:!0,isCancel:!0,CouponAmount:0,IsNewUser:0,PageContent:[],BgConfig:{},TemplateKey:_x10825[3],commonTPL:thatProm,indexArray:[],splist:[],splistStr:[],pid:0,index:0,ShareImg:_x10825[3],ShareTitle:_x10825[3],refresh:!0},onLoad:function(e){var a=this,t=wx[_x10825[5]]()[_x10825[4]];a[_x10825[6]]({w:t}),app[_x10825[7]](function(e){app[_x10825[8]](function(t){a[_x10825[9]](),e&&a[_x10825[6]]({IsNewUser:app[_x10825[12]][_x10825[11]][_x10825[10]],CouponAmount:app[_x10825[12]][_x10825[11]][_x10825[13]]}),notice[_x10825[14]](_x10825[15],a[_x10825[15]],a);try{thatProm[_x10825[16]]=wx[_x10825[5]]()[_x10825[16]]-50,a[_x10825[6]]({commonTPL:thatProm});}catch(o){console[_x10825[17]](_x10825[18],o);}});},e[_x10825[19]],e[_x10825[20]]);},onReady:function(){},onShow:function(){$[_x10825[21]](app[_x10825[12]][_x10825[22]])||wx[_x10825[23]]({title:app[_x10825[12]][_x10825[22]][_x10825[24]]}),this[_x10825[26]][_x10825[25]]||this[_x10825[6]]({refresh:!0});},onHide:function(){},onUnload:function(){var e=this;notice[_x10825[27]](_x10825[15],e);},onPullDownRefresh:function(){this[_x10825[6]]({indexArray:[]}),this[_x10825[9]]();},onReachBottom:function(){},onShareAppMessage:function(){return{title:this[_x10825[26]][_x10825[28]],imageUrl:this[_x10825[26]][_x10825[29]],path:_x10825[30]+app[_x10825[12]][_x10825[11]][_x10825[31]]};},onPageScroll:function(){},getDivModel:function(){var e=this,a={};$[_x10825[32]]({url:app[_x10825[35]][_x10825[34]][_x10825[33]],data:a,ajaxCache:{timeout:app[_x10825[35]][_x10825[36]]},success:function(a,t,o,n){wx[_x10825[37]](),e[_x10825[6]]({pageId:a[_x10825[38]],PageContent:$[_x10825[39]](a[_x10825[40]]),BgConfig:$[_x10825[39]](a[_x10825[41]]),ShareImg:a[_x10825[42]],ShareTitle:a[_x10825[43]]});for(var i in e[_x10825[26]][_x10825[44]])2==e[_x10825[26]][_x10825[44]][i][_x10825[45]]&&WxParse[_x10825[46]](_x10825[47]+i,_x10825[48],e[_x10825[26]][_x10825[44]][i][_x10825[50]][_x10825[26]][_x10825[49]],e);}});},RefreshProduct:function(e){e?this[_x10825[6]]({refresh:!0}):this[_x10825[6]]({refresh:!1});},initData:function(){var e=this;wx[_x10825[23]]({title:app[_x10825[12]][_x10825[22]][_x10825[24]]}),thatProm[_x10825[51]]=app[_x10825[12]][_x10825[22]][_x10825[52]]>1000?_x10825[53]:app[_x10825[12]][_x10825[22]][_x10825[52]],_x10825[53]==thatProm[_x10825[51]]&&_x10825[53]==thatProm[_x10825[51]]&&e[_x10825[54]](),e[_x10825[6]]({TemplateKey:thatProm[_x10825[51]],commonTPL:thatProm});},doReceive:function(){this[_x10825[55]](),this[_x10825[56]]();},cancel:function(){this[_x10825[6]]({isCancel:!1});},cancelsuccess:function(){this[_x10825[6]]({isCancelSuccess:!0});},innertouch:function(){},userReceiveCoupon:function(){var e={CouponIds:_x10825[3],IsNewUser:this[_x10825[26]][_x10825[10]]},a=this;$[_x10825[32]]({url:app[_x10825[35]][_x10825[34]][_x10825[58]][_x10825[57]],data:e,success:function(e,t,o,n){200==t?a[_x10825[6]]({isCancelSuccess:!1,Coupons:e[_x10825[59]]}):$[_x10825[60]](o);}});},tplGoToPage:function(e){var a=e[_x10825[62]][_x10825[61]];switch(parseInt(a[_x10825[63]])){case 1:$[_x10825[64]](_x10825[65]+a[_x10825[66]]);break;case 2:$[_x10825[64]](_x10825[67]+(a[_x10825[66]]||0)+_x10825[68]+a[_x10825[24]]);break;case 3:$[_x10825[64]](_x10825[69]+a[_x10825[70]]);break;case 4:$[_x10825[64]](a[_x10825[71]]);break;case 5:$[_x10825[64]](a[_x10825[71]]);break;case 6:$[_x10825[64]](a[_x10825[71]]);break;case 7:wx[_x10825[72]]({appId:a[_x10825[73]],path:a[_x10825[71]]||_x10825[3]});break;case 8:$[_x10825[64]](_x10825[74]+a[_x10825[66]]);break;case 9:$[_x10825[64]](_x10825[75]+encodeURIComponent(a[_x10825[71]])+_x10825[76]+a[_x10825[24]]+_x10825[77]+a[_x10825[73]]+_x10825[78]+a[_x10825[70]]);}}});}.call(this,['../../helpers/util.js','../../helpers/notice.js','../../wxParse/wxParse.js','','windowWidth','getSystemInfoSync','setData','getUserInfo','getPlantformInfo','initData','IsNewUser','userInfo','globalData','CouponAmount','addNotification','RefreshProduct','windowHeight','log',' Do something when catch error','uid','sid','isNull','plantformInfo','setNavigationBarTitle','name','refresh','data','removeNotification','ShareTitle','ShareImg','/pages/index/index?uid=','user_id','request','index_app','URL','Config','CACHE_EXPIRE','stopPullDownRefresh','page_id','parseJSON','page_code','page_config','page_share_image','page_share_title','PageContent','eltmType','wxParse','word','html','words','eltm2','TemplateKey','plantform_template','shopdiy','getDivModel','cancel','userReceiveCoupon','voucher_add','user','items','confirm','dataset','currentTarget','type','navigateTo','../productdetail/productdetail?pid=','id','../productlist/productlist?store_category_id==','&cname=','../productlist/productlist?pname=','keyword','appurl','navigateToMiniProgram','appid','../diy-page/diy-page?id=','../webpage/webpage?u=','&tn=','&tc=','&tb=']));