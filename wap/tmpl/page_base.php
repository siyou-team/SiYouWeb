
    <link rel="stylesheet" type="text/css" href="../css/near.css">
    <link rel="stylesheet" type="text/css" href="../css/preview.css">

    <script type="text/javascript" src="../js/config.js"></script>
    <script type="text/javascript" src="../js/libs/preview.min.js"></script>
    <script type="text/javascript" src="../js/libs/vue-resource.min.js"></script>

<div class="m-phone" id="app" :style="{background:(PageConfig.BackgroundObj.type==1?PageConfig.BackgroundObj.bgColor:'url('+PageConfig.BackgroundObj.path+') no-repeat '+PageConfig.BackgroundObj.pathColor+' ')}">
    <div class="pagexd">
        <div class="weui-tabbar" v-if="appConfig.tabBar.position=='bottom'" :style="{color:appConfig.tabBar.color,backgroundColor:appConfig.tabBar.backgroundColor }" >
                        <span class="weui-tabbar__item weui-bar__item_on" v-for="(item,index) in appConfig.tabBar.list" >
                            <div v-if="index==0" :style="{color:appConfig.tabBar.selectedColor}" >
                                <span>
                                    <img :src="item.selectedIconPath || 'shop_admin/static/src/common/images/diy/img/icon_tabbar.png' " alt="" class="weui-tabbar__icon" >
                                </span>
                                <p class="weui-tabbar__label" >{{item.text}}</p>
                            </div>
                            <div  v-if="index>0">
                                <span>
                                    <img :src="item.iconPath || 'shop_admin/static/src/common/images/diy/img/icon_tabbar.png'" alt="" class="weui-tabbar__icon"  >
                                </span>
                                <p class="weui-tabbar__label" >{{item.text}}</p>
                            </div>
                        </span>
        </div>

        <div class="weui-navbar" v-if="appConfig.tabBar.position=='top'" :style="{color:appConfig.tabBar.color,backgroundColor:appConfig.tabBar.backgroundColor}" >
            <div class="weui-navbar__item" v-for="(item,index) in appConfig.tabBar.list"  >
                <label v-if="index==0" v-if="index" :style="{color:appConfig.tabBar.selectedColor}" >
                    {{item.text}}
                    <span :style="{backgroundColor:appConfig.tabBar.selectedColor}"></span>
                </label>
                <label v-if="index>0" v-if="index" >
                    {{item.text}}
                </label>
            </div>
        </div>

        <div v-if="IsPersonalCenter=='True'">
            <div class="m-banner-img">
                <div class="m-animate-warp" style="background:url(img/photo.png);background-size: cover;">
                    <div class="m-animate-img" style="background:url(img/photo.png);background-size: cover;"></div>
                </div>
                <div  class="m-user-info">
                    <image src="shop_admin/static/src/common/images/diy/img/photo.png" />
                    <label><?=__('昵称')?></label>
                </div>
            </div>
            <div class="g-flex m-od-tab">
                      <span  class="g-flex-item">
                        <div class="iconfont icon-daizhifu i-type"></div>
                        <?=__('待支付')?>
                      </span>
                <span  class="g-flex-item">
                        <div class="iconfont icon-zhifu i-type"></div>
                          <?=__('待收货')?>
                      </span>
                <div class="g-flex-item"></div>
                <span  class="g-flex-item">
                        <div class="iconfont icon-myiwancheng i-type"></div>
                          <?=__('已完成')?>
                      </span>
                <span  class="g-flex-item">
                        <div class="iconfont icon-quanbudingdan i-type"></div>
                      <?=__('全部订单')?>
                      </span>
            </div>
            <div class="iconBoxList" :class="{iconBoxLattice:PersonalCenter.PageCode.type==2}">
                <ul>
                    <li v-for="item in PersonalCenter.PageCode.list" v-if="item.isShow">
                        <div class="iconText">
                            <label class="iconfont" :class="item.icon" v-bind:style="{color:item.color}"></label><span>{{item.name}}</span>
                            <i class="iconfont icon-right"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pagexd" id="sortable_container" >
            <div v-for="item in info" class="dropItem">
                <div v-if="item.eltmType==1" v-bind:class="{ms:item.eltmType==1,s1:item.eltm1.layout==1,s2h:item.eltm1.layout==2,s2v:item.eltm1.layout==3,s4h:item.eltm1.layout==4,s4v:item.eltm1.layout==5,s8h:item.eltm1.layout==6,s8v:item.eltm1.layout==7,s16:item.eltm1.layout==8,s250h:item.eltm1.layout==9,fl:item.eltm1.align==1,fr:item.eltm1.align==2}" v-bind:style="{
                                                            paddingTop:(item.eltm1.paddingTop/20)+'rem',
                                                            paddingBottom:(item.eltm1.paddingBottom/20)+'rem',
                                                            paddingLeft:(item.eltm1.paddingLeft/20)+'rem',
                                                            paddingRight:(item.eltm1.paddingRight/20)+'rem',
                                                            backgroundColor:item.bgColor
                                                            }"   :data-id="item.eltm1.data.id" :data-name="item.eltm1.data.name" :data-type="item.eltm1.data.selectType" :data-keyWord="item.eltm1.data.keyWord" :data-AppId="item.eltm1.data.AppId" :data-AppUrl="item.eltm1.data.AppUrl"  :data-MinAppUrl="item.MinAppUrl" @click="tplGoToPage">
                    <img v-if="item.eltm1.layout==1" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x750.png'" />
                    <img v-if="item.eltm1.layout==2" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x375.png'" />
                    <img v-if="item.eltm1.layout==3" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x750.png'" />
                    <img v-if="item.eltm1.layout==4" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x188.png'" />
                    <img v-if="item.eltm1.layout==5" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x375.png'" />
                    <img v-if="item.eltm1.layout==6" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x188.png'" />
                    <img v-if="item.eltm1.layout==7" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/188x375.png'" />
                    <img v-if="item.eltm1.layout==8" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/188x188.png'" />
                    <img v-if="item.eltm1.layout==9" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x500.png'" />
                </div>
                <div  v-if="item.eltmType==2" class="m-RichText" v-bind:style="{padding:item.eltm2.padding+ 'px',backgroundColor:item.bgColor}">
                    <div  v-html="item.eltm2.data.words">

                    </div>
                </div>

                <swiper ref="awesomeSwiperA"  @set-translate="onSetTranslate"   v-if="item.eltmType==3" class="m-scrollBox"  v-bind:style="{height:(item.eltm3.height/20)+ 'rem',lineHeight:(item.eltm3.height/20)+ 'rem',backgroundColor:item.bgColor}"  :options="{
        pagination: {
          el: '.swiper-pagination',
          dynamicBullets: true
        }}">
                    <img v-if="item.eltm3.data.length<=0" src="shop_admin/static/src/common/images/diy/img/375x200.png" />
                    <!-- slides -->
                    <swiper-slide v-for="items in item.eltm3.data"  :key="items.id">
                        <img :src="items.path || 'shop_admin/static/src/common/images/diy/img/375x200.png'"   :data-id="items.id" :data-name="items.name" :data-type="items.selectType" :data-keyWord="items.keyWord" :data-AppId="items.AppId" :data-AppUrl="items.AppUrl"  :data-MinAppUrl="item.MinAppUrl" @click="tplGoToPage" />
                    </swiper-slide>
                    <!-- Optional controls -->
                    <div class="swiper-pagination"  slot="pagination"  style="line-height: 10px;"></div><!--
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>-->
                </swiper>
                <!--
                <div  v-if="item.eltmType==3" class="m-scrollBox" v-bind:style="{height:(item.eltm3.height/20)+ 'rem',lineHeight:(item.eltm3.height/20)+ 'rem',backgroundColor:item.bgColor}">

                    <img v-if="item.eltm3.data.length<=0" src="shop_admin/static/src/common/images/diy/img/375x200.png" />
                    <img v-if="item.eltm3.data.length>0" :src="item.eltm3.data[0].path || 'shop_admin/static/src/common/images/diy/img/375x200.png'"  />
                    <div v-if="item.eltm3.data.length>0" class="m-scrollBox-bot" >
                        <div class="bot-item" v-for="item in item.eltm3.data"></div>
                    </div>
                </div>-->
                <div  v-if="item.eltmType==4" v-bind:class="{m_plist:item.eltmType==4,p1:item.eltm4.listTyle==1,p2:item.eltm4.listTyle==2,p3:item.eltm4.listTyle==3,p4:item.eltm4.listTyle==4}" v-bind:style="{backgroundColor:item.bgColor}">
                    <div class="m_pitem" v-if="item.eltm4.data.length<=0">
                        <div class="m_pinfo">
                            <div class="pimg">
                                <img v-if="item.eltm4.listTyle==1" src="shop_admin/static/src/common/images/diy/img/350x350.png" />
                                <img v-if="item.eltm4.listTyle==2" src="shop_admin/static/src/common/images/diy/img/180x180.png" />
                                <img v-if="item.eltm4.listTyle==3" src="shop_admin/static/src/common/images/diy/img/355x166.png" />
                                <img v-if="item.eltm4.listTyle==4" src="shop_admin/static/src/common/images/diy/img/140x140.png" />
                            </div>
                            <div class="pname">
                                <label>  <?=__('商品名称')?>   </label>
                            </div>
                            <div class="pprice" v-bind:style="{color:item.eltm4.priceColor}">
                                <label>￥</label>0.00
                            </div>
                            <div v-if="item.eltm4.btnType==1 || item.eltm4.btnType==2" v-bind:class="{c1:item.eltm4.btnType==1,c2:item.eltm4.btnType==2}">

                            </div>
                            <div v-if="item.eltm4.btnType==3" class="c3">
                                buy
                            </div>
                            <div v-if="item.eltm4.btnType==4" class="c4" v-bind:style="{backgroundColor:item.eltm4.btnColor,color:item.eltm4.btnFontColor}">
                              <?=__('购买')?>  
                            </div>
                        </div>
                    </div>
                    <div class="m_pitem" v-if="item.eltm4.data.length>0" v-for="items in item.eltm4.data"   :key="items.id" v-bind:style="{backgroundColor:item.bgColor}">
                        <div class="m_pinfo"   :data-id="items.id" :data-name="items.name" :data-type="items.selectType" :data-keyWord="items.keyWord" :data-AppId="items.AppId" :data-AppUrl="items.AppUrl"  :data-MinAppUrl="item.MinAppUrl" @click="tplGoToPage">
                            <div class="pimg" v-if="items.path!=''">
                                <img :src="items.path" />
                            </div>
                            <div class="pimg" v-if="items.path==''" style="background-color: #81d5fa;">
                                <img v-if="item.eltm4.listTyle==1" src="shop_admin/static/src/common/images/diy/img/350x350.png" />
                                <img v-if="item.eltm4.listTyle==2" src="shop_admin/static/src/common/images/diy/img/180x180.png" />
                                <img v-if="item.eltm4.listTyle==3" src="shop_admin/static/src/common/images/diy/img/355x166.png" />
                                <img v-if="item.eltm4.listTyle==4" src="shop_admin/static/src/common/images/diy/img/140x140.png" />
                            </div>
                            <div class="pname" v-if="items.name!=''">
                                <label>{{items.name}}</label>
                            </div>
                            <div class="pname" v-if="items.name==''">
                                <label>商品名称</label>
                            </div>
                            <div class="pSelling" v-if="items.ProductTips!='' && item.eltm4.isProductTips && item.eltm4.isPrice">
                                {{items.ProductTips}}
                            </div>
                            <div class="pSelling" v-if="items.ProductTips=='' && item.eltm4.isProductTips && item.eltm4.isPrice">
                                商品卖点
                            </div>
                            <div class="pSelling" v-if="items.ProductTips!='' && item.eltm4.isProductTips && !item.eltm4.isPrice" style="display: inline-block; padding-top: 12px;padding-bottom: 12px ">
                                {{items.ProductTips}}
                            </div>
                            <div class="pSelling" v-if="items.ProductTips=='' && item.eltm4.isProductTips && !item.eltm4.isPrice" style="display: inline-block; padding-top: 12px;padding-bottom: 12px ">
                                商品卖点
                            </div>
                            <div class="pprice" v-if="items.ItemSalePrice!='' && item.eltm4.isPrice" v-bind:style="{color:item.eltm4.priceColor}">
                                <label>￥</label>{{items.ItemSalePrice}}
                            </div>
                            <div class="pprice" v-if="items.ItemSalePrice=='' && item.eltm4.isPrice" v-bind:style="{color:item.eltm4.priceColor}">
                                <label>￥</label>19.88
                            </div>
                            <div v-if="item.eltm4.btnType==1 || item.eltm4.btnType==2" v-bind:class="{c1:item.eltm4.btnType==1,c2:item.eltm4.btnType==2}">

                            </div>
                            <div v-if="item.eltm4.btnType==3" class="c3" >
                                buy
                            </div>
                            <div v-if="item.eltm4.btnType==4" class="c4" v-bind:style="{backgroundColor:item.eltm4.btnColor,color:item.eltm4.btnFontColor}">
                                {{item.eltm4.btnText}}
                            </div>
                        </div>
                    </div>
                </div>
                <div  v-if="item.eltmType==5"  class="m-blank" v-bind:style="{height:(item.eltm5.height/20)+ 'rem',lineHeight:(item.eltm5.height/20)+ 'rem',backgroundColor:item.bgColor}">

                </div>
                <div v-if="item.eltmType==6"
                     v-bind:class="{boxFlex:item.eltmType==6,
                                           fdRow:item.eltm6.flexDirection==0,
                                           fdRowReverse:item.eltm6.flexDirection==1,
                                           fdColumn:item.eltm6.flexDirection==2,
                                           fdColumnReverse:item.eltm6.flexDirection==3,
                                           fwNowrap:item.eltm6.flexWrap==0,
                                           fwWrap:item.eltm6.flexWrap==1,
                                           fwWrapReverse:item.eltm6.flexWrap==2,
                                           jcFlexStart:item.eltm6.justifyContent==0,
                                           jcFlexEnd:item.eltm6.justifyContent==1,
                                           jcCenter:item.eltm6.justifyContent==2,
                                           jcSpaceBetween:item.eltm6.justifyContent==3,
                                           jcSpaceAround:item.eltm6.justifyContent==4,
                                           aiFlexStart:item.eltm6.alignItems==0,
                                           aiFlexEnd:item.eltm6.alignItems==1,
                                           aiCenter:item.eltm6.alignItems==2,
                                           aiBaseline:item.eltm6.alignItems==3,
                                           aiStretch:item.eltm6.alignItems==4
                                                                    }"
                     v-bind:style="{backgroundColor:item.bgColor}">
                    <div v-if="item.eltm6.data.length>0" v-for="items in item.eltm6.data"   :key="items.id"
                         class="boxFlexItem1" v-bind:style="{
                                                            paddingTop:(item.eltm6.paddingTop/20)+'rem',
                                                            paddingBottom:(item.eltm6.paddingBottom/20)+'rem',
                                                            paddingLeft:(item.eltm6.paddingLeft/20)+'rem',
                                                            paddingRight:(item.eltm6.paddingRight/20)+'rem',
                                                            fontSize:(item.eltm6.fontSize/20)+'rem',
                                                            color:item.eltm6.fontColor
                                                            }"   :data-id="items.id" :data-name="items.name" :data-type="items.selectType" :data-keyWord="items.keyWord" :data-AppId="items.AppId" :data-AppUrl="items.AppUrl"  :data-MinAppUrl="item.MinAppUrl" @click="tplGoToPage">
                        <span v-if="item.eltm6.type==1" :style="{width:(items.flexNum>1?((items.flexNum/20)+'rem'):'100%')}">{{items.name || '请输入文字'}}</span>
                        <img v-if="item.eltm6.type==0" :src="items.path ||  'shop_admin/static/src/common/images/diy/img/187x100.png'" :style="{width:(items.flexNum>1?((items.flexNum/20)+'rem'):'100%')}"/>
                    </div>
                    <div class="boxFlexItem1" v-if="item.eltm6.data.length<=0" v-bind:style="{
                                                            paddingTop:(item.eltm6.paddingTop/20)+'rem',
                                                            paddingBottom:(item.eltm6.paddingBottom/20)+'rem',
                                                            paddingLeft:(item.eltm6.paddingLeft/20)+'rem',
                                                            paddingRight:(item.eltm6.paddingRight/20)+'rem',
                                                            fontSize:(item.eltm6.fontSize/20)+'rem',
                                                            color:item.eltm6.fontColor
                                                            }">
                        <img src="shop_admin/static/src/common/images/diy/img/187x100.png" />
                    </div>
                    <div class="boxFlexItem1" v-if="item.eltm6.data.length<=0" v-bind:style="{
                                                            paddingTop:(item.eltm6.paddingTop/20)+'rem',
                                                            paddingBottom:(item.eltm6.paddingBottom/20)+'rem',
                                                            paddingLeft:(item.eltm6.paddingLeft/20)+'rem',
                                                            paddingRight:(item.eltm6.paddingRight/20)+'rem',
                                                            fontSize:(item.eltm6.fontSize/20)+'rem',
                                                            color:item.eltm6.fontColor
                                                            }">
                        <img src="shop_admin/static/src/common/images/diy/img/187x100.png" />
                    </div>
                </div>
                <div v-if="item.eltmType==7" v-bind:class="{boxGrids:item.eltmType==7,boxGridsBorder:item.eltm7.border}">
                            <span  v-bind:class="{boxGrid:item.eltmType==7,boxGridBorder:item.eltm7.border}" v-if="item.eltm7.data.length>0" v-for="items in item.eltm7.data"   :key="items.id" v-bind:style="{width:(100/item.eltm7.column)+'%',paddingTop:(item.eltm7.paddingTop/20)+'rem',paddingBottom:(item.eltm7.paddingBottom/20)+'rem',paddingLeft:(item.eltm7.paddingLeft/20)+'rem',paddingRight:(item.eltm7.paddingRight/20)+'rem',backgroundColor:item.bgColor}"   :data-id="items.id" :data-name="items.name" :data-type="items.selectType" :data-keyWord="items.keyWord" :data-AppId="items.AppId" :data-AppUrl="items.AppUrl"  :data-MinAppUrl="item.MinAppUrl" @click="tplGoToPage">
                                <div class="boxGridIcon">
                                    <img :src="items.path || 'shop_admin/static/src/common/images/diy/img/90x90.png'" alt="">
                                </div>
                                <p class="boxGridLabel">{{items.name || '功能入口'}}</p>
                            </span>
                    <span  class="boxGrid" v-if="item.eltm7.data.length==0" v-for="items in [1,2,3,4,5,6,7,8,9]" v-bind:class="{boxGrid:item.eltmType==7,boxGridBorder:item.eltm7.border}" v-if="item.eltm7.data.length>0" v-for="items in item.eltm7.data"   :key="items.id" v-bind:style="{width:(100/item.eltm7.column)+'%',paddingTop:(item.eltm7.paddingTop/20)+'rem',paddingBottom:(item.eltm7.paddingBottom/20)+'rem',paddingLeft:(item.eltm7.paddingLeft/20)+'rem',paddingRight:(item.eltm7.paddingRight/20)+'rem',backgroundColor:item.bgColor}">
                                <div class="boxGridIcon">
                                    <img src="shop_admin/static/src/common/images/diy/img/90x90.png" />
                                </div>
                                <p class="boxGridLabel">功能入口</p>
                            </span>
                </div>
                <div v-if="item.eltmType==9" class="searchBox" v-bind:style="{backgroundColor:item.bgColor,paddingTop:(item.eltm9.paddingTop/20)+'rem',
                                                            paddingBottom:(item.eltm9.paddingBottom/20)+'rem',
                                                            paddingLeft:(item.eltm9.paddingLeft/20)+'rem',
                                                            paddingRight:(item.eltm9.paddingRight/20)+'rem'}">
                    <div class="contentBox">
                        <i class="iconfont icon-sousuo"></i>{{item.eltm9.tipText}}
                    </div>
                </div>
                <div class="videoBox" v-if="item.eltmType==12" >
                    <video :src="item.eltm12.src" :controls="item.eltm12.controls" :autoplay="item.eltm12.autoplay" :loop="item.eltm12.loop" v-bind:style="{backgroundColor:item.bgColor,paddingTop:(item.eltm12.paddingTop/20)+'rem',
                                                                paddingBottom:(item.eltm12.paddingBottom/20)+'rem',
                                                                paddingLeft:(item.eltm12.paddingLeft/20)+'rem',
                                                                paddingRight:(item.eltm12.paddingRight/20)+'rem',width:(item.eltm12.width/20)+'rem',height:(item.eltm12.height/20)+'rem'}">
                        您的浏览器不支持 video 标签。
                    </video>
                </div>
                <div class="formBox" v-if="item.eltmType==13" v-bind:style="{backgroundColor:item.bgColor}">
                    <div v-if="item.eltm13.data.length>0">
                        <div v-for="items in item.eltm13.data"   :key="items.id">
                            <div class="fromInput" v-if="items.type==1">
                                <label v-bind:style="{color:item.eltm13.labelColor}">{{items.labelText}}</label>
                                <input type="text" name="name" value="" :placeholder="items.placeholderText" :style="{borderColor:items.borderColor,color:item.eltm13.textColor}"/>
                            </div>
                            <div class="fromInput" v-if="items.type==2">
                                <label v-bind:style="{color:item.eltm13.labelColor}" >{{items.labelText}}</label>
                                <input type="date" name="name" value="" :placeholder="items.placeholderText" :style="{borderColor:items.borderColor,color:item.eltm13.textColor}"/>
                            </div>
                            <div class="fromInput" v-if="items.type==3">
                                <label v-bind:style="{color:item.eltm13.labelColor}" >{{items.labelText}}</label>
                                <textarea :placeholder="items.placeholderText" :style="{borderColor: items.borderColor,color:item.eltm13.textColor}">

                                        </textarea>
                            </div>
                            <div class="fromInput" v-if="items.type==4">
                                <label v-bind:style="{color:item.eltm13.labelColor}">{{items.labelText}}</label>
                                <div class="fromCK_item" v-for="info in items.data">
                                    <input type="radio" id="Radio56"  name="name" checked="checked" value=""/><i class="iconfont icon-danxuan1"></i><i class="iconfont icon-icon-text-fi-radio" :style="{color:items.selColor}"></i><span v-bind:style="{color:item.eltm13.textColor}">{{info.text}}</span>
                                    <label for="d"></label>
                                </div>
                            </div>
                            <div class="fromCK" v-if="items.type==5">
                                <label v-bind:style="{color:item.eltm13.labelColor}">{{items.labelText}}</label>
                                <div class="fromCK_item" v-for="info in items.data">
                                    <input type="checkbox" id="Checkbox1" checked="checked" name="name" value=""/><i class="iconfont icon-xuanze"></i><i class="iconfont icon-xuanze1" :style="{color:items.selColor}"></i><span v-bind:style="{color:item.eltm13.textColor}">{{info.text}}</span>
                                    <label for="Radio53"></label>
                                </div>
                            </div>
                        </div>
                        <div class="formSubmit">
                            <a class="formButtom" v-bind:style="{backgroundColor:item.eltm13.btnColor,color:item.eltm13.fontColor}">{{item.eltm13.btnText}}</a>
                        </div>
                    </div>
                    <div v-if="item.eltm13.data.length==0">
                        <div class="fromInput">
                            <label v-bind:style="{color:item.eltm13.labelColor}">联系电话</label>
                            <input type="text" name="name" value="" placeholder="请输入联系电话" :style="{color:item.eltm13.textColor}"/>
                        </div>
                        <div class="fromInput">
                            <label v-bind:style="{color:item.eltm13.labelColor}">选择时间</label>
                            <input type="date" name="name" value="" placeholder="请选择时间" :style="{color:item.eltm13.textColor}"/>
                        </div>
                        <div class="fromInput">
                            <label v-bind:style="{color:item.eltm13.labelColor}">输入描述</label>
                            <textarea placeholder="请输入描述" :style="{color:item.eltm13.textColor}">

                                    </textarea>
                        </div>
                        <div class="fromCK">
                            <label v-bind:style="{color:item.eltm13.labelColor}">单项选择</label>
                            <div class="fromCK_item">
                                <input type="radio" id="d" name="name" checked="checked" value=""/><i class="iconfont icon-danxuan1"></i><i class="iconfont icon-icon-text-fi-radio"></i><span v-bind:style="{color:item.eltm13.textColor}">选项一</span>
                                <label for="d"></label>
                            </div>
                            <div class="fromCK_item">
                                <input type="radio" id="a" name="name" value=""/><i class="iconfont icon-danxuan1"></i><i class="iconfont icon-icon-text-fi-radio"></i><span v-bind:style="{color:item.eltm13.textColor}">选项二</span>
                                <label for="a"></label>
                            </div>
                        </div>
                        <div class="fromCK">
                            <label v-bind:style="{color:item.eltm13.labelColor}">多项选择</label>
                            <div class="fromCK_item">
                                <input type="checkbox" id="Radio53" checked="checked" name="name" value=""/><i class="iconfont icon-xuanze"></i><i class="iconfont icon-xuanze1"></i><span v-bind:style="{color:item.eltm13.textColor}">选项一</span>
                                <label for="Radio53"></label>
                            </div>
                            <div class="fromCK_item">
                                <input type="checkbox" id="Radio54" name="name" value=""/><i class="iconfont icon-xuanze"></i><i class="iconfont icon-xuanze1"></i><span v-bind:style="{color:item.eltm13.textColor}">选项二</span>
                                <label for="Radio54"></label>
                            </div>
                        </div>
                        <div class="formSubmit">
                            <a class="formButtom" v-bind:style="{backgroundColor:item.eltm13.btnColor,color:item.eltm13.fontColor}">{{item.eltm13.btnText}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="item in info" v-if="item.eltmType==8">
            <div  class="mTel" v-bind:style="{backgroundColor:item.bgColor}">
                <a :href="'tel:' + item.eltm8.tel"><i class="iconfont icon-dianhua--copy" v-bind:style="{color:item.eltm8.fontColor}"></i></a>
            </div>
        </div>
        <div v-for="item in info" v-if="item.eltmType==11">
            <div  class="mCS" v-bind:style="{backgroundColor:item.bgColor}">
                <i class="iconfont icon-kefu1" v-bind:style="{color:item.eltm11.fontColor}"></i>

            </div>
        </div>
    </div>
</div>
<form method="post" action="http://127.0.0.1/storesystem/trunk/index.php/Page_Base/saveTpl" id="dir_form">

    <input type="hidden" name="app_id" id="app_id" value="1022"/>
    <input type="hidden" name="page_id" id="page_id" value="1513266512"/>
    <input type="hidden" name="store_id" id="store_id" value="0"/>
    <input type="hidden" name="page_code" id="page_code" value='[{"id":1513311206379,"eltmType":"9","bgColor":"","eltm1":{"align":1,"bgColor":3,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":200,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"width":170,"height":90,"data":[]},"eltm7":{"column":3,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"},"eltm11":{"fontColor":"#000"},"eltm12":{"width":375,"height":212,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"src":"http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400&bizid=1023&hy=SH&fileparam=302c020101042530230204136ffd93020457e3c4ff02024ef202031e8d7f02030f42400204045a320a0201000400","controls":true,"autoplay":true,"loop":true,"muted":false},"eltm13":{"btnColor":"rgb(219,56,76)","fontColor":"#fff","btnText":"提交","labelColor":"#888","textColor":"#333","btnFeedback":"感谢您的填写","data":[]}},{"id":1499251953399,"eltmType":"3","bgColor":"","eltm1":{"align":1,"bgColor":3,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":"148","color":"#DB384C","progress":true,"data":[{"id":1499251955679,"did":0,"name":"","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20180112/1515736482736878.jpg","flexNum":1,"specImg":"","keyWord":"小米","words":"","ProductTips":"","selectType":"3","AppUrl":""},{"id":1514394748087,"did":1001,"name":" 如何注册成为会员","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20171227/1514394900356891.png","flexNum":0,"ProductTips":null,"selectType":"6","AppUrl":"../article-detail/article-detail?cid=2278"},{"id":1515737086240,"did":0,"name":"","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20180112/1515737106540294.jpg","flexNum":0,"specImg":"","keyWord":"","words":"","ProductTips":"","selectType":1,"AppUrl":"","AppId":"","MinAppUrl":""}]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499252028119,"eltmType":"5","bgColor":"","eltm1":{"align":1,"bgColor":2,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":"5"},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499251974359,"eltmType":"7","bgColor":"","eltm1":{"align":1,"bgColor":2,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":"5","bgColor":"#fff","paddingTop":"5","paddingRight":10,"paddingBottom":"5","paddingLeftt":10,"border":false,"data":[{"id":1499251976335,"did":13,"name":"领券中心","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon9.png","flexNum":1,"ProductTips":null,"selectType":"4","AppUrl":"../receivecontent/receivecontent"},{"id":1499251976951,"did":6,"name":"物流查询","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon7.png","flexNum":1,"ProductTips":null,"selectType":"4","AppUrl":"../orderlist/orderlist?type=3&sl=3"},{"id":1499251978063,"did":4,"name":"分享赚钱","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon4.png","flexNum":1,"ProductTips":null,"selectType":"4","AppUrl":"../endorsement/endorsement"},{"id":1499251978591,"did":3,"name":"我的收藏","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon6.png","flexNum":1,"ProductTips":null,"selectType":"4","AppUrl":"../goodcollection/goodcollection"},{"id":1499251979223,"did":1,"name":"我的金库","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon1.png","flexNum":1,"ProductTips":null,"selectType":"4","AppUrl":"../cashaccount/cashaccount"},{"id":1513410507034,"did":22,"name":"新闻资讯","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon16.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../article-list/article-list"},{"id":1513410533549,"did":18,"name":"服务预约","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon14.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../../pages/productlist/productlist?kind_id=1202"},{"id":1513410615725,"did":12,"name":"附近门店","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon8.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../nearbylist/nearbylist"},{"id":1513410640432,"did":5,"name":"我的粉丝","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon5.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../fanslist/fanslist"},{"id":1514026774807,"did":1514023892561,"name":"DIY拖拽","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20171228/1514540620129683.jpg","flexNum":0,"ProductTips":null,"selectType":"8","AppUrl":null},{"id":1514642838325,"did":1514023892561,"name":"自定义页面","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20171228/1514540620129683.jpg","flexNum":0,"ProductTips":null,"selectType":"8","AppUrl":null},{"id":1515228502420,"did":1515228357987,"name":"花卉","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20180106/1515228488677610.png","flexNum":0,"ProductTips":null,"selectType":"8","AppUrl":null},{"id":1515465383780,"did":15,"name":"砸金蛋","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon11.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../smashgoldeneggs/smashgoldeneggs"},{"id":1515465415638,"did":14,"name":"幸运抽奖","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon10.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../luckydraw/luckydraw"},{"id":1515465445740,"did":11,"name":"活动中心","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon3.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../activitylist/activitylist"}]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1516255158795,"eltmType":"7","bgColor":"","eltm1":{"align":1,"bgColor":1,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":200,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"width":170,"height":90,"data":[]},"eltm7":{"column":3,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[{"id":1516255171376,"did":17,"name":"拼团活动","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon13.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../fightgroupslist/fightgroupslist"},{"id":1516255238256,"did":2,"name":"我的拼团","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon2.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../fightgroupsorderlist/fightgroupsorderlist"},{"id":1516255266117,"did":23,"name":"好友砍价","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/appicon/icon22.png","flexNum":0,"ProductTips":null,"selectType":"4","AppUrl":"../bargainlist/bargainlist"}]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"},"eltm11":{"fontColor":"#000"},"eltm12":{"width":375,"height":212,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"src":"http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400&bizid=1023&hy=SH&fileparam=302c020101042530230204136ffd93020457e3c4ff02024ef202031e8d7f02030f42400204045a320a0201000400","controls":true,"autoplay":true,"loop":true,"muted":false},"eltm13":{"btnColor":"rgb(219,56,76)","fontColor":"#fff","btnText":"提交","labelColor":"#888","textColor":"#333","btnFeedback":"感谢您的填写","data":[]}},{"id":1499252036470,"eltmType":"5","bgColor":"","eltm1":{"align":1,"bgColor":0,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":"5"},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499252043094,"eltmType":"3","bgColor":"","eltm1":{"align":1,"bgColor":0,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":"151","color":"#DB384C","progress":true,"data":[{"id":1499252044895,"did":0,"name":"Xiaomi/小米 小米蓝牙音频接收器 高品质音乐轻巧便携 耳机接收器","ItemSalePrice":0,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/plantform/image/20180112/1515736538430411.jpg","flexNum":1,"specImg":"","keyWord":"#ff8000","words":"","ProductTips":"","selectType":"9","AppUrl":"https://test.shopsuite.cn/wap/tmpl/product_detail.html?item_id=63","AppId":"white"}]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499252069694,"eltmType":"5","bgColor":"","eltm1":{"align":1,"bgColor":1,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":"5"},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499253309479,"eltmType":"6","bgColor":"","eltm1":{"align":1,"bgColor":2,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":"0","paddingRight":"0","paddingBottom":"0","paddingLeftt":"0","bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[{"id":1499253320159,"did":0,"name":"","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/img002/20170705/e1a33ab9-16a7-42c6-bd71-4f962ca24010.png","flexNum":1,"specImg":"","keyWord":"","words":"","ProductTips":"","selectType":"0","AppUrl":""}]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499252095238,"eltmType":"4","bgColor":"","eltm1":{"align":1,"bgColor":4,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":"4","listTyle":"2","isPrice":true,"isProductTips":false,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[{"id":1499252109470,"did":67,"name":"毛边牛仔短裤 银白 26","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514390343564397.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252213701,"did":70,"name":"不对称牛仔短裤 浅蓝 25","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514390718907400.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252325781,"did":73,"name":"不对称牛仔短裤 蓝色 26","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514390735914679.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252326605,"did":68,"name":"毛边牛仔短裤 浅蓝 25","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514390339314608.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null}]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499253309895,"eltmType":"6","bgColor":"","eltm1":{"align":1,"bgColor":4,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":"0","paddingRight":"0","paddingBottom":"0","paddingLeftt":"0","bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[{"id":1499253331374,"did":0,"name":"","ItemSalePrice":0,"path":"https://static.shopsuite.cn/xcxfile/img002/20170705/7fbd1715-a53b-4277-ab82-73e503e7a59c.png","flexNum":1,"specImg":"","keyWord":"","words":"","ProductTips":"","selectType":"0","AppUrl":""}]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1499252559003,"eltmType":"4","bgColor":"","eltm1":{"align":1,"bgColor":5,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":120,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":"4","listTyle":"2","isPrice":true,"isProductTips":false,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[{"id":1499252571923,"did":58,"name":"连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣裙连衣 ","ItemSalePrice":123,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1001/image/20171115/1510827287757112.jpg","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252572651,"did":53,"name":"2017秋装新款女装秋冬连衣裙短裙毛衣两件套chic风时髦女神套装裙 亮黑色 M 中式","ItemSalePrice":2000,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1001/image/20171123/1511410316930217.jpg","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252573267,"did":75,"name":"露肩吊带单排扣修身纯色连衣裙 银白 26","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514390961390965.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null},{"id":1499252574003,"did":76,"name":"一字肩蕾丝镂空吊带格子连衣裙 红色 26","ItemSalePrice":100,"path":"https://test.shopsuite.cn/image.php/shop/data/upload/media/store/1010/image/20171227/1514391106697272.png","flexNum":1,"ProductTips":null,"selectType":"1","AppUrl":null}]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"data":[]},"eltm7":{"column":4,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"}},{"id":1516255154718,"eltmType":"7","bgColor":"","eltm1":{"align":1,"bgColor":5,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":200,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"width":170,"height":90,"data":[]},"eltm7":{"column":3,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"},"eltm11":{"fontColor":"#000"},"eltm12":{"width":375,"height":212,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"src":"http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400&bizid=1023&hy=SH&fileparam=302c020101042530230204136ffd93020457e3c4ff02024ef202031e8d7f02030f42400204045a320a0201000400","controls":true,"autoplay":true,"loop":true,"muted":false},"eltm13":{"btnColor":"rgb(219,56,76)","fontColor":"#fff","btnText":"提交","labelColor":"#888","textColor":"#333","btnFeedback":"感谢您的填写","data":[]}},{"id":1516255156492,"eltmType":"7","bgColor":"","eltm1":{"align":1,"bgColor":1,"padding":0,"border":false,"layout":8,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"data":{}},"eltm2":{"padding":10,"data":{}},"eltm3":{"padding":0,"height":200,"color":"#DB384C","progress":true,"data":[]},"eltm4":{"shadow":true,"btnType":0,"listTyle":1,"isPrice":true,"isProductTips":true,"btnColor":"#DB384C","btnText":"购买","priceColor":"#DB384C","btnFontColor":"#fff","data":[]},"eltm5":{"height":20},"eltm6":{"paddingTop":10,"paddingRight":10,"paddingBottom":10,"paddingLeftt":10,"bgColor":"#fff","fontColor":"#000","fontSize":12,"border":false,"flexDirection":0,"flexWrap":0,"justifyContent":0,"alignItems":0,"type":0,"width":170,"height":90,"data":[]},"eltm7":{"column":3,"bgColor":"#fff","paddingTop":20,"paddingRight":10,"paddingBottom":20,"paddingLeftt":10,"border":false,"data":[]},"eltm8":{"fontColor":"#000","tel":""},"eltm9":{"paddingTop":10,"paddingRight":40,"paddingBottom":10,"paddingLeftt":40,"tipText":"请输入提示内容"},"eltm11":{"fontColor":"#000"},"eltm12":{"width":375,"height":212,"paddingTop":0,"paddingRight":0,"paddingBottom":0,"paddingLeftt":0,"src":"http://wxsnsdy.tc.qq.com/105/20210/snsdyvideodownload?filekey=30280201010421301f0201690402534804102ca905ce620b1241b726bc41dcff44e00204012882540400&bizid=1023&hy=SH&fileparam=302c020101042530230204136ffd93020457e3c4ff02024ef202031e8d7f02030f42400204045a320a0201000400","controls":true,"autoplay":true,"loop":true,"muted":false},"eltm13":{"btnColor":"rgb(219,56,76)","fontColor":"#fff","btnText":"提交","labelColor":"#888","textColor":"#333","btnFeedback":"感谢您的填写","data":[]}}]'/>

    <input type="hidden" name="page_nav" id="page_nav" value='{"window":{"navigationBarBackgroundColor":"#DB384C","navigationBarTextStyle":"white","navigationBarTitleText":"","backgroundColor":"#f8f8f8","backgroundTextStyle":"dark"},"tabBar":{"color":"#999999","selectedColor":"#DB384C","backgroundColor":"#ffffff","borderStyle":"white","position":"bottom","list":[{"pagePath":"pages/index/index","iconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/aa07e66f-d4fb-4a2b-bc4c-67ed9aace69b.png","selectedIconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/2840118f-dd01-471a-a749-d910905cefc3.png","text":"首页"},{"pagePath":"pages/category/category","iconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/16ff7864-3513-4ff8-bf12-a9a9808d39e5.png","selectedIconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/cdb5e3df-9d40-42ef-a46a-686dac547fd8.png","text":"分类"},{"pagePath":"pages/cart/cart","iconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/63d2f0b9-7059-4b06-b170-d3b93a749f99.png","selectedIconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/ea018028-20c0-4f1d-a914-3bfc55c8f13f.png","text":"购物车"},{"pagePath":"pages/UserCenter/UserCenter","iconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/50737e26-52e6-4c10-858a-ae2c025c2ebc.png","selectedIconPath":"http://files.qiluzhaoshang.com//ad003/2017082515/462eb69a-b3ec-446c-9997-c9f1e3212bcb.png","text":"我的"}]}}'/>

    <input type="hidden" name="page_config" id="page_config" value='{"BackgroundObj":{"type":1,"bgColor":"#ffffff","pathColor":"#f8f8f8","path":""}}'/>


    <input type="hidden" name="IsPersonalCenter" id="IsPersonalCenter" value="False"/>
    <input type="hidden" name="app_member_center" id="app_member_center"
           value='{"Id":6934,"StoreId":0,"PageCode":"{\"type\":1,\"list\":[{\"id\":1,\"name\":\"我的拼团\",\"isShow\":true,\"color\":\"#DB384C\",\"icon\":\"icon-gouwu\",\"FeatureKey\":\"FightGrp\"},{\"id\":2,\"name\":\"我的金库\",\"isShow\":true,\"color\":\"#44afa4\",\"icon\":\"icon-xiaojinku\",\"FeatureKey\":\"MemCashAcct\"},{\"id\":3,\"name\":\"我的预约\",\"isShow\":true,\"color\":\"#44afa4\",\"icon\":\"icon-shijian\",\"FeatureKey\":\"\"},{\"id\":4,\"name\":\"我的砍价\",\"isShow\":true,\"color\":\"#ffc333\",\"icon\":\"icon-kanjia\",\"FeatureKey\":\"CutPrice\"},{\"id\":5,\"name\":\"优惠券\",\"isShow\":true,\"color\":\"#56ABE4\",\"icon\":\"icon-youhuiquan\",\"FeatureKey\":\"Coupon\"},{\"id\":6,\"name\":\"会员俱乐部\",\"isShow\":false,\"color\":\"#ffc333\",\"icon\":\"icon-zuanshi\",\"FeatureKey\":\"MemGrade\"},{\"id\":7,\"name\":\"商品收藏\",\"isShow\":true,\"color\":\"#56ABE4\",\"icon\":\"icon-liwu\",\"FeatureKey\":\"FavProd\"},{\"id\":8,\"name\":\"收货地址\",\"isShow\":true,\"color\":\"#1BC2A6\",\"icon\":\"icon-shouhuodizhi\",\"FeatureKey\":\"\"},{\"id\":9,\"name\":\"关于商家\",\"isShow\":false,\"color\":\"#DB384C\",\"icon\":\"icon-store\",\"FeatureKey\":\"AbtVendor\"},{\"id\":10,\"name\":\"用户反馈\",\"isShow\":true,\"color\":\"#DB384C\",\"icon\":\"icon-yonghufankui\",\"FeatureKey\":\"\"}]}","IsRelease":true,"TemplateWarehouseId":8,"PageNav":"","PageConfig":"","PageTitle":"个人中心","IsHome":false,"ShareTitle":"","ShareImg":"","PageQRCode":null,"IsPersonalCenter":false}'/>
    <input type="hidden" name="app_feature_keyset" id="app_feature_keyset"
           value='["AbtVendor","ShopTmpl","DiyUI","DiyLnkPage","ProdCat","ProdDetail","ProdVideo","FavProd","ProdCmt","CustServ","CallDirect","ShoppingCart","MulPhyStore","ServResv","SelfTake","PayOnline","Membership","ProdMgr","ProdQrCode","OrderMgr","RecptPnt","OrderDetail","ShipMgr","CityDist","MemCent","MemCentGrid","QrCodeMeal","TakeAway","Newsletter","VideoCnt","TmplMsg","ProdProm","FlashSale","MemDist","PhyStoreDist","FansRank","Coupon","FightGrp","CutPrice","LuckDraw","GoldenEgg","QuickPay","AdvEvent","DynForm","ECashCard","MemGrade","MemGradeDisct","MemPoint","MemTag","MemCashAcct","MemRpt","ProdRpt","OrderRpt","SrcDelgAuth","FreeUpd"]'/>

</form>
<?php
include __DIR__ . '/../includes/footer.php';
?>