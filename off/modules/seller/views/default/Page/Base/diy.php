<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>首页模块设定</title>
    
    <script type="text/javascript">
        window.SYS = {};
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            admin_url: '<?=Zero_Registry::get('base_url')?>/admin.php',
            base_url: '<?=Zero_Registry::get('base_url')?>',
            index_url: "<?=Zero_Registry::get('url')?>",
            index_page: '<?=Zero_Registry::get('index_page')?>',
            static_url: '<?=Zero_Registry::get('static_url')?>'
        };

        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
    </script>
    
    
    <link rel="stylesheet" href="<?=$this->css('diy', true)?>">
    
    
    <script type="text/javascript" src="<?=$this->js('../../../../../shop/static/src/default/js/config')?>"></script>
    <script type="text/javascript" src="<?=$this->js('diy/diy.min', true)?>"></script>
    <script type="text/javascript" src="<?=$this->js('diy/ueditor/ueditor.config', true)?>"></script>
    <script type="text/javascript" src="<?=$this->js('diy/ueditor/ueditor.all', true)?>"></script>

</head>
<body>

<?php
/*print_r($data);
die();*/
?>

<!--网站内容start -->
<div class="index_content">
    <!--右边navstart -->
    <div class="index_right">
        <div class="m-diy-container" id="app">
            <div class="header" style="display: none">
                <div class="header_left" style="display: none">
                    <ul>
                        <li v-on:click="exit">
                            <i class="iconfont icon-xia"></i>
                        </li>
                    </ul>
                </div>
                <div class="header_right">
                    <ul>
                        <li v-on:click="Release">
                            <i class="iconfont icon-baocun-copy-copy"></i>
                            <h1>保存</h1>
                        </li>
                    </ul>
                </div>
                <div class="header_center">
                    综合电商
                </div>
                <div class="header_right" style="display: none;">
                    <ul>
                        <li v-on:click="DownloadCode">
                            <i class="iconfont icon-xiazai"></i>
                            <h1>下载代码</h1>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m_left">
                <div class="nav-tabs component-tabs">
                    <div class="nav-tabs-item" data-component="true"  v-bind:class="{active:componenttabNum==2}" data-tabNum="2" v-on:click="selectTab">
                        <label data-component="true" data-tabNum="2">页面管理</label>
                    </div>
                    <div class="nav-tabs-item" data-component="true" v-bind:class="{active:componenttabNum==1}" data-tabNum="1" v-on:click="selectTab">
                        <label data-component="true" data-tabNum="1">组件库</label>
                    </div>
                </div>
                <div class="weui-grids pageList" v-if="componenttabNum==2">
                    <div class="sub-content">
                        <div class="expand_menu_box" v-for="(item,index) in pageList" >
                            <div class="sub-level-title" :editId="item.Id" v-on:click.stop="editPage">
                                {{item.PageTitle?item.PageTitle:'第'+(index+1)+'项'}}
                                <span class="isHome"><i class="iconfont icon-shouye" v-if="item.IsHome"></i></span>
                                <i class="iconfont icon-moreunfold" ></i>
                                <i class="iconfont icon-icon-del-copy" :delId="item.Id" v-on:click.stop="removePage"></i>
                                <i class="iconfont icon-zhengzaijieru" :editId="item.Id" :style="{display:(editPageId!=item.Id?'none':'')}" style="font-size: 14px;" ><label style="font-size: 12px;" :editId="item.Id">编辑中...</label></i>
                                <span class="IsRelease" :editId="item.Id" v-if="item.IsRelease"><i :editId="item.Id" class="iconfont icon-yifabu" ></i></span>
                                <span class="IsRelease noRelease" :editId="item.Id" v-if="!item.IsRelease"><i :editId="item.Id" class="iconfont icon-unpublished" ></i></span>
                            </div >
                            <div class="expand_menu_content hidebox">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否首页
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.IsHome" :HometPageId="item.Id"  v-on:change="setHomePage"/>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否发布
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.IsRelease"/>
                                    </div>
                                </div>
                                <div  class="sub-level1 box_border" >
                                    <div class="sub-label">
                                        页面标题
                                    </div>
                                    <div class="inputBox">
                                        <input  maxlength="20" type="text" v-model="item.PageTitle" placeholder="请输入页面标题" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        页面分享标题
                                    </div>
                                    <div class="inputBox">
                                        <input  maxlength="30" type="text" v-model="item.ShareTitle" placeholder="请输入页面分享标题" />
                                    </div>
                                </div>
                                <!--图片 start-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        页面分享图片
                                    </div>
                                    <div class="inputbox">
                                        <div class="shear_box">
                                            <div class="shear_logo">
                                                <i class="iconfont icon-xiaochengxu1" ></i>
                                            </div>
                                            <div class="shear_ct">
                                                小程序
                                            </div>
                                            <div class="shear_tip">
                                                {{item.ShareTitle || '请输入分享的标题'}}
                                            </div>
                                            <div class="shear_img">
                                                     <span v-if="isUploadImage">
                                                       <input type="file" name="upfile" :id="'File'+item.Id"  v-on:change="uploadImage" :fileId="item.Id" :imgSize="800" />
                                                     </span>
                                                <img :src="item.ShareImg || 'shop_admin/static/src/common/images/diy/img/266x212.png' " :imgId="item.Id"/>
                                            </div>
                                            <div class="shear_bottom">
                                                <i class="iconfont icon-xiaochengxu" ></i>小程序
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--图片 start-->
                            </div>
                        </div>
                        <div class="expand_menu_box" style="display: none;">
                            <div class="sub-level-title" :editId="PersonalCenter.Id" v-on:click.stop="editPage">
                                个人中心
                                <i class="iconfont icon-moreunfold" ></i>
                              <i class="iconfont icon-zhengzaijieru" :editId="PersonalCenter.Id" :style="{display:(editPageId!=PersonalCenter.Id?'none':'')}" style="font-size: 14px;" ><label style="font-size: 12px;" editId="PersonalCenter">编辑中...</label></i>
                             </div>
                            <div class="expand_menu_content hidebox">
                                <div class="sub-level1 box_border">
                                     <div class="sub-label">
                                         展示样式
                                     </div>
                                     <div class="inputicon">
                                        <div class="radioBox">
                                             <input type="radio" id="Radio55" name="Radio55" v-model="PersonalCenter.PageCode.type" value="1" />
                                             <label for="Radio55" >
                                                 <i class="iconfont icon-liebiao"></i>
                                             </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                             <input type="radio" id="Radio57" name="Radio55" v-model="PersonalCenter.PageCode.type" value="2" />
                                             <label for="Radio57" >
                                                 <i class="iconfont icon-gongge"></i>
                                             </label>
                                        </div>
                                    </div>
                                </div>
                                    
                                    
                               <div class="sub-level1 box_border" v-for="(item,index) in PersonalCenter.PageCode.list" v-if="!item.FeatureKey || FeatureKeyList.indexOf(item.FeatureKey)>=0">
                                    <div class="sub-label">
                                        {{item.name}}
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.isShow"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                       <div style="background-color: #31364a; padding: 10px 0;" v-if="FeatureKeyList.indexOf('DiyLnkPage')>=0">
                            <div class="msk_add_ad" v-on:click="addPage" >
						            <label></label>新增页面
					         </div>
                        </div>
                        <div class="vipBox" style="background-color: #31364a; padding: 10px 0;" v-if="FeatureKeyList.indexOf('DiyLnkPage')<0">
                            <div class="msk_add_ad " >
						            <label></label>新增页面
					         </div>
                        </div>
                </div>
                <ul class="weui-grids" id="moduleList" v-if="componenttabNum==1">
                    <li class="weui-grid" v-on:click="addModule" :ckType="3" >
                        <div class="weui-grid__icon" :ckType="3">
                            <img src="shop_admin/static/src/common/images/diy/img/z_07.png" :ckType="3"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="3">轮播</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="1" >
                        <div class="weui-grid__icon" :ckType="1">
                            <img src="shop_admin/static/src/common/images/diy/img/z_03.png" :ckType="1"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="1">图片</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="6" >
                        <div class="weui-grid__icon" :ckType="6">
                            <img src="shop_admin/static/src/common/images/diy/img/z_16.png" :ckType="6"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="6">图片组</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="4" >
                        <div class="weui-grid__icon" :ckType="4">
                            <img src="shop_admin/static/src/common/images/diy/img/z_13.png" :ckType="4"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="4">商品列表</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="7" >
                        <div class="weui-grid__icon" :ckType="7">
                            <img src="shop_admin/static/src/common/images/diy/img/z_20.png" :ckType="7"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="7">功能入口</h1><!-- 默认四个-->
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="2" >
                        <div class="weui-grid__icon" :ckType="2">
                            <img src="shop_admin/static/src/common/images/diy/img/z_05.png" :ckType="2"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="2">富文本</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="5" >
                        <div class="weui-grid__icon" :ckType="5">
                            <img src="shop_admin/static/src/common/images/diy/img/z_15.png" :ckType="5"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="5">辅助空白</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="9" >
                        <div class="weui-grid__icon" :ckType="9">
                            <img src="shop_admin/static/src/common/images/diy/img/z_22.png" :ckType="9"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="9">搜索</h1>
                    </li>
                    <li class="weui-grid" v-on:click="addModule" :ckType="8" >
                        <div class="weui-grid__icon" :ckType="8">
                            <img src="shop_admin/static/src/common/images/diy/img/z_23.png" :ckType="8"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="8">电话</h1>
                    </li>
                    <span class="weui-grid" v-on:click="addSingleModule" :ckType="10">
                        <div class="weui-grid__icon" :ckType="10">
                            <img src="shop_admin/static/src/common/images/diy/img/z_24.png" :ckType="10"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="10">背景</h1>
                    </span>
                    <li class="weui-grid" v-on:click="addModule" :ckType="11">
                        <div class="weui-grid__icon" :ckType="11">
                            <img src="shop_admin/static/src/common/images/diy/img/z_25.png" :ckType="11"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="11">客服</h1>
                    </li>
                        <li class="weui-grid" v-on:click="addModule" :ckType="12" v-if="FeatureKeyList.indexOf('VideoCnt')>=0">
                        <div class="weui-grid__icon" :ckType="12">
                            <img src="shop_admin/static/src/common/images/diy/img/z_26.png" :ckType="12"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="12">视频</h1>
                    </li>
                        <span class="weui-grid vipBox" v-if="FeatureKeyList.indexOf('VideoCnt')<0">
                            <div class="weui-grid__icon">
                                <img src="shop_admin/static/src/common/images/diy/img/z_26.png"/>
                            </div>
                            <h1 class="weui-grid__label">视频</h1>
                        </span>
                    <li class="weui-grid" v-on:click="addModule" :ckType="13"  v-if="FeatureKeyList.indexOf('DynForm')>=0">
                        <div class="weui-grid__icon" :ckType="13">
                            <img src="shop_admin/static/src/common/images/diy/img/z_28.png" :ckType="13"/>
                        </div>
                        <h1 class="weui-grid__label" :ckType="13">动态表单</h1>
                    </li>
                        <span class="weui-grid vipBox" v-if="FeatureKeyList.indexOf('DynForm')<0">
                            <div class="weui-grid__icon" >
                                <img src="shop_admin/static/src/common/images/diy/img/z_28.png" />
                            </div>
                            <h1 class="weui-grid__label">动态表单</h1>
                        </span>
                </ul>
            </div>
            <div class="m-phone"  :style="{background:(PageConfig.BackgroundObj.type==1?PageConfig.BackgroundObj.bgColor:'url('+PageConfig.BackgroundObj.path+') no-repeat '+PageConfig.BackgroundObj.pathColor+' ')}">
                <div class="app_header" :style="{backgroundColor:appConfig.window.navigationBarBackgroundColor,color:appConfig.window.navigationBarTextStyle}" v-on:click="setTitle">
                    <h1>{{StoreName}}</h1>
                    <i class="iconfont icon-fenxiang"></i>
                </div>
                
                <div class="weui-tabbar" v-if="appConfig.tabBar.position=='bottom' && isTabBar" :style="{color:appConfig.tabBar.color,backgroundColor:appConfig.tabBar.backgroundColor }" v-on:click="setTabBar">
                        <span class="weui-tabbar__item weui-bar__item_on" v-for="(item,index) in appConfig.tabBar.list" >
                            <div v-if="index==selectIndex" :style="{color:appConfig.tabBar.selectedColor}" >
                                <span>
                                    <img :src="item.selectedIconPath || 'shop_admin/static/src/common/images/diy/img/icon_tabbar.png' " alt="" class="weui-tabbar__icon" :selectIndex="index"  v-on:click.stop="selectTabBar">
                                </span>
                                <p class="weui-tabbar__label" >{{item.text}}</p>
                            </div>
                            <div v-if="index!=selectIndex" >
                                <span>
                                    <img :src="item.iconPath || 'shop_admin/static/src/common/images/diy/img/icon_tabbar.png'" alt="" class="weui-tabbar__icon" :selectIndex="index"  v-on:click.stop="selectTabBar">
                                </span>
                                <p class="weui-tabbar__label" >{{item.text}}</p>
                            </div>
                        </span>
                </div>
                
                <div class="weui-navbar" v-if="appConfig.tabBar.position=='top' && isTabBar" :style="{color:appConfig.tabBar.color,backgroundColor:appConfig.tabBar.backgroundColor}" v-on:click="setTabBar">
                    <div class="weui-navbar__item" v-for="(item,index) in appConfig.tabBar.list"  >
                        <label v-if="index==selectIndex" :style="{color:appConfig.tabBar.selectedColor}" :selectIndex="index" v-on:click.stop="selectTabBar">
                            {{item.text}}
                            <span :style="{backgroundColor:appConfig.tabBar.selectedColor}"></span>
                        </label>
                        <label v-if="index!=selectIndex" :selectIndex="index" v-on:click.stop="selectTabBar">
                            {{item.text}}
                        </label>
                    </div>
                </div>
                    
                <div v-if="editPageId==PersonalCenter.Id">
                    <div class="m-banner-img">
                      <div class="m-animate-warp" style="background:url(shop_admin/static/src/common/images/diy/img/photo.png);background-size: cover;">
                        <div class="m-animate-img" style="background:url(shop_admin/static/src/common/images/diy/img/photo.png);background-size: cover;"></div>
                      </div>
                      <div  class="m-user-info">
                        <image src="shop_admin/static/src/common/images/diy/img/photo.png" />
                        <label>昵称</label>
                      </div>
                    </div>
                    <div class="g-flex m-od-tab">
                      <span  class="g-flex-item">
                        <div class="iconfont icon-daizhifu i-type"></div>
                        待支付
                      </span>
                      <span  class="g-flex-item">
                        <div class="iconfont icon-zhifu i-type"></div>
                        待收货
                      </span>
                      <div class="g-flex-item"></div>
                      <span  class="g-flex-item">
                        <div class="iconfont icon-myiwancheng i-type"></div>
                        已完成
                      </span>
                      <span  class="g-flex-item">
                        <div class="iconfont icon-quanbudingdan i-type"></div>
                        全部订单
                      </span>
                    </div>
                    <div class="iconBoxList" :class="{iconBoxLattice:PersonalCenter.PageCode.type==2}">
                        <ul>
                            <li v-for="item in PersonalCenter.PageCode.list" v-if="(!item.FeatureKey || FeatureKeyList.indexOf(item.FeatureKey)>=0) && item.isShow">
                                <div class="iconText">
                                    <label class="iconfont" :class="item.icon" v-bind:style="{color:item.color}"></label><span>{{item.name}}</span>
                                    <i class="iconfont icon-right"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
				<div class="pagexd" id="sortable_container" v-if="editPageId!=PersonalCenter.Id">
                    <div v-for="item in info" class="dropItem">
                        <div  v-if="item.eltmType==1" v-bind:class="{ms:item.eltmType==1,s1:item.eltm1.layout==1,s2h:item.eltm1.layout==2,s2v:item.eltm1.layout==3,s4h:item.eltm1.layout==4,s4v:item.eltm1.layout==5,s8h:item.eltm1.layout==6,s8v:item.eltm1.layout==7,s16:item.eltm1.layout==8,fl:item.eltm1.align==1,fr:item.eltm1.align==2}" v-bind:style="{
                                                            paddingTop:item.eltm1.paddingTop+'px',
                                                            paddingBottom:item.eltm1.paddingBottom+'px',
                                                            paddingLeft:item.eltm1.paddingLeftt+'px',
                                                            paddingRight:item.eltm1.paddingRight+'px',
                                                            backgroundColor:item.bgColor
                                                            }">
                            <img v-if="item.eltm1.layout==1" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x750.png'" />
                            <img v-if="item.eltm1.layout==2" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x375.png'" />
                            <img v-if="item.eltm1.layout==3" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x750.png'" />
                            <img v-if="item.eltm1.layout==4" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/750x188.png'" />
                            <img v-if="item.eltm1.layout==5" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x375.png'" />
                            <img v-if="item.eltm1.layout==6" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/375x188.png'" />
                            <img v-if="item.eltm1.layout==7" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/188x375.png'" />
                            <img v-if="item.eltm1.layout==8" :src="item.eltm1.data.path || 'shop_admin/static/src/common/images/diy/img/188x188.png'" />
                            <div v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div  v-if="item.eltmType==2" class="m-RichText" v-bind:style="{padding:item.eltm2.padding+ 'px',backgroundColor:item.bgColor}">
                            <div v-if="item.eltm2.data.words==null || item.eltm2.data.words==''">
                                <p>点此编辑『富文本』内容 ——&gt;</p>
                                <p>你可以对文字进行<strong>加粗</strong>、<em>斜体</em>、<span style="text-decoration: underline;">下划线</span>、<span style="text-decoration: line-through;">删除线</span>、文字<span style="color: rgb(0, 176, 240);">颜色</span>、<span style="background-color: rgb(255, 192, 0); color: rgb(255, 255, 255);">背景色</span>、以及字号<span style="font-size: 20px;">大</span><span style="font-size: 14px;">小</span>等简单排版操作。</p>
                                <p style="text-align: left;"><span style="text-align: left;">也可在这里插入图片。</span></p>
                            </div>
                            <div  v-html="item.eltm2.data.words">
                            
                            </div>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div  v-if="item.eltmType==3" class="m-scrollBox" v-bind:style="{height:item.eltm3.height+ 'px',lineHeight:item.eltm3.height+ 'px',backgroundColor:item.bgColor}">
                            
                            <img v-if="item.eltm3.data.length<=0" src="shop_admin/static/src/common/images/diy/img/375x200.png" />
                            <img v-if="item.eltm3.data.length>0" :src="item.eltm3.data[0].path || 'shop_admin/static/src/common/images/diy/img/375x200.png'"  />
                            <div v-if="item.eltm3.data.length>0" class="m-scrollBox-bot" >
                                <div class="bot-item" v-for="item in item.eltm3.data"></div>
                            </div>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
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
                                        <label>商品名称 </label>
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
                                        购买
                                    </div>
                                </div>
                            </div>
                            <div class="m_pitem" v-if="item.eltm4.data.length>0" v-for="items in item.eltm4.data" v-bind:style="{backgroundColor:item.bgColor}">
                                <div class="m_pinfo">
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
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div  v-if="item.eltmType==5"  class="m-blank" v-bind:style="{height:item.eltm5.height+ 'px',lineHeight:item.eltm5.height+ 'px',backgroundColor:item.bgColor}">
                            辅助空白区域
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
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
                            <div v-if="item.eltm6.data.length>0" v-for="items in item.eltm6.data"
                                 class="boxFlexItem1" v-bind:style="{
                                                            paddingTop:item.eltm6.paddingTop+'px',
                                                            paddingBottom:item.eltm6.paddingBottom+'px',
                                                            paddingLeft:item.eltm6.paddingLeftt+'px',
                                                            paddingRight:item.eltm6.paddingRight+'px',
                                                            fontSize:item.eltm6.fontSize+'px',
                                                            color:item.eltm6.fontColor
                                                            }">
                                <span v-if="item.eltm6.type==1" :style="{width:(items.flexNum>1?(items.flexNum+'px'):'100%')}">{{items.name || '请输入文字'}}</span>
                                <img v-if="item.eltm6.type==0" :src="items.path ||  'shop_admin/static/src/common/images/diy/img/187x100.png'" :style="{width:(items.flexNum>1?(items.flexNum+'px'):'100%')}"/>
                            </div>
                            <div class="boxFlexItem1" v-if="item.eltm6.data.length<=0" v-bind:style="{
                                                            paddingTop:item.eltm6.paddingTop+'px',
                                                            paddingBottom:item.eltm6.paddingBottom+'px',
                                                            paddingLeft:item.eltm6.paddingLeftt+'px',
                                                            paddingRight:item.eltm6.paddingRight+'px',
                                                            fontSize:item.eltm6.fontSize+'px',
                                                            color:item.eltm6.fontColor
                                                            }">
                                <img src="shop_admin/static/src/common/images/diy/img/187x100.png" />
                            </div>
                            <div class="boxFlexItem1" v-if="item.eltm6.data.length<=0" v-bind:style="{
                                                            paddingTop:item.eltm6.paddingTop+'px',
                                                            paddingBottom:item.eltm6.paddingBottom+'px',
                                                            paddingLeft:item.eltm6.paddingLeftt+'px',
                                                            paddingRight:item.eltm6.paddingRight+'px',
                                                            fontSize:item.eltm6.fontSize+'px',
                                                            color:item.eltm6.fontColor
                                                            }">
                                <img src="shop_admin/static/src/common/images/diy/img/187x100.png" />
                            </div>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div v-if="item.eltmType==7" v-bind:class="{boxGrids:item.eltmType==7,boxGridsBorder:item.eltm7.border}">
                            <span  v-bind:class="{boxGrid:item.eltmType==7,boxGridBorder:item.eltm7.border}" v-if="item.eltm7.data.length>0" v-for="items in item.eltm7.data" v-bind:style="{width:(100/item.eltm7.column)+'%',paddingTop:item.eltm7.paddingTop+'px',paddingBottom:item.eltm7.paddingBottom+'px',paddingLeft:item.eltm7.paddingLeftt+'px',paddingRight:item.eltm7.paddingRight+'px',backgroundColor:item.bgColor}">
                                <div class="boxGridIcon">
                                    <img :src="items.path || 'shop_admin/static/src/common/images/diy/img/90x90.png'" alt="">
                                </div>
                                <p class="boxGridLabel">{{items.name || '功能入口'}}</p>
                            </span>
                            <span  class="boxGrid" v-if="item.eltm7.data.length==0" v-for="items in [1,2,3,4,5,6,7,8,9]" v-bind:class="{boxGrid:item.eltmType==7,boxGridBorder:item.eltm7.border}" v-if="item.eltm7.data.length>0" v-for="items in item.eltm7.data" v-bind:style="{width:(100/item.eltm7.column)+'%',paddingTop:item.eltm7.paddingTop+'px',paddingBottom:item.eltm7.paddingBottom+'px',paddingLeft:item.eltm7.paddingLeftt+'px',paddingRight:item.eltm7.paddingRight+'px',backgroundColor:item.bgColor}">
                                <div class="boxGridIcon">
                                    <img src="shop_admin/static/src/common/images/diy/img/90x90.png" />
                                </div>
                                <p class="boxGridLabel">功能入口</p>
                            </span>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div  v-if="item.eltmType==9" class="searchBox"  v-bind:style="{backgroundColor:item.bgColor,paddingTop:item.eltm9.paddingTop+'px',
                                                            paddingBottom:item.eltm9.paddingBottom+'px',
                                                            paddingLeft:item.eltm9.paddingLeftt+'px',
                                                            paddingRight:item.eltm9.paddingRight+'px'}">
                            <div class="contentBox">
                                <i class="iconfont icon-sousuo"></i>{{item.eltm9.tipText}}
                            </div>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div class="videoBox" v-if="item.eltmType==12" >
                            <video  :src="item.eltm12.src" :controls="item.eltm12.controls" :autoplay="item.eltm12.autoplay" :loop="item.eltm12.loop" v-bind:style="{backgroundColor:item.bgColor,paddingTop:item.eltm12.paddingTop+'px',
                                                                paddingBottom:item.eltm12.paddingBottom+'px',
                                                                paddingLeft:item.eltm12.paddingLeftt+'px',
                                                                paddingRight:item.eltm12.paddingRight+'px',width:item.eltm12.width+'px',height:item.eltm12.height+'px'}">
                                您的浏览器不支持 video 标签。
                            </video>
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                        <div class="formBox" v-if="item.eltmType==13" v-bind:style="{backgroundColor:item.bgColor}">
                            <div v-if="item.eltm13.data.length>0">
                                <div v-for="items in item.eltm13.data">
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
                            <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                                <ul>
                                    <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                    <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-for="item in info" v-if="item.eltmType==8">
                    <div  class="mTel" v-bind:style="{backgroundColor:item.bgColor}">
                        <i class="iconfont icon-dianhua--copy" v-bind:style="{color:item.eltm8.fontColor}"></i>
                        <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                            <ul>
                                <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div v-for="item in info" v-if="item.eltmType==11">
                    <div  class="mCS" v-bind:style="{backgroundColor:item.bgColor}">
                        <i class="iconfont icon-kefu1" v-bind:style="{color:item.eltm11.fontColor}"></i>
                        <div class="editContent" v-bind:class="{editContent:item.id>0,borderRed:item.id==ckId}" v-on:click="editModule" :divid="item.id" :editType="item.eltmType">
                            <ul>
                                <li v-on:click.stop="editModule" :divid="item.id" :editType="item.eltmType">编辑</li>
                                <li v-bind:id="item.id" :editType="item.eltmType" v-on:click.stop="remvoeModule">删除</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="msk_qrCode">
                <a class="msk_qrcode_btn" v-on:click="Release">
                    保存预览
                </a>
                <div id="msk_qrcode_img">
                </div>
                <label style="color: red; font-size: 12px;display: inline-block; line-height: 20px; padding:0 20px; margin-top: 10px;">注：发布预览后可使用手机扫码预览效果</label>
            </div>
            <!--商品选择弹出框 start-->
            <div class="full_msk" v-if="isShowDataInfoList">
                <div class="full_msk_cn">
                    <div class="full_msk_title" v-if="listType==1">
                        选择商品 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==2">
                        选择分类 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==3">
                        选择素材 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==4">
                        选择快捷入口 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==5">
                        选择资讯分类 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==6">
                        选择资讯 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==7">
                        选择导航地址 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="full_msk_title" v-if="listType==8">
                        选择页面地址 <i class="iconfont icon-chuyidong" v-on:click="closeList"></i>
                    </div>
                    <div class="u-tableFrom">
                        <input type="text" name="searchProduct" v-model="searchText" placeholder="搜索关键字" maxlength="20"/>
                        <input type="button" value="搜索" :selectid="editId" :urlType="listType" v-on:click="searchInfo"/>
                    </div>
                    <div class="full_msk_table" style="height:80%">
                        
                        <ul v-if="listType==1 || listType==2 || listType==5 || listType==6 || listType==8">
                            <li  v-for="item in tplDataInfoList">
                                <div class="full_info">
                                    <div><img :src="item.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " style="width: 165px; height: 165px;"/></div>
                                    <span>{{item.name}}</span>
                                    <div><input type="button" :itemid="item.id" value="选取" v-on:click="useThatTplData"/></div>
                                </div>
                            </li>
                        </ul>
                        
                        <div v-if="listType==4">
                            <div class="full_icon" v-for="item in tplDataInfoList">
                                <div class="full_icon_item">
                                    <div><img :src="item.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " /></div>
                                    <span>{{item.name}}</span>
                                    <div><input type="button" :itemid="item.id" value="选取" v-on:click="useThatTplData"/></div>
                                </div>
                            </div>
                        </div>
                        <div v-if="listType==7">
                            <div class="tabBar_icon" v-for="item in tplDataInfoList">
                                <div class="tabBar_icon_item">
                                    <div><img :src="item.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " /><img :src="item.ProductTips || 'shop_admin/static/src/common/images/diy/img/up_img.png' " /></div>
                                    <span>{{item.name}}</span>
                                    <div><input type="button" :itemid="item.id" value="选取" v-on:click="useThatTplData"/></div>
                                </div>
                            </div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" v-if="listType==3">
                            <tr>
                                <td >标题</td>
                                <td >操作</td>
                            </tr>
                            <tr v-if="listType==3">
                                <td colspan="3">
                                    <select v-model="wordsType">
                                        <option value="1">素材</option>
                                        <option value="2">行业</option>
                                        <option value="3">节日</option>
                                    </select>
                                
                                </td>
                            </tr>
                            <tr v-if="wordsType==1 && listType==3" class="m_wordsType">
                                <td colspan="2">
                                    <label v-on:click="filterType" :dataVal="4">标题</label>
                                    <label v-on:click="filterType" :dataVal="5">正文</label>
                                    <label v-on:click="filterType" :dataVal="6">图文</label>
                                    <label v-on:click="filterType" :dataVal="7">关注</label>
                                    <label v-on:click="filterType" :dataVal="8">分割线</label>
                                    <label v-on:click="filterType" :dataVal="9">其他</label>
                                </td>
                            </tr>
                            <tr v-if="wordsType==2 && listType==3" class="m_wordsType">
                                <td colspan="2">
                                    <label v-on:click="filterType" :dataVal="10">电商</label>
                                    <label v-on:click="filterType" :dataVal="11">旅游</label>
                                    <label v-on:click="filterType" :dataVal="12">图文</label>
                                    <label v-on:click="filterType" :dataVal="13">医疗</label>
                                    <label v-on:click="filterType" :dataVal="14">教学</label>
                                </td>
                            </tr>
                            <tr v-if="wordsType==3 && listType==3" class="m_wordsType">
                                <td colspan="2">
                                    <label v-on:click="filterType" :dataVal="15">劳动节</label>
                                    <label v-on:click="filterType" :dataVal="16">清明节</label>
                                    <label v-on:click="filterType" :dataVal="17">元宵节</label>
                                    <label v-on:click="filterType" :dataVal="18">愚人节</label>
                                    <label v-on:click="filterType" :dataVal="19">母亲节</label>
                                    <label v-on:click="filterType" :dataVal="20">端午节</label>
                                    <label v-on:click="filterType" :dataVal="21">妇女节</label>
                                    <label v-on:click="filterType" :dataVal="22">情人节</label>
                                    <label v-on:click="filterType" :dataVal="23">315</label>
                                    <label v-on:click="filterType" :dataVal="24">元旦节</label>
                                    <label v-on:click="filterType" :dataVal="25">春节</label>
                                    <label v-on:click="filterType" :dataVal="26">圣诞节</label>
                                    <label>感恩节</label>
                                </td>
                            </tr>
                            <tbody>
                            <tr  v-for="item in tplDataInfoList">
                                <td><div class="html_box" v-html="item.name"></div></td>
                                <td><input type="button" :itemid="item.id" value="选取" v-on:click="useThatTplData"/></td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="display:block; clear:both;">
                            <div class="pageInfo">
                                <input type="button" value="上一页" v-if="pageData.isPrevPage" v-on:click="PrevPage"/>
                                <label>当前第</label><em>{{pageData.nowPageIndx}}</em><label>页</label>/<label>共</label><em>{{pageData.pageTotal}}</em><label>页</label>
                                <input type="button" value="下一页" v-if="pageData.isNextPage" v-on:click="NextPage"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--商品选择弹出框 end-->
            <div v-if="isMsk" class="msk_box" >
                <div class="nav-tabs">
                    <div class="nav-tabs-item" v-bind:class="{active:tabNum==1}" data-tabNum="1" v-on:click="selectTab">
                        <label data-tabNum="1">组件样式</label>
                    </div>
                    <div class="nav-tabs-item" v-bind:class="{active:tabNum==2}" data-tabNum="2" v-on:click="selectTab">
                        <label data-tabNum="2">组件数据</label>
                    </div>
                </div>
                <!--组件样式 start-->
                <div v-if="tabNum==1">
                    <div class="sub-content" v-if="showTitleConfig">
                        <div class="sub-level1 box_border">
                            <div class="sub-label">
                                文字颜色
                            </div>
                            <div class="inputicon">
                                <div class="radioBox">
                                    <input type="radio" id="f1" v-model="appConfig.window.navigationBarTextStyle" value="white" />
                                    <label for="f1" style="background-color:White;"></label>
                                </div>
                            </div>
                            <div class="inputicon">
                                <div class="radioBox">
                                    <input type="radio" id="f2" v-model="appConfig.window.navigationBarTextStyle" value="black" />
                                    <label for="f2" style="background-color:black;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="sub-level1 box_border">
                            <div class="sub-label">
                                背景颜色
                            </div>
                            <div class="inputicon">
                                <input type="color" v-model="appConfig.window.navigationBarBackgroundColor" />
                            </div>
                        </div>
                    </div>
                    <div class="sub-content" v-if="showTabBarConfig">
                        <div class="sub-level1 box_border">
                            <div class="sub-label">
                                导航类型
                            </div>
                            <div class="inputicon">
                                <div class="radioBox">
                                    <input type="radio" id="Radio1" v-model="appConfig.tabBar.position" value="bottom" />
                                    <label for="Radio1" ><i class="iconfont icon-tupian"></i></label>
                                </div>
                            </div>
                            <div class="inputicon">
                                <div class="radioBox">
                                    <input type="radio" id="Radio2" v-model="appConfig.tabBar.position" value="top" />
                                    <label for="Radio2" ><i class="iconfont icon-wenzi"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="sub-level1 box_border">
                            <div class="sub-label">
                                背景颜色
                            </div>
                            <div class="inputicon">
                                <input type="color" v-model="appConfig.tabBar.backgroundColor" />
                            </div>
                        </div>
                        <div class="sub-level1 box_border">
                            <div class="sub-label ">
                                文字颜色
                            </div>
                            <div class="inputicon">
                                <input type="color" v-model="appConfig.tabBar.color" />
                            </div>
                        </div>
                        <div class="sub-level1 box_border">
                            <div class="sub-label ">
                                选中文字颜色
                            </div>
                            <div class="inputicon">
                                <input type="color" v-model="appConfig.tabBar.selectedColor" />
                            </div>
                        </div>
                    </div>
                    <div class="sub-content" v-if="!showTitleConfig && !showTabBarConfig && !showPageConfig">
                        <div v-for="item in info" v-if="item.id==ckId">
                            <div class="sub-level1 box_border">
                                <div class="sub-label">
                                    背景颜色
                                </div>
                                <div class="inputicon">
                                    <input type="color" v-model="item.bgColor" />
                                </div>
                                <div class="inputicon">
                                    <div class="radioBox">
                                        <input type="radio" :id="'Radio48'+item.id" v-model="item.bgColor" value="rgba(0,0,0,0)" />
                                        <label :for="'Radio48'+item.id" ><i class="iconfont icon-xiegang"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div v-if="item.eltmType==13">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮文字
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm13.btnText" maxlength="20"/>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮背景颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color" v-model="item.eltm13.btnColor" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮文字颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color" v-model="item.eltm13.fontColor"/>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label" >
                                        标题颜色
                                    </div>
                                    <div class="inputBox">
                                        <input type="color" v-model="item.eltm13.labelColor" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label" >
                                        文字颜色
                                    </div>
                                    <div class="inputBox">
                                        <input type="color" v-model="item.eltm13.textColor" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        提交反馈
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm13.btnFeedback" maxlength="50"/>
                                    </div>
                                </div>
                            </div>
                            <!--图片类型 start-->
                            <div v-if="item.eltmType==1">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        对齐
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio3" v-model="item.eltm1.align" value="1" />
                                            <label for="Radio3" ><i class="iconfont icon-zuoduiqi"></i></label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio4" v-model="item.eltm1.align" value="2" />
                                            <label for="Radio4" ><i class="iconfont icon-youduiqi"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 start-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        尺寸(宽x高)
                                    </div>
                                    <div class="minIcon">
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio5" v-model="item.eltm1.layout" value="1" />
                                                <label for="Radio5" >
                                                    <i>750x750</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio6" v-model="item.eltm1.layout" value="2" />
                                                <label for="Radio6" >
                                                    <i>750x375</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio7" v-model="item.eltm1.layout" value="3" />
                                                <label for="Radio7" >
                                                    <i>375x750</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio8" v-model="item.eltm1.layout" value="4" />
                                                <label for="Radio8" >
                                                    <i>750x188</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon icon_img">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio9" v-model="item.eltm1.layout" value="5" />
                                                <label for="Radio9" >
                                                    <i>375x375</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio10" v-model="item.eltm1.layout" value="6" />
                                                <label for="Radio10" >
                                                    <i>375x188</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon icon_img">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio11" v-model="item.eltm1.layout" value="7" />
                                                <label for="Radio11" >
                                                    <i>188x375</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio12" v-model="item.eltm1.layout" value="8" />
                                                <label for="Radio12" >
                                                    <i>188x188</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 end-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否需要分割线
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm1.border" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        上边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm1.paddingTop" />{{item.eltm1.paddingTop}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        下边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm1.paddingBottom" />{{item.eltm1.paddingBottom}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        左边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm1.paddingLeftt" />{{item.eltm1.paddingLeftt}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        右边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm1.paddingRight" />{{item.eltm1.paddingRight}}px
                                    </div>
                                </div>
                            </div>
                            <!--图片类型 end-->
                            <!--富文本 start-->
                            <div v-if="item.eltmType==2">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        内间距
                                    </div>
                                    <div class="inputicon">
                                        <input  type="range" v-model="item.eltm2.padding" max="50" />{{item.eltm2.padding}}px
                                    </div>
                                </div>
                            </div>
                            <!--富文本 end-->
                            <!--轮播 start-->
                            <div v-if="item.eltmType==3">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        高度
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm3.height" max="300" />{{item.eltm3.height}}px
                                    </div>
                                </div>
                            </div>
                            <!--轮播 end-->
                            <!--商品列表 start-->
                            <div v-if="item.eltmType==4">
                                <div class="sub-level1 box_border imgIcon">
                                    <div class="sub-label">
                                        列表样式
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio13" v-model="item.eltm4.listTyle" value="1" />
                                            <label for="Radio13" >
                                                <img src="shop_admin/static/src/common/images/diy/img/t_03.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio14" v-model="item.eltm4.listTyle" value="2" />
                                            <label for="Radio14" >
                                                <img src="shop_admin/static/src/common/images/diy/img/t_06.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio15" v-model="item.eltm4.listTyle" value="3" />
                                            <label for="Radio15" >
                                                <img src="shop_admin/static/src/common/images/diy/img/t_08.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio16" v-model="item.eltm4.listTyle" value="4" />
                                            <label for="Radio16" >
                                                <img src="shop_admin/static/src/common/images/diy/img/t_10.png" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮样式
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio21" v-model="item.eltm4.btnType" value="0" />
                                            <label for="Radio21" >
                                                无
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio17" v-model="item.eltm4.btnType" value="1" />
                                            <label for="Radio17" >
                                                <img src="shop_admin/static/src/common/images/diy/img/pc1.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio18" v-model="item.eltm4.btnType" value="2" />
                                            <label for="Radio18" >
                                                <img src="shop_admin/static/src/common/images/diy/img/pc2.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio19" v-model="item.eltm4.btnType" value="3" />
                                            <label for="Radio19" >
                                                <img src="shop_admin/static/src/common/images/diy/img/pc3.png" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio20" v-model="item.eltm4.btnType" value="4" />
                                            <label for="Radio20" >
                                                <img src="shop_admin/static/src/common/images/diy/img/pc4.png" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="item.eltm4.btnType==4" class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮背景
                                    </div>
                                    <div class="inputicon">
                                        <input type="color" v-model="item.eltm4.btnColor" />
                                    </div>
                                </div>
                                <div v-if="item.eltm4.btnType==4" class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮文字
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm4.btnText" maxlength="5"/>
                                    </div>
                                </div>
                                <div v-if="item.eltm4.btnType==4" class="sub-level1 box_border">
                                    <div class="sub-label">
                                        按钮文字颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color" v-model="item.eltm4.btnFontColor"/>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否展示价格
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm4.isPrice" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否展示卖点
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm4.isProductTips" />
                                    </div>
                                </div>
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        价格颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color" v-model="item.eltm4.priceColor" />
                                    </div>
                                </div>
                            </div>
                            <!--商品列表 end-->
                            <!--辅助空白 start-->
                            <div v-if="item.eltmType==5">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        高度
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm5.height" />{{item.eltm5.height}}px
                                    </div>
                                </div>
                            </div>
                            <!--辅助空白 end-->
                            <!--表格 start-->
                            <div v-if="item.eltmType==6">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        展示类型
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio22" v-model="item.eltm6.type" value="0" />
                                            <label for="Radio22" title="展示为图片的样式"><i class="iconfont icon-tupian"></i></label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio23" v-model="item.eltm6.type" value="1" />
                                            <label for="Radio23" title="展示为文字的样式"><i class="iconfont icon-wenzi"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="item.eltm6.type==1" class="sub-level1  box_border">
                                    <div class="sub-label">
                                        文字大小
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm6.fontSize" max="20" min="10"/>{{item.eltm6.fontSize}}px
                                    </div>
                                </div>
                                <div v-if="item.eltm6.type==1" class="sub-level1  box_border">
                                    <div class="sub-label">
                                        文字颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color"  v-model="item.eltm6.fontColor" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        上边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm6.paddingTop" />{{item.eltm6.paddingTop}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        下边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm6.paddingBottom" />{{item.eltm6.paddingBottom}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        左边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm6.paddingLeftt" />{{item.eltm6.paddingLeftt}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        右边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm6.paddingRight" />{{item.eltm6.paddingRight}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        水平对齐
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio24" v-model="item.eltm6.justifyContent" value="0" />
                                            <label for="Radio24" ><i class="iconfont icon-zuoduiqi"></i></label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio26" v-model="item.eltm6.justifyContent" value="2" />
                                            <label for="Radio26" ><i class="iconfont icon-juzhongduiqi"></i></label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio25" v-model="item.eltm6.justifyContent" value="1" />
                                            <label for="Radio25" ><i class="iconfont icon-youduiqi"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 start-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        垂直对齐
                                    </div>
                                    <div class="minIcon">
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio34" v-model="item.eltm6.alignItems" value="0" />
                                                <label for="Radio34" >
                                                    <i>上对齐</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio35" v-model="item.eltm6.alignItems" value="1" />
                                                <label for="Radio35" >
                                                    <i>下对齐</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio36" v-model="item.eltm6.alignItems" value="2" />
                                                <label for="Radio36" >
                                                    <i>垂直居中</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio37" v-model="item.eltm6.alignItems" value="3" />
                                                <label for="Radio37" >
                                                    <i>填充</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon icon_img">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio38" v-model="item.eltm6.alignItems" value="4" />
                                                <label for="Radio38" >
                                                    <i>内容对齐</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 end-->
                                <!--尺寸 start-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        排列方向
                                    </div>
                                    <div class="minIcon">
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio39" v-model="item.eltm6.flexDirection" value="0" />
                                                <label for="Radio39" >
                                                    <i>水平从左至右</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio40" v-model="item.eltm6.flexDirection" value="1" />
                                                <label for="Radio40" >
                                                    <i>水平从右至左</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio41" v-model="item.eltm6.flexDirection" value="2" />
                                                <label for="Radio41" >
                                                    <i>垂直从上至下</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio42" v-model="item.eltm6.flexDirection" value="3" />
                                                <label for="Radio42" >
                                                    <i>垂直从下至上</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 end-->
                                <!--尺寸 start-->
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        换行参数
                                    </div>
                                    <div class="minIcon">
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio43" v-model="item.eltm6.flexWrap" value="0" />
                                                <label for="Radio43" >
                                                    <i>不换行</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio44" v-model="item.eltm6.flexWrap" value="1" />
                                                <label for="Radio44" >
                                                    <i>换行顺序</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" id="Radio45" v-model="item.eltm6.flexWrap" value="2" />
                                                <label for="Radio45" >
                                                    <i>换行倒序</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--尺寸 end-->
                            </div>
                            <!--表格 end-->
                            <!--九宫格 start-->
                            <div v-if="item.eltmType==7">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        列数
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm7.column" max="5" min="1"/>{{item.eltm7.column}}列
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        是否需要分割线
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm7.border" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        上边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm7.paddingTop" />{{item.eltm7.paddingTop}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        下边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm7.paddingBottom" />{{item.eltm7.paddingBottom}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        左边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm7.paddingLeftt" />{{item.eltm7.paddingLeftt}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        右边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm7.paddingRight" />{{item.eltm7.paddingRight}}px
                                    </div>
                                </div>
                            </div>
                            <!--九宫格 end-->
                            <!--电话号码 start-->
                            <div v-if="item.eltmType==8">
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        图标颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color"  v-model="item.eltm8.fontColor" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        电话号码
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm8.tel" maxlength="20"/>
                                    </div>
                                </div>
                            </div>
                            <!--电话号码 end-->
                            <!--客服 start-->
                            <div v-if="item.eltmType==11">
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        图标颜色
                                    </div>
                                    <div class="inputicon">
                                        <input type="color"  v-model="item.eltm11.fontColor" />
                                    </div>
                                </div>
                            </div>
                            <!--客服 end-->
                            <!--搜索 start-->
                            <div v-if="item.eltmType==9">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        上边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm9.paddingTop" />{{item.eltm9.paddingTop}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        下边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm9.paddingBottom" />{{item.eltm9.paddingBottom}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        左边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm9.paddingLeftt" />{{item.eltm9.paddingLeftt}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        右边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm9.paddingRight" />{{item.eltm9.paddingRight}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        提示内容
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm9.tipText" maxlength="15"/>
                                    </div>
                                </div>
                            </div>
                            <!--搜索 end-->
                            <!--视频 start-->
                            <div v-if="item.eltmType==12" data-FeatureKey="VideoCnt">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        视频地址
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.eltm12.src" maxlength="500"/>
                                    </div>
                                </div>
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        进度条
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm12.controls" />
                                    </div>
                                </div>
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        自动播放
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm12.autoplay" />
                                    </div>
                                </div>
                                <div class="sub-level1  box_border">
                                    <div class="sub-label">
                                        循环播放
                                    </div>
                                    <div class="inputicon">
                                        <input class="weui-switch" type="checkbox" v-model="item.eltm12.loop" />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        宽度
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.width" max="375"/>{{item.eltm12.width}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        高度
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.height" max="667"/>{{item.eltm12.height}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        上边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.paddingTop" />{{item.eltm12.paddingTop}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        下边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.paddingBottom" />{{item.eltm12.paddingBottom}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        左边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.paddingLeftt" />{{item.eltm12.paddingLeftt}}px
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        右边距
                                    </div>
                                    <div class="inputicon">
                                        <input type="range" v-model="item.eltm12.paddingRight" />{{item.eltm12.paddingRight}}px
                                    </div>
                                </div>
                            </div>
                            <!--视频 end-->
                        </div>
                    </div>
                    <div class="sub-content" v-if="modelType==10 && showPageConfig">
                        <div class="sub-level1 box_border">
                            <div class="sub-label">
                                背景类型
                            </div>
                            <div class="minIcon">
                                <div class="inputicon">
                                    <div class="radioBox">
                                        <input type="radio" id="Radio47" v-model="PageConfig.BackgroundObj.type" value="1" />
                                        <label for="Radio47" ><i>背景颜色</i></label>
                                    </div>
                                </div>
                                <div class="inputicon">
                                    <div class="radioBox">
                                        <input type="radio" id="Radio46" v-model="PageConfig.BackgroundObj.type" value="0" />
                                        <label for="Radio46" ><i>背景图片</i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sub-level1 box_border" v-if="PageConfig.BackgroundObj.type==1">
                            <div class="sub-label">
                                背景颜色
                            </div>
                            <div class="inputicon">
                                <input type="color" v-model="PageConfig.BackgroundObj.bgColor" />
                            </div>
                        </div>
                        <div v-if="PageConfig.BackgroundObj.type==0">
                            <div class="sub-level1 box_border">
                                <div class="sub-label">
                                    图片补全背景
                                </div>
                                <div class="inputicon">
                                    <input type="color" v-model="PageConfig.BackgroundObj.pathColor" />
                                </div>
                            </div>
                            <div class="sub-level1 box_border" >
                                <div class="sub-label">
                                    背景图片
                                </div>
                                <div class="inputicon m_data_img" style="width:200px !important;height:355px !important;">
                                     <span v-if="isUploadImage">
                                        <input type="file" :name="'upfile'" :id="'indexBgImg'"  v-on:change="uploadImage" :fileId="'indexBgImg'" />
                                     </span>
                                    <img :src="PageConfig.BackgroundObj.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " :imgId="'indexBgImg'"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--组件样式 end-->
                
                <!--组件设置 start-->
                <div class="sub-content">
                    <div v-if="tabNum==2 && showTabBarConfig">
                        <div class="expand_menu_box" v-for="(item,index) in appConfig.tabBar.list" >
                            <div class="sub-level-title" v-on:click.stop="expandMenu">
                                第{{index+1}}项
                                <i class="iconfont icon-moreunfold"  ></i>
                                <i class="iconfont icon-icon-del-copy"  :tabBarIndex="index" v-if="index!=0" v-on:click="removeTabBar"></i>
                            </div >
                            <div class="expand_menu_content" v-bind:class="{hidebox:index>0}">
                                
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        未选中图标
                                    </div>
                                    <div class="inputicon m_data_img">
                                    <span v-if="isUploadImage">
                                        <input type="file" name="upfile" :id="'File'+index"  v-on:change="uploadImage" :fileId="index"/>
                                    </span>
                                        <img :src="item.iconPath || 'shop_admin/static/src/common/images/diy/img/up_img.png' " :imgId="index"/>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        选中的图标
                                    </div>
                                    <div class="inputicon m_data_img">
                                        <span v-if="isUploadImage">
                                        <input type="file" name="upfile" :id="'File'+(index+12)"  v-on:change="uploadImage" :fileId="index+12" />
                                        </span>
                                        <img :src="item.selectedIconPath || 'shop_admin/static/src/common/images/diy/img/up_img.png' " :imgId="index+12"/>
                                    </div>
                                </div>
                                <div  class="sub-level1 box_border">
                                    <div class="sub-label">
                                        选择地址
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="item.text" placeholder="连接地址"  maxlength="100" style="width:200px "/>
                                        <a href="javascript:void(0)" v-on:click="getModuleTplData" :selectid="index" :urlType="7" v-if="index!=0">选择</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="msk_add_ad" v-on:click="addTabBar">
                            <label></label>添加
                        </div>
                    </div>
                    <div v-if="tabNum==2 && !showTitleConfig && !showTabBarConfig">
                        <div v-if="msType==1">
                            <!--图片 start-->
                            <div class="sub-level1 box_border">
                                <div class="sub-label">
                                    上传图片
                                </div>
                                <div class="inputicon m_data_img">
                                    <span v-if="isUploadImage">
						                <input type="file" name="upfile" :id="'File'+mskData.id"  v-on:change="uploadImage" :fileId="mskData.id" />
                                    </span>
                                    <img :src="mskData.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " :imgId="mskData.id"/>
                                </div>
                            </div>
                            <!--图片 start-->
                            <!--尺寸 start-->
                            <div class="sub-level1 box_border">
                                <div class="sub-label">
                                    链接地址
                                </div>
                                <div class="minIcon">
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio48" v-model="mskData.selectType" value="0" />
                                            <label for="Radio48" >
                                                <i>无链接</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio27" v-model="mskData.selectType" value="1" />
                                            <label for="Radio27" >
                                                <i>商品</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio28" v-model="mskData.selectType" value="2" />
                                            <label for="Radio28" >
                                                <i>分类</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio29" v-model="mskData.selectType" value="3" />
                                            <label for="Radio29" >
                                                <i>搜索</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio30" v-model="mskData.selectType" value="4" />
                                            <label for="Radio30" >
                                                <i>快捷入口</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon icon_img">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio31" v-model="mskData.selectType" value="5" />
                                            <label for="Radio31" >
                                                <i>资讯分类</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio32" v-model="mskData.selectType" value="6" />
                                            <label for="Radio32" >
                                                <i>资讯</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon icon_img">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio33" v-model="mskData.selectType" value="7" />
                                            <label for="Radio33" >
                                                <i>小程序</i>
                                            </label>
                                        </div>
                                    </div>
                                <div class="inputicon icon_img" v-if="FeatureKeyList.indexOf('DiyLnkPage')>=0">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio49" v-model="mskData.selectType" value="8" />
                                            <label for="Radio49" >
                                                <i>自定义页面</i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputicon icon_img">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio50" v-model="mskData.selectType" value="9" />
                                            <label for="Radio50" >
                                                <i>网页地址</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--尺寸 end-->
                            <!--设置 start-->
                            <div  class="sub-level1 box_border" v-if="mskData.selectType==3">
                                <div class="sub-label">
                                    搜索关键字
                                </div>
                                <div class="inputBox">
                                    <input  maxlength="20" type="text" placeholder="请输入搜索关键字" v-model="mskData.keyWord" />
                                </div>
                            </div>
                            <div  class="sub-level1 box_border" v-if="mskData.selectType==7">
                                <div class="sub-label">
                                    APPID
                                </div>
                                <div class="inputBox">
                                    <input type="text" v-model="mskData.AppId" placeholder="请输入小程序APPID"  maxlength="18"/>
                                </div>
                            </div>
                            <div  class="sub-level1 box_border" v-if="mskData.selectType==7 || mskData.selectType==3">
                                <div class="sub-label">
                                    名称
                                </div>
                                <div class="inputBox">
                                    <input type="text" v-model="mskData.name" placeholder="请输入名称" maxlength="20"/>
                                </div>
                            </div>
                            <div v-if="mskData.selectType==1">
                                <div  class="sub-level1 box_border">
                                    <div class="inputBox inputBtn">
                                        <input type="button" v-on:click="getModuleTplData"  :selectid="mskData.id" :urlType="mskData.selectType" value="选择商品">
                                    </div>
                                </div>
                                <div  class="sub-level1 box_border">
                                    <div class="sub-label">
                                        名称
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="mskData.name" placeholder="请输入名称" maxlength="20"/>
                                    </div>
                                </div>
                                <div  class="sub-level1 box_border">
                                    <div class="sub-label">
                                        卖点
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="mskData.ProductTips" placeholder="请输入卖点"  maxlength="20"/>
                                    </div>
                                </div>
                                <div  class="sub-level1 box_border">
                                    <div class="sub-label">
                                        价格(元)
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="mskData.ItemSalePrice" placeholder="请输入价格" maxlength="20"/>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-level1 box_border" v-if="mskData.selectType!=1 && mskData.selectType!=3 && mskData.selectType!=7 && mskData.selectType!=0">
                                <div class="sub-label" v-if="mskData.selectType==2">
                                    选择分类地址
                                </div>
                                <div class="sub-label" v-if="mskData.selectType==4">
                                    选择快捷入口地址
                                </div>
                            <div class="sub-label" v-if="mskData.selectType==5 && FeatureKeyList.indexOf('Newsletter')>=0" >
                                    选择资讯分类地址
                                </div>
                            <div class="sub-label" v-if="mskData.selectType==6 && FeatureKeyList.indexOf('Newsletter')>=0">
                                    选择资讯地址
                                </div>
                            <div class="sub-label" v-if="mskData.selectType==8 && FeatureKeyList.indexOf('DiyLnkPage')>=0" >
                                    选择二级页面
                                </div>
                                <div class="inputBox" v-if="mskData.selectType!=9">
                                    <input type="text" v-model="mskData.name" placeholder="请选择地址"  /><a href="javascript:void(0)" v-on:click="getModuleTplData"  :selectid="mskData.id" :urlType="mskData.selectType">选择</a>
                                </div>
                                <span v-if="mskData.selectType==9">
                                <div class="sub-level1 box_border">
                                    <div class="sub-label" >
                                          输入网页地址
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="mskData.AppUrl" placeholder="请输入网页地址"  />
                                        <p style="color: red;line-height: 20px;">注：需登录小程序管理后台配置域名白名单。</p>
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label" >
                                          标题
                                    </div>
                                    <div class="inputBox">
                                        <input type="text" v-model="mskData.name" placeholder="请输入标题"  />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label" >
                                          标题栏颜色
                                    </div>
                                    <div class="inputBox">
                                        <input type="color" v-model="mskData.keyWord" placeholder="请选择标题栏颜色"  />
                                    </div>
                                </div>
                                <div class="sub-level1 box_border">
                                    <div class="sub-label">
                                        标题文字颜色
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio51" v-model="mskData.AppId" value="white" />
                                            <label for="Radio51" style="background-color:White;"></label>
                                        </div>
                                    </div>
                                    <div class="inputicon">
                                        <div class="radioBox">
                                            <input type="radio" id="Radio52" v-model="mskData.AppId" value="black" />
                                            <label for="Radio52" style="background-color:black;"></label>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            </div>
                            <!--设置 end-->
                        </div>
                        <div  v-if="msType==4 || msType==3 || msType==6 || msType==7 ">
                            <div class="expand_menu_box" v-for="(item,index) in mskDataArray" >
                                <div class="sub-level-title" v-on:click="expandMenu">
                                    第{{index+1}}项
                                    <span class="isHome"></span>
                                    <i class="iconfont icon-moreunfold"  ></i>
                                    <i class="iconfont icon-icon-del-copy"  :deleteId="item.id" v-on:click.stop="deleteItem"></i>
                                </div >
                                <div class="expand_menu_content" v-bind:class="{hidebox:index>0}" >
                                    <!--图片 start-->
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label">
                                            上传图片
                                        </div>
                                        <div class="inputicon m_data_img">
                                     <span v-if="isUploadImage">
						                <input type="file" name="upfile" :id="'File'+item.id"  v-on:change="uploadImage" :fileId="item.id"/>
                                     </span>
                                            <img :src="item.path || 'shop_admin/static/src/common/images/diy/img/up_img.png' " :imgId="item.id"/>
                                        </div>
                                    </div>
                                    <div class="sub-level1  box_border" v-if="msType==6">
                                        <div class="sub-label">
                                            宽度
                                        </div>
                                        <div class="inputicon">
                                            <input type="range" v-model="item.flexNum" max="375" min="0"/>{{item.flexNum>1?(item.flexNum+'px'):'自适应'}}
                                        </div>
                                    </div>
                                    <!--图片 start-->
                                    <!--尺寸 start-->
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label">
                                            链接地址
                                        </div>
                                        <div class="minIcon">
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio49'+item.id" v-model="item.selectType" value="0" />
                                                    <label :for="'Radio49'+item.id" >
                                                        <i>无链接</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio34'+item.id" v-model="item.selectType" value="1" />
                                                    <label :for="'Radio34'+item.id" >
                                                        <i>商品</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio35'+item.id" v-model="item.selectType" value="2" />
                                                    <label :for="'Radio35'+item.id" >
                                                        <i>分类</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio36'+item.id" v-model="item.selectType" value="3" />
                                                    <label :for="'Radio36'+item.id" >
                                                        <i>搜索</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio37'+item.id" v-model="item.selectType" value="4" />
                                                    <label :for="'Radio37'+item.id" >
                                                        <i>快捷入口</i>
                                                    </label>
                                                </div>
                                            </div>
                                    <div class="inputicon icon_img" v-if="FeatureKeyList.indexOf('Newsletter')>=0">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio38'+item.id" v-model="item.selectType" value="5" />
                                                    <label :for="'Radio38'+item.id" >
                                                        <i>资讯分类</i>
                                                    </label>
                                                </div>
                                            </div>
                                    <div class="inputicon" v-if="FeatureKeyList.indexOf('Newsletter')>=0">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio39'+item.id" v-model="item.selectType" value="6" />
                                                    <label :for="'Radio39'+item.id" >
                                                        <i>资讯</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon icon_img">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio40'+item.id" v-model="item.selectType" value="7" />
                                                    <label :for="'Radio40'+item.id" >
                                                        <i>小程序</i>
                                                    </label>
                                                </div>
                                            </div>
                                    <div class="inputicon icon_img" v-if="FeatureKeyList.indexOf('DiyLnkPage')>=0">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio50'+item.id" v-model="item.selectType" value="8" />
                                                    <label :for="'Radio50'+item.id" >
                                                        <i>自定义页面</i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="inputicon icon_img">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio51'+item.id" v-model="item.selectType" value="9" />
                                                    <label :for="'Radio51'+item.id" >
                                                        <i>网页地址</i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--尺寸 end-->
                                    <!--设置 start-->
                                    <div  class="sub-level1 box_border" v-if="item.selectType==3">
                                        <div class="sub-label">
                                            搜索关键字
                                        </div>
                                        <div class="inputBox">
                                            <input  maxlength="20" type="text" placeholder="请输入搜索关键字" v-model="item.keyWord" />
                                        </div>
                                    </div>
                                    <div  class="sub-level1 box_border" v-if="item.selectType==7">
                                        <div class="sub-label">
                                            APPID
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.AppId" placeholder="请输入小程序APPID"  maxlength="18"/>
                                        </div>
                                    </div>
                                    <div  class="sub-level1 box_border" v-if="item.selectType==7 || item.selectType==3">
                                        <div class="sub-label">
                                            名称
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.name" placeholder="请输入名称" maxlength="20"/>
                                        </div>
                                    </div>
                                    <div v-if="item.selectType==1">
                                        <div  class="sub-level1 box_border">
                                            <div class="inputBox inputBtn">
                                                <input type="button" v-on:click="getModuleTplData"  :selectid="item.id" :urlType="item.selectType" value="选择商品">
                                            </div>
                                        </div>
                                        <div  class="sub-level1 box_border">
                                            <div class="sub-label">
                                                名称
                                            </div>
                                            <div class="inputBox">
                                                <input type="text" v-model="item.name" placeholder="请输入名称" maxlength="20"/>
                                            </div>
                                        </div>
                                        <div  class="sub-level1 box_border">
                                            <div class="sub-label">
                                                卖点
                                            </div>
                                            <div class="inputBox">
                                                <input type="text" v-model="item.ProductTips" placeholder="请输入卖点"  maxlength="20"/>
                                            </div>
                                        </div>
                                        <div  class="sub-level1 box_border">
                                            <div class="sub-label">
                                                价格
                                            </div>
                                            <div class="inputBox">
                                                <input type="text" v-model="item.ItemSalePrice" placeholder="请输入价格" maxlength="20"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border" v-if="item.selectType!=1 && item.selectType!=3 && item.selectType!=7 && item.selectType!=0">
                                        <div class="sub-label" v-if="item.selectType==2">
                                            选择分类地址
                                        </div>
                                        <div class="sub-label" v-if="item.selectType==4">
                                            选择快捷入口地址
                                        </div>
                                        <div class="sub-label" v-if="item.selectType==5">
                                            选择资讯分类地址
                                        </div>
                                        <div class="sub-label" v-if="item.selectType==6">
                                            选择资讯地址
                                        </div>
                                <div class="sub-label" v-if="item.selectType==8 && FeatureKeyList.indexOf('DiyLnkPage')>=0" >
                                            选择二级页面
                                        </div>
                                        <div class="inputBox" v-if="item.selectType!=9">
                                            <input type="text" v-model="item.name" placeholder="请选择地址"  /><a href="javascript:void(0)" v-on:click="getModuleTplData"  :selectid="item.id" :urlType="item.selectType">选择</a>
                                        </div>
                                        <span v-if="item.selectType==9">
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label" >
                                              输入网页地址
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.AppUrl" placeholder="请输入网页地址"  />
                                            <p style="color: red;line-height: 20px;">注：需登录小程序管理后台配置域名白名单。</p>
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label" >
                                              标题
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.name" placeholder="请输入标题"  />
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label" >
                                              标题栏颜色
                                        </div>
                                        <div class="inputBox">
                                            <input type="color" v-model="item.keyWord" placeholder="请选择标题栏颜色"  />
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label">
                                            标题文字颜色
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio53'+item.id" v-model="item.AppId" value="white" />
                                                <label :for="'Radio53'+item.id" style="background-color:White;"></label>
                                            </div>
                                        </div>
                                        <div class="inputicon">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio54'+item.id" v-model="item.AppId" value="black" />
                                                <label :for="'Radio54'+item.id" style="background-color:black;"></label>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                    </div>
                                    <!--设置 end-->
                                </div>
                            </div>
                            <div class="msk_add_ad" v-on:click="addModuleContent">
                                <label></label>添加
                            </div>
                        </div>
                        <div v-if="msType==2">
                            <div class="sub-label">
                                富文本内容
                            </div>
                            <div class="inputBox">
                                <a href="javascript:void(0)" v-on:click="getModuleTplData"  :selectid="mskData.id" :urlType="3" style="padding-bottom:10px;display: block;">选择素材</a>
                                <ueditor  v-bind:value="mskData.words" v-on:input="input" v-on:ready="ready"></ueditor>
                            </div>
                        </div>
                        <div v-if="msType==13">
                            <div class="expand_menu_box" v-for="(item,index) in mskDataArray">
                                <div class="sub-level-title" v-on:click="expandMenu">
                                    第{{index+1}}项
                                    <span class="isHome"></span>
                                    <i class="iconfont icon-moreunfold"  ></i>
                                    <i class="iconfont icon-icon-del-copy"  :deleteId="item.id" v-on:click.stop="deleteItem"></i>
                                </div >
                                <div class="expand_menu_content" v-bind:class="{hidebox:index>0}" >
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label" style="width: 100%">
                                            控件类型
                                        </div>
                                        <div class="inputicon sub-type">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio55'+item.id" v-model="item.type" value="1" />
                                                <label :for="'Radio55'+item.id" >
                                                    <img src="shop_admin/static/src/common/images/diy/img/subForm1.png" />
                                                    <i>text</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon sub-type">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio56'+item.id" v-model="item.type" value="2" />
                                                <label :for="'Radio56'+item.id" >
                                                    <img src="shop_admin/static/src/common/images/diy/img/subForm7_maka.png" />
                                                    <i>data</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon sub-type">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio57'+item.id" v-model="item.type" value="3" />
                                                <label :for="'Radio57'+item.id" >
                                                    <img src="shop_admin/static/src/common/images/diy/img/subForm2.png" />
                                                    <i>textarea</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon sub-type">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio58'+item.id" v-model="item.type" value="4" />
                                                <label :for="'Radio58'+item.id" >
                                                    <img src="shop_admin/static/src/common/images/diy/img/subForm34.png" />
                                                    <i>radio</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="inputicon sub-type">
                                            <div class="radioBox">
                                                <input type="radio" :id="'Radio59'+item.id" v-model="item.type" value="5" />
                                                <label :for="'Radio59'+item.id" >
                                                    <img src="shop_admin/static/src/common/images/diy/img/subForm31.png" />
                                                    <i>checkbox</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border">
                                        <div class="sub-label" >
                                            标题
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.labelText" placeholder="请输入标题"  />
                                        </div>
                                    </div>
                                    <div class="sub-level1 box_border" v-if="item.type<4">
                                        <div class="sub-label" >
                                            占位符
                                        </div>
                                        <div class="inputBox">
                                            <input type="text" v-model="item.placeholderText" placeholder="请输入占位符"  />
                                        </div>
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                边框颜色
                                            </div>
                                            <div class="inputBox">
                                                <input type="color" v-model="item.borderColor" placeholder="请选择标题栏颜色"  />
                                            </div>
                                        </div>
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label">
                                                验证类型
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio60'+item.id" v-model="item.isVerification" value="0" />
                                                    <label :for="'Radio60'+item.id" ><i class="iconfont icon-ZHicon-"></i></label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio61'+item.id" v-model="item.isVerification" value="1" />
                                                    <label :for="'Radio61'+item.id" ><i class="iconfont icon-shouji"></i></label>
                                                </div>
                                            </div>
                                            <div class="inputicon">
                                                <div class="radioBox">
                                                    <input type="radio" :id="'Radio62'+item.id" v-model="item.isVerification" value="2" />
                                                    <label :for="'Radio62'+item.id" ><i class="iconfont icon-youxiang"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                是否必填
                                            </div>
                                            <div class="inputicon">
                                                <input class="weui-switch" type="checkbox" v-model="item.isFillIn" />
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="item.type==4 || item.type==5">
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                选项名称
                                            </div>
                                            <div class="inputBox" v-for="info in item.data" style="margin: 5px;">
                                                <input type="text" v-model="info.text" placeholder="请输入标题"  /><a :dataid="info.id" :datapid="item.id" v-on:click="delCKInput" style="cursor: pointer;">删除</a>
                                            </div>
                                        </div>
                                        <div class="sub-level1 box_border addSel">
                                            <a :dataid="item.id" v-on:click="addCKInput">+添加选项</a>
                                        </div>
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                边框颜色
                                            </div>
                                            <div class="inputBox">
                                                <input type="color" v-model="item.selColor" placeholder="请选择标题栏颜色"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="item.type==5" style="display:none">
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                最少选择
                                            </div>
                                            <div class="inputBox">
                                                <input type="text" v-model="item.minSel" placeholder="请输入最少选择"  />个
                                            </div>
                                        </div>
                                        <div class="sub-level1 box_border">
                                            <div class="sub-label" >
                                                最多选择
                                            </div>
                                            <div class="inputBox">
                                                <input type="text" v-model="item.maxSel" placeholder="请输入最多选择"  />个
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="msk_add_ad" v-on:click="addInput">
                                <label></label>添加
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $page_row = current($data['items']);
        ?>
        <form method="post" action="<?=url('Page_Base', 'saveTpl')?>" id="dir_form">
            <input type="hidden" name="tpl_id" id="tpl_id" value="<?=$data['tpl_id']?>" />
            <input type="hidden" name="ctid" id="ctid" value="1711" />
            <input type="hidden" name="tpl_label" id="tpl_label" value="美妆" />
            
            <input type="submit" name="Button1" value="Button" id="Button1" style="display: none" />
            <input type="submit" name="Button3" value="Button" id="Button3" style="display: none" />
            <input type="hidden" name="app_id" id="app_id" value="<?=$data['app_id']?>" />
            <input type="hidden" name="page_id" id="page_id" value="<?=$page_row['Id']?>" />
            <input type="hidden" name="store_id" id="store_id" value="5854" />
            <input type="hidden" name="store_name" id="store_name" value="体验店铺" />
            <input type="hidden" name="app_page_list" id="app_page_list" value='<?=encode_json($data['items'])?>' />
           
            <input type="hidden" name="page_code" id="page_code" value='<?=$page_row['PageCode']?>' />
    
            <input type="hidden" name="page_nav" id="page_nav" value='<?=$page_row['PageNav']?>' />
    
            <input type="hidden" name="hidTemplateWarehouseId" id="hidTemplateWarehouseId" value="<?=$data['tpl_id']?>" />
            <input type="hidden" name="tpl_label" id="tpl_label" value="美妆" />
            <input type="hidden" name="page_config" id="page_config" value='<?=$page_row['PageConfig']?>' />


            <input type="hidden" name="app_member_center" id="app_member_center" value='{"Id":6934,"StoreId":5854,"PageCode":"{\"type\":1,\"list\":[{\"id\":1,\"name\":\"我的拼团\",\"isShow\":true,\"color\":\"#DB384C\",\"icon\":\"icon-gouwu\",\"FeatureKey\":\"FightGrp\"},{\"id\":2,\"name\":\"我的金库\",\"isShow\":true,\"color\":\"#44afa4\",\"icon\":\"icon-xiaojinku\",\"FeatureKey\":\"MemCashAcct\"},{\"id\":3,\"name\":\"我的预约\",\"isShow\":true,\"color\":\"#44afa4\",\"icon\":\"icon-shijian\",\"FeatureKey\":\"\"},{\"id\":4,\"name\":\"我的砍价\",\"isShow\":true,\"color\":\"#ffc333\",\"icon\":\"icon-kanjia\",\"FeatureKey\":\"CutPrice\"},{\"id\":5,\"name\":\"优惠券\",\"isShow\":true,\"color\":\"#56ABE4\",\"icon\":\"icon-youhuiquan\",\"FeatureKey\":\"Coupon\"},{\"id\":6,\"name\":\"会员俱乐部\",\"isShow\":false,\"color\":\"#ffc333\",\"icon\":\"icon-zuanshi\",\"FeatureKey\":\"MemGrade\"},{\"id\":7,\"name\":\"商品收藏\",\"isShow\":true,\"color\":\"#56ABE4\",\"icon\":\"icon-liwu\",\"FeatureKey\":\"FavProd\"},{\"id\":8,\"name\":\"收货地址\",\"isShow\":true,\"color\":\"#1BC2A6\",\"icon\":\"icon-shouhuodizhi\",\"FeatureKey\":\"\"},{\"id\":9,\"name\":\"关于商家\",\"isShow\":false,\"color\":\"#DB384C\",\"icon\":\"icon-store\",\"FeatureKey\":\"AbtVendor\"},{\"id\":10,\"name\":\"用户反馈\",\"isShow\":true,\"color\":\"#DB384C\",\"icon\":\"icon-yonghufankui\",\"FeatureKey\":\"\"}]}","IsRelease":true,"TemplateWarehouseId":8,"PageNav":"","PageConfig":"","PageTitle":"个人中心","IsHome":false,"ShareTitle":"","ShareImg":"","PageQRCode":null,"IsPersonalCenter":true}' />
            <input type="hidden" name="app_feature_keyset" id="app_feature_keyset" value='["AbtVendor","ShopTmpl","DiyUI","DiyLnkPage","ProdCat","ProdDetail","ProdVideo","FavProd","ProdCmt","CustServ","CallDirect","ShoppingCart","MulPhyStore","ServResv","SelfTake","PayOnline","Membership","ProdMgr","ProdQrCode","OrderMgr","RecptPnt","OrderDetail","ShipMgr","CityDist","MemCent","MemCentGrid","QrCodeMeal","TakeAway","Newsletter","VideoCnt","TmplMsg","ProdProm","FlashSale","MemDist","PhyStoreDist","FansRank","Coupon","FightGrp","CutPrice","LuckDraw","GoldenEgg","QuickPay","AdvEvent","DynForm","ECashCard","MemGrade","MemGradeDisct","MemPoint","MemTag","MemCashAcct","MemRpt","ProdRpt","OrderRpt","SrcDelgAuth","FreeUpd"]' />

        </form>

</body>
</html>
