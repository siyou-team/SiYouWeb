(function(_x17637){'use strict';var app=getApp(),$=require(_x17637[0]);Page({data:{url:_x17637[1]},onLoad:function(a){var e=this,r={userName:app[_x17637[4]][_x17637[3]][_x17637[2]],proId:a[_x17637[5]]};$[_x17637[6]]($[_x17637[7]](api[_x17637[8]],r),function(a){e[_x17637[9]]({url:a[_x17637[11]][0][_x17637[10]]});});}});}.call(this,['../../helpers/util.js','','user_account','userInfo','globalData','pid','xsr','makeUrl','GetProductInfo','setData','Video','Info']));