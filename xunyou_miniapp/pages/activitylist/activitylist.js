(function(_x10862){'use strict';var app=getApp(),$=require(_x10862[0]);Page({data:{page:1,ispage:!1,flag:!0,Info:[],windowHeight:0},onLoad:function(t){try{var a=wx[_x10862[1]]();this[_x10862[2]]({windowHeight:a[_x10862[3]]});}catch(e){console[_x10862[4]](_x10862[5]);}this[_x10862[6]]();},getActivitylist:function(){var t={page:this[_x10862[8]][_x10862[7]],store_id:app[_x10862[11]][_x10862[10]][_x10862[9]]},a=this;$[_x10862[12]]({url:app[_x10862[16]][_x10862[15]][_x10862[14]][_x10862[13]],data:t,success:function(t,e,i,s){200==e&&t[_x10862[18]][_x10862[17]]>0?(a[_x10862[2]]({flag:!1}),a[_x10862[2]]({ispage:!0,Info:a[_x10862[8]][_x10862[20]][_x10862[19]](t[_x10862[18]])})):a[_x10862[2]]({flag:!1,ispage:!0});}});},scrollbottom:function(){if(this[_x10862[8]][_x10862[21]]){var t=this;t[_x10862[2]]({flag:!1}),clearTimeout(a);var a=setTimeout(function(){t[_x10862[2]]({type:t[_x10862[8]][_x10862[22]],page:parseInt(t[_x10862[8]][_x10862[7]])+1,rows:10}),t[_x10862[6]]();},500);}}});}.call(this,['../../helpers/util.js','getSystemInfoSync','setData','windowHeight','log',' Do something when catch error','getActivitylist','page','data','store_id','shopInfo','globalData','request','listsMarketing','user','URL','Config','length','items','concat','Info','flag','type']));