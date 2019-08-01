<?php
include __DIR__ . '/includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>附近的店铺</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta name="author" content="talon">
    <meta name="application-name" content="niuniuhui-wap">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="format-detection" content="telephone=no" />

    <link rel="stylesheet" type="text/css" href="css/near.css">

    <script type="text/javascript" src="js/config.js"></script>
    <script type="text/javascript" src="js/libs/lib.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/libs/swipe.js"></script>
    <script type="text/javascript" src="js/tmpl/footer.js"></script>
    <script type="text/javascript" src="js/libs/vue.min.js"></script>
    <script type="text/javascript" src="js/libs/vue-resource.min.js"></script>

</head>
<body>
<div id="app">

    <div class="list"  v-scroll="getMore">
        <!--附近商家-->
        <section class="nearby-shops">
            <div class="tip-box">
                <span class="title">附近商家</span>
                <span class="line"></span>
            </div>
            <div class="shops-list">

                <div class="one-shop" v-for="business in businessList">
                    <a v-bind:href="'/index/index/storeindex?storeid='+business.id" v-if="business.isadvert != 1">
                        <div class="tl-grid-2-5">
                            <img src="./images/o2o_store.jpeg" />
                        </div>
                        <div class="tl-grid-3-5">
                            <div class="item">
                                        <span class="name" v-html="business.store_name">

                                        </span>
                                <span class="tl-fr time" v-html="business.store_opening_hours+'-'+business.store_close_hours"></span>
                            </div>
                            <div class="item">
                                <span class="star" v-for="scores in business.scores_arr"><i class="zc zc-start red" style="font-size: 12px;"></i></span>

                                <span class="star-half" v-if="business.scores_half == 1"></span>
                                <span v-html="business.store_evaluation_rate"></span>分


                                <!-- <span class="tl-fr red">积分</span><span class="tl-fr red" v-html="business.reutnproportion"></span> <span class="tl-fr red">送</span> -->
                                <div class="tl-fr red" v-if="business.store_points_consume_rate != 0">送<span v-html="business.store_points_consume_rate +'%'"></span>积分</div>
                            </div>
                            <div class="item">
                                <span class="addr"><i class="zc zc-peisongdizhi"></i></span>
                                <span v-html="business.store_circle"></span>
                                <span v-html="business.product_category_ids"></span>
                                <span class="tl-fr" v-html="business.distance"></span>
                            </div>
                            <div class="item">
                                <span v-if="business.isdelivery == 1" ><span class="song">送</span>起送<span v-html="business.delivery" ></span>元</span>
                                <span v-if="business.actualfreight <= 0">
                                          免费配送
                                        </span>
                                <span v-else>
                                          配送费<span v-html="business.actualfreight" ></span>元
                                        </span>
                                <span style="float: right"><span v-html="business.salecount"></span>人已消费</span>
                            </div>
                        </div>
                    </a>
                    <section class="recom-wrap" v-else>
                        <a :href="business.wapurl+'&dev_type=wap'"  >
                            <img :src="business.store_logo" />
                        </a>
                    </section>
                </div>
                <div>
                    <div>

                        <p class="loading" v-show="!switchShow">没有更多了...</p>
                    </div>
                </div>
        </section>
    </div>
    <!--/end 附近商家-->

</div>
</body>
</html>
<!-- Initialize Swiper -->
<script>
  // var swiper = new Swiper('.swiper-container', {
  //         pagination: '.swiper-pagination',
  //         paginationClickable: true
  //     });
