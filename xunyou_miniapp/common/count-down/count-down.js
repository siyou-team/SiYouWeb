var $ = require("../../helpers/util.js");Component({properties:{millisecond:Number||1,Type:Number||0},data:{time:""},ready:function(){var e=this.data.millisecond,t=this;setInterval(function(){e-=1e3;if(e<=0){clearInterval();var n="00",r="00",i="00",s="00";t.data.Type==2?n=="00"?t.setData({time:r+":"+i+":"+s}):t.setData({time:n+"天"+r+":"+i+":"+s}):n=="00"?t.setData({time:(t.data.Type==0?"距开始":"仅剩")+" "+r+":"+i+":"+s}):t.setData({time:(t.data.Type==0?"距开始":"仅剩")+" "+n+"天"+r+":"+i+":"+s})}else{var n=$.doubleNum(Math.floor(e/1e3/60/60/24)),r=$.doubleNum(Math.floor(e/1e3/60/60%24)),i=$.doubleNum(Math.floor(e/1e3/60%60)),s=$.doubleNum(Math.floor(e/1e3%60));t.data.Type==2?n=="00"?t.setData({time:r+":"+i+":"+s}):t.setData({time:n+"天"+r+":"+i+":"+s}):n=="00"?t.setData({time:(t.data.Type==0?"距开始":"仅剩")+" "+r+":"+i+":"+s}):t.setData({time:(t.data.Type==0?"距开始":"仅剩")+" "+n+"天"+r+":"+i+":"+s})}},1e3)}});