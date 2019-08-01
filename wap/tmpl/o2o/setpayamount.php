<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=__('扫码支付')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta name="author" content="talon">
    <meta name="application-name" content="niuniuhui-wap">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="format-detection" content="telephone=no" />

    <link rel="stylesheet" type="text/css" href="../../css/baguettebox.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/amazeui.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/near.css">

    <script type="text/javascript" src="../../js/config.js"></script>
    <script type="text/javascript" src="../../js/libs/lib.min.js"></script>
    <script type="text/javascript" src="../../js/libs/amazeui.min.js"></script>
    <script type="text/javascript" src="../../js/libs/baguettebox.min.js"></script>
    <script type="text/javascript" src="../../js/libs/vue.min.js"></script>
    <script type="text/javascript" src="../../js/libs/vue-resource.min.js"></script>
    <script type="text/javascript" src="../../js/libs/swipe.js"></script>
    <style>
        .pay-to{
            text-align: center;
            display: -webkit-box;
            font-size: 14px;
            padding: 20px;
        }
        .pay-to .avatar{width: 60px;height: 60px;border-radius: 50%;border: 2px solid #fff;}
        .pay-to .shop-box{display: -webkit-box;-webkit-box-flex: 1;width: 100%;-webkit-box-orient: vertical;-webkit-box-align: start;}
        .pay-to .shop-name{font-size: 20px;margin: 0 5px;max-width: 90%;margin-top: 4px;}
        .pay-to .shop-addr{color: #1C94E8;margin: 0 5px;max-width: 90%;    margin-top: 4px;}
        .pay-money{padding: 0 12px;}
        .pay-money .main{
            height: 120px;
            display: -webkit-box;
            -webkit-box-pack: center;
            -webkit-box-orient: vertical;
            padding: 0 20px;
            width: 100%;
            border-radius: 4px;
            font-size: 15px;
            margin-bottom: 60px;
        }
        .pay-money .main .item{
            display: -webkit-box;
            -webkit-box-align: center;
            height: 40px;
        }
        .pay-money .main .item-input{
            display: -webkit-box;
            -webkit-box-align: center;
            height: 60px;
            padding: 0 12px;
            border: 1px solid #DDDDDD;
            border-radius: 4px;

        }
        .pay-money .main .input {
            width: 100%;
            height: 50px;
            line-height: 50px;
            text-align: right;
            -webkit-box-flex: 1;
            -webkit-box-align: center;
            -webkit-box-pack: end;
            display: -webkit-box;
            background: url(http://image.niuniuhuiapp.com/mobile/img/icon/cursor.gif) right no-repeat;
        }
        .pay-money .main .input .m-ico{
            font-size: 22px;
            /*color: #999;*/
        }
        .pay-money .main .input .amount{font-size: 30px;margin-right: 3px;}

        .pay-money button{width: 100%;background: #F13437;height: 44px;border-radius: 4px;font-size: 16px;color: #FFFFFF;}
        .pay-money button:disabled{background: #CCCCCC;}



        /*数字面板*/
        .digital-btns{position: fixed;left:0;bottom: 0;width: 100%;display: -webkit-box;}
        .digital-btns .digitals{display: -webkit-box;width: 0;-webkit-box-flex: 4;-webkit-box-orient: vertical;}
        .digital-btns .digitals .row{display: -webkit-box;    width: 100%; }
        .digital-btns .digitals .row .num{
            display: -webkit-box;
            width:100%;
            -webkit-box-flex: 1;
            -webkit-box-pack: center;
            height: 44px;
            border: 0.5px solid #ddd;
            background: #fff;

        }
        .digital-btns .digitals .row .num.zero{
            border-right: 0;
        }
        .digital-btns .digitals .row .num.null{
            border: 0;
            border-top: 0.5px solid #DDDDDD;
            border-right: 0.5px solid #DDDDDD;
        }
        .digital-btns .digitals .row .num.point{

            border-left: 0.5px solid #DDDDDD;
        }
        .digital-btns .digitals .row .num button{
            border-radius: 0px;
            font-size: 26px;
            color: #333;
            background: #fff;

            width: 100%;
            display: -webkit-box;
        }
        .digital-btns .oper-btns{display: -webkit-box;width: 0;-webkit-box-flex: 1;    -webkit-box-orient: vertical;}
        .digital-btns .oper-btns .row{
            border: 0.5px solid #ddd;
            display: -webkit-box;
            height: 44px;
        }
        .digital-btns .oper-btns button{
            border-radius: 0px;
            font-size: 16px;
            color: #333;
            background: #fff;

            width: 100%;
            display: -webkit-box;
        }

        .digital-btns .oper-btns .sure-pay{
            border: 0.5px solid #ddd;
            display: -webkit-box;
        }


        .digital-btns .oper-btns .del-btn{

            /*background: url(http://image.niuniuhuiapp.com/mobile/img/icon/del.png) #fff center no-repeat;background-size:28px 20px;*/
            font-family: "zc";
            font-size: 30px;

        }
        .digital-btns .oper-btns .sure-btn{background: #0BBD05;color: #fff;height: 132px;}
        .digital-btns .oper-btns .sure-btn:disabled{background: #BEE0BD;color: #fff;}
    </style>
</head>
<body >
<div id="app">
    <header class="page-header">
        <div class="page-bar">
            <a href="javascript:history.go(-1);">
                <span class="back-ico"></span>
            </a>
            <!-- <span class="bar-title">扫码支付</span> -->
            <span class="bar-title"><?=__('向商户付款')?></span>
        </div>
    </header>



    <div class="pay-to">
        <img src="https://nnhtest.oss-cn-shenzhen.aliyuncs.com/nnh/images/2017-12-14/1513230212kpov6714.jpeg?x-oss-process=image/quality,q_80" class="avatar"/>
        <div class="shop-box">
            <div class="shop-name tl-ellipsis"><?=__('深圳青逸植发')?></div>
            <div class="shop-addr tl-ellipsis"><span class="c-666"><?=__('商户')?></span><?=__('深圳青逸植发')?></div>
        </div>
    </div>

    <div class="pay-money">
        <section class="main">
            <div class="item-input">
                <span class="c-999"><?=__('金额')?></span>

                <div class="input">
                    <div class="m-ico"><?=__('￥')?></div>

                    <div class="amount" id="amount"></div>
                </div>
                <!--	<div class="input" contenteditable="true"  id="aa"></div>-->

            </div>

            <div class="item">
                <span><?=__('实付金额')?>：</span><span id="discountamount">0</span>
            </div>
        </section>




        <div class="digital-btns">
            <div class="digitals">
                <div class="row">
                    <div class="num">
                        <button onclick="fillNum('1')">1</button>
                    </div>

                    <div class="num">
                        <button onclick="fillNum('2')">2</button>
                    </div>
                    <div class="num">
                        <button onclick="fillNum('3')">3</button>
                    </div>

                </div>
                <div class="row">
                    <div class="num">
                        <button onclick="fillNum('4')">4</button>
                    </div>

                    <div class="num">
                        <button onclick="fillNum('5')">5</button>
                    </div>
                    <div class="num">
                        <button onclick="fillNum('6')">6</button>
                    </div>
                </div>
                <div class="row">
                    <div class="num">
                        <button onclick="fillNum('7')">7</button>
                    </div>

                    <div class="num">
                        <button onclick="fillNum('8')">8</button>
                    </div>
                    <div class="num">
                        <button onclick="fillNum('9')">9</button>
                    </div>
                </div>
                <div class="row">
                    <div class="num zero">
                        <button onclick="fillNum('0')">0</button>
                    </div>
                    <div class="num null">
                        <button>&nbsp;</button>
                    </div>

                    <div class="num point">
                        <button onclick="fillNum('.')">.</button>
                    </div>
                </div>
            </div>
            <div class="oper-btns">
                <div class="row"><button class="del-btn" id="del-btn" onclick="backSpace()">&#xe655;</button></div>

                <div class="sure-pay"><button class="sure-btn" id="sure-btn" onclick="surePay()" disabled="disabled"><?=__('确认')?>：</br><?=__('支付')?></button></div>
            </div>


        </div>

    </div>


</div>
<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
    <div class="am-modal-dialog">
        <div class="am-modal-hd"><?=__('正在载入')?>...</div>
        <div class="am-modal-bd-loading">
            <span class="am-icon-spinner am-icon-spin"></span>
        </div>
    </div>
</div>
<script>
  var discount = "100";
  var business_code = "44109";
  var managerid = "15981";
  var pay_type = "web";
  //点击数字0-9 和“.”
  function fillNum(str){
    var temp;//中间变量，存当前的值
    var inputStr=document.getElementById("amount").innerText;

    temp=inputStr;
    inputStr+=str;


    var point=0;
    var arr=inputStr.split("");

    //第一次输入“.” 自动变为“0.”
    if(arr[0]=="."){
      document.getElementById("amount").innerText="0.";
      return;
    }

    //防止输入0[1-9]，如发生则变为[1-9]
    if(arr.length>=2){
      if(arr[0]=="0"&&arr[1]!="."){

        inputStr=inputStr.substr(1);
        document.getElementById("amount").innerText=inputStr;
        return;
      }
    }

    //防止两个“.”
    for(var i=0;i<arr.length;i++){
      if(arr[i]=="."){
        point++;
        if(point==2){
          document.getElementById("amount").innerText=temp;
          return;
        }
      }
    }

    //控制2位小数
    var arr2=inputStr.split(".");
    console.log(arr2);
    if(arr2.length==2){
      if(arr2[1].length>2){

        document.getElementById("amount").innerText=temp;
        return;
      }
    }

    //判断确认按钮是否可点
    if(parseFloat(inputStr)>0){
      document.getElementById("sure-btn").removeAttribute("disabled");
    }else{
      document.getElementById("sure-btn").setAttribute("disabled","disabled");
    }

    //不能超过10w
    if(parseFloat(inputStr)>99999.99){
      document.getElementById("amount").innerText=temp;
      return;
    }else{
      document.getElementById("amount").innerText=inputStr;
    }


    document.getElementById("discountamount").innerText=inputStr*discount/100;

  }
  //删格
  function backSpace(){
    var temp;//中间变量，存当前的值
    var inputStr=document.getElementById("amount").innerText;

    inputStr=inputStr.substr(0,inputStr.length-1);
    document.getElementById("amount").innerText=inputStr;

    //判断确认按钮是否可点
    if(parseFloat(inputStr)>0){
      document.getElementById("sure-btn").removeAttribute("disabled");
    }else{
      document.getElementById("sure-btn").setAttribute("disabled","disabled");
    }
    document.getElementById("discountamount").innerText=inputStr*discount/100;
  }
  //确认支付
  function surePay(){

    var inputStr= parseFloat(document.getElementById("amount").innerText);
    var discountamount= parseFloat(document.getElementById("discountamount").innerText);
    var pay_type = "web";
    var p_type = "";
    //if(confirm("确认支付"+inputStr+"元？")){
    $("#my-modal-loading").modal();

    $.ajax({
      type:'POST',
      data: {
        amount:inputStr,
        business_code:business_code,
        managerid:managerid,
        discountamount:discountamount
      },
      //async:false,
      traditional :true,
      dataType:'json',
      url:"/StoBusiness/Index/returnsign",
      success:function(res){
        $("#my-modal-loading").modal('close');
        data =  eval("("+res+")");

        console.log(data);

        if(data.code=='200'){

          var sign = data.data.sign;

          $("#my-modal-loading").modal();

          $.ajax({
            type:'POST',
            data: {
              amount:inputStr,
              business_code:business_code,
              managerid:managerid,
              sign:sign,
              discountamount:discountamount,
              pay_type:pay_type
            },
            //async:false,
            traditional :true,
            dataType:'json',
            url:"/StoBusiness/Index/addorder",
            success:function(res){
              $("#my-modal-loading").modal('close');
              data =  eval("("+res+")");
              if(data.code=='200'){
                // console.log(data);
                // return false;
                if(pay_type == 'weixin'){
                  callpay('',data.data.pay_code);
                }else if(pay_type =='ali'){
                  alipay(data.data.pay_code)
                }else{

                  window.location.href = '/sys/pay/paymethod?orderno='+ data.data.pay_code+'&p_type='+p_type;
                }
              }else{
                layer.open({
                  content: data.msg,
                  skin: 'msg',
                  time: 2
                });
                return false;
              }

            }
          });

        }
      }
    });


    //}
  }

  //旋转
  window.onorientationchange=function(){
    var obj=document.getElementById('app');

    if(window.orientation==0){

      obj.style.minHeight="auto";
    }else
    {
      //alert('横屏内容太少啦，请使用竖屏观看！');
      obj.style.minHeight="400px";
    }
  };
</script>
<script>

  // 阿里支付
  function alipay(orderno){
    var p_type = "";
    $("#my-modal-loading").modal();
    window.location.href="/Sys/Pay/aliwappayorder?orderno="+orderno+"&p_type="+p_type;
  }

  //调用微信JS api 支付
  var jsApiParameters = '';

  function jsApiCall(orderno){

    //console.log(jsApiParameters);
    jsApiParameters = eval("("+jsApiParameters+")");
    WeixinJSBridge.invoke(
      'getBrandWCPayRequest',
      jsApiParameters,
      function(res){
        console.log(res);
        WeixinJSBridge.log(res.err_msg);
        //alert("AAA:"+res.err_code+res.err_desc+res.err_msg);
        if(res.err_msg == "get_brand_wcpay_request:ok" ) {
          //支付成功
          // alert('支付成功');
          layer.open({
            content: '支付成功',
            skin: 'msg',
            time: 2
          });
          //支付结果
          window.location.href = "/Sys/Pay/payresult?orderno="+orderno+"&p_type="+p_type;;
        }

      }
    );
  }

  function callpay(url,orderno){
    $("#my-modal-loading").modal();

    if(typeof url=="undefined" || url=='')
      url = "/Sys/Pay/callpay?orderno="+orderno;

    $.get(url, function(data){
      $("#my-modal-loading").modal('close');
      //alert(data);
      console.log(data);
      var data_arr = eval("("+data+")");
      //alert(data_arr.code);
      if(data_arr.code=='200'){

        jsApiParameters = data_arr.data.jsApiParameters;
        //alert(jsApiParameters.appId);
        if (typeof WeixinJSBridge == "undefined"){
          //alert(3);
          if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
          }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
          }
        }else{
          //alert(111)
          jsApiCall(orderno);
        }
        loadtip({
          close:true
        });
      }else{

        loadtip({
          close:true,
          alert:data_arr.msg
        });

      }
    });

  }
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