</script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=dcc7a8bcf5dd15a02336fa3fa263d724"></script>
<script>

  var Vm = new Vue({
    el: '#app',
    data: {
      // 页面约定的参数
      apiUrl:SYS.URL.store.near,
      page:1,
      banners:[],
      city:'上海市',
      businessList:[],
      menus: [

      ],
      switchShow:false,
      lngx:'',
      laty:'',
      map:{},
      geolocation:{},
      city_id:'310117',
      maxPage:'',
      modulebanner:[],
      announcement:[]
    },
    created:function(){



    },
    mounted: function() {
      var _this=this;
      // 页面初始化时执行的方法
      if(_this.city_id =='' || _this.lngx=='' || _this.lngx=='' ){
        _this.maps();
      }else{
        _this.getCityInfo();
        _this.getStoList(_this.page);
      }

      _this.getCategory();
      $(window).scroll(function() {

        if( $(window).scrollTop()>44){
          $(".search-wrap").css("background","#F13437");
        }else{
          $(".search-wrap").css("background","linear-gradient( rgba(0, 0, 0, 0.5), rgba(153, 153, 153, 0))");
        }
      });

    },
    watch:{

    },

    methods: {

      maps:function(){
        var _this = this;

        //加载地图，调用浏览器定位服务
        _this.map = new AMap.Map('container', {
          resizeEnable: true
        });
        _this.map.plugin('AMap.Geolocation', function() {
          _this.geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,//是否使用高精度定位，默认:true
            timeout: 10000,          //超过10秒后停止定位，默认：无穷大
            buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
            zoomToAccuracy: true,      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
            buttonPosition:'RB'
          });
          _this.map.addControl(_this.geolocation);
          _this.geolocation.getCurrentPosition();

          AMap.event.addListener(_this.geolocation, 'complete', _this.onComplete);//返回定位信息
          AMap.event.addListener(_this.geolocation, 'error', _this.onError);      //返回定位出错信息
        });
      },
      onComplete:function(data){

        var _this = this;
        var str='定位成功';

        _this.lngx =  data.position.getLng();
        _this.laty =  data.position.getLat();

        _this.getCityInfo();
        _this.getStoList(_this.page);
      },
      onError:function(data){
        var str='定位失败';
        var _this = this;
        _this.lngx =  '113.94303';//data.position.getLng();
        _this.laty =  '22.54023';//data.position.getLat();
        if(_this.city_id ==''){
          _this.city_id ='440305';
        }
        _this.getCityInfo();
        _this.getStoList(_this.page);
      },
      getCityInfo:function(){
        var _this=this;

        _this.$http.post('./getLngLatAddress.php',{

          lngx:_this.lngx,
          laty:_this.laty
        }).then(
          function (res) {
            // 处理成功的结果
            //console.log(res);

            data = eval("("+res.body+")");
            //console.log(data);
            if(data.status=='200'){

              if(_this.city ==''){
                _this.city = data.data.city;
              }
              if(_this.city_id ==''){
                _this.city_id = data.data.citycode;
              }
              //_this.getStobanner();
            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }

          },function (res) {
            // 处理失败的结果
            layer.open({
              content: '加载数据错误！请重新请求',
              skin: 'msg',
              time: 2
            });
          }
        );

      },
      // 自定义方法
      getMore: function() {
        var _this = this;

        _this.switchShow = !_this.switchShow;
        _this.page++;

        if(_this.page<=_this.maxPage){
          _this.getStoList(_this.page);
        }else{
          _this.switchShow = false;
          $(".loading").hide();
          return ;
        }
        // _this.getStoList(_this.page);

      },
      getStobanner:function(){
        var _this = this;

        _this.$http.post('/index/index/getStobanner',{
          city_id:_this.city_id,

        }).then(
          function (res) {
            // 处理成功的结果
            //console.log(res);
            //console.log("=============");
            data = eval("("+res.body+")");

            if(data.status=='200'){
              _this.banners = data.data;
              _this.$nextTick(function () {
                var swiper = new Swiper('.banner-swiper', {
                  pagination: '.swiper-pagination',
                  autoplay : 3000,
                  paginationClickable: true
                });

              });
            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }
            //$("#city").val('');
          },function (res) {
            // 处理失败的结果
            layer.open({
              content: '加载数据错误！请重新请求',
              skin: 'msg',
              time: 2
            });
          }
        );
      },
      getStoList:function(){
        var _this=this;


        _this.$http.post(_this.apiUrl,{
          coordinate:{'lat':_this.laty, 'lng':_this.lngx},
          city_id:_this.city_id,
          lngx:_this.lngx,
          laty:_this.laty,
          page:_this.page

        }).then(
          function (res) {
            // 处理成功的结果
            console.log(res);
            //console.log("=============");
            data = res.body;

            console.log(data);
            if(data.status=='200'){


              //_this.modulebanner = data.data.modulebanner


              //_this.announcement = data.data.announcement;



              if(_this.page == 1){
                _this.businessList = data.data.items;

              }else{
                _this.businessList = _this.businessList.concat(data.data.items);
              }

              _this.announcement = data.data.announcement;
              _this.$nextTick(function () {
                var  pro_with=$(".weekly-list .one-good").width();
                //这里设置宽高一样
                $(".weekly-list .one-good img").css({
                  "with":pro_with,
                  'height':pro_with
                });

                /*
                var newsSwiper = new Swiper('.news-swipers', {
                    //pagination: '.swiper-pagination',
                    autoplay : 3000,
                    //loop : true,
                    // autoHeight: true,
                    height:20,
                    slidesPerGroup : 2,
                    direction : 'vertical'
                });
                */
              })
              //alert(res.body);
              //_this.personInfo=res.body.personInfo;
              _this.maxPage = data.data.total;
              _this.switchShow = !_this.switchShow;
            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }
            //$("#city").val('');
          },function (res) {
            // 处理失败的结果
            layer.open({
              content: '加载数据错误！请重新请求',
              skin: 'msg',
              time: 2
            });
          }
        );
      },
      getCategory:function(){
        var _this = this;

        _this.$http.post('./getStoCategory.php',{


        }).then(
          function (res) {
            // 处理成功的结果
            //console.log(res);
            //console.log("=============");
            data = eval("("+res.body+")");

            if(data.status=='200'){
              _this.menus = data.data;

            }else{
              layer.open({
                content: data.msg,
                skin: 'msg',
                time: 2
              });
              return false;
            }
            //$("#city").val('');
          },function (res) {
            // 处理失败的结果

            layer.open({
              content: '加载数据错误！请重新请求',
              skin: 'msg',
              time: 2
            });
          }
        );
      }

    },directives: { // 自定义指令
      scroll: {
        bind: function(el, binding) {
          window.addEventListener('scroll', function() {
            if(document.body.scrollTop + window.innerHeight+20 >= el.clientHeight) {
              var fnc = binding.value;
              fnc();
            }
          })
        }
      }
    }
  });

</script>

<?php
include __DIR__ . '/includes/footer.php';
?>


