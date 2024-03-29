<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>

<script src="<?=$this->js('devexpress-web-14.1/js/globalize.min', true)?>"></script>
<script src="<?=$this->js('devexpress-web-14.1/js/dx.chartjs', true)?>"></script>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?=$this->font('linecons/css/linecons', true)?>">
<link rel="stylesheet" href="<?=$this->font('meteocons/css/meteocons', true)?>">

<div class="container">
    <div class="main-content" id="dashboard">


        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="0" data-to="<?= $data['order']['day_num'] ? round(100 * ($data['order']['day_fin_num'] / $data['order']['day_num']), 2) : '--' ?>" data-suffix="%" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-attach"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.0%</strong>
                        <span>今日订单完成率</span>
                    </div>
                    <!--<div class="xe-lower">
                        <div class="border"></div>
                        <span></span>
                        <strong></strong>
                    </div>-->
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="xe-widget  xe-counter xe-counter-block-blue" data-count=".num" data-from="0" data-to="<?=$data['order']['total_num'] ?  round(100 * ($data['order']['fin_num'] / $data['order']['total_num']), 2) : '--' ?>" data-suffix="%" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-cloud"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.0%</strong>
                        <span>订单完成率</span>
                    </div>
                    <!--<div class="xe-lower">
                        <div class="border"></div>
                        <span>Result</span>
                        <strong>78% Increase</strong>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="row">
            <!-- 商品 -->
            <div class="col-sm-4">
                <div class="xe-widget xe-conversations">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="xe-label">
                            <h3>
                                <a tabid="GS" tabtxt="商品列表" rel="pageTab" href="<?=url('Product_Base', 'index', 'seller')?>">
                                    <span>店铺及商品提示</span>
                                </a>
                                <small></small>
                            </h3>
                        </div>
                    </div>

                    <div class="xe-body ps-container" style="height: 460px; overflow: hidden">
                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="店铺设置" href="<?=url('Store_Base', 'index', 'seller')?>" class="xe-user-name">店铺状态 ： <?= $data['store_info']['store_state_id']!=3240 ? StateCode::getText($data['store_info']['store_state_id']) : ($data['store_info']['store_is_open'] ? '营业中' : '关闭中')?> </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">商品总数 ： <?= $data['product']['total_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">已审核商品 ： <?= $data['product']['verify_passed_off_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">未通过审核 ： <?= $data['product']['verify_refused_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">等待审核 ： <?= $data['product']['verify_waiting_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">已下架 ： <?= $data['product']['off_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">售卖中 ： <?= $data['product']['normal_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="GS" tabtxt="商品列表" href="<?=url('Product_Base', 'index', 'seller')?>" class="xe-user-name">违禁 ： <?= $data['product']['illegal_num']?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>


            <!-- 订单 -->
            <div class="col-sm-4">

                <div class="xe-widget xe-conversations">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="linecons-comment"></i>
                        </div>
                        <div class="xe-label">
                            <h3>
                                <a tabid="DD" tabtxt="订单" rel="pageTab" href="<?=url('Order_Base', 'index', 'seller')?>">
                                    <span>订单</span>
                                </a>
                                <small></small>
                            </h3>
                        </div>
                    </div>

                    <div class="xe-body ps-container" style="height: 460px; overflow: hidden">
                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">今日订单总数 ： <?= $data['order']['day_num']?></a>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">总订单数 ： <?= $data['order']['total_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">已完成 ： <?= $data['order']['fin_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">已发货 ： <?= $data['order']['ship_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">等待付款 ： <?= $data['order']['wait_pay_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="订单" href="<?=url('Order_Base', 'index', 'seller')?>"  class="xe-user-name">待评价 ： <?= $data['order']['eva_num']?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>

            <!-- 退单 -->
            <div class="col-sm-4">

                <div class="xe-widget xe-conversations">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="linecons-comment"></i>
                        </div>
                        <div class="xe-label">
                            <h3>
                                <a tabid="TD" tabtxt="退单" rel="pageTab" href="<?=url('Order_Return', 'index', 'seller')?>">
                                    <span>退单</span>
                                </a>
                                <small></small>
                            </h3>
                        </div>
                    </div>

                    <div class="xe-body ps-container" style="height: 460px; overflow: hidden">
                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="退单" href="<?=url('Order_Return', 'index', 'seller')?>"  class="xe-user-name">退单总数 ： <?= $data['return']['total_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="退单" href="<?=url('Order_Return', 'index', 'seller')?>"  class="xe-user-name">已完成 ： <?= $data['return']['fin_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="退单" href="<?=url('Order_Return', 'index', 'seller')?>"  class="xe-user-name">待审核 ： <?= $data['return']['review_num']?></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <div class="xe-comment">
                                        <a tabid="DD" tabtxt="退单" href="<?=url('Order_Return', 'index', 'seller')?>"  class="xe-user-name" data-toggle="不包含未审核">未完成 ： <?= $data['return']['un_fin_num']?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <!-- 订单销售趋势图 -->
            <div class="col-sm-12">

                <div class="xe-widget xe-conversations">
                    <div class="panel-heading">
                        <h3 class="panel-title">订单销售趋势图</h3>
                        <div class="panel-options">

                            <!--<a href="#" data-toggle="panel">
                                <span class="collapse-icon">&ndash;</span>
                                <span class="expand-icon">+</span>
                            </a>
                            <a href="#" data-toggle="remove">
                                &times;
                            </a>-->
                        </div>
                        <div class="btn-group  pull-right">
                            <div class="btn btn-primary orderTimeLine" data-days="7">7天</div>
                            <div class="btn btn-primary orderTimeLine" data-days="30">30天</div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="order-time-line" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <!-- 退单统计趋势图 -->
            <div class="col-sm-12">

                <div class="xe-widget xe-conversations">
                    <div class="panel-heading">
                        <h3 class="panel-title">退单统计趋势图</h3>
                        <div class="panel-options">

                        </div>
                        <div class="btn-group  pull-right">
                            <div class="btn btn-primary returnTimeLine" data-days="7">7天</div>
                            <div class="btn btn-primary returnTimeLine" data-days="30">30天</div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="return-time-line" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <!-- 订单销售金额对比图 -->
            <div class="col-sm-6">
                <div class="xe-widget xe-conversations">
                    <div class="panel-heading">
                        <h3 class="panel-title">订单销售金额对比图</h3>
                        <div class="panel-options">
                        </div>
                        <div class="btn-group  pull-right">
                            <div class="btn btn-primary paymentTimeLine" data-days="7">7天</div>
                            <div class="btn btn-primary paymentTimeLine" data-days="30">30天</div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="order-money-time-line" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>

            </div>
            <!-- 购买商品顾客统计 -->
            <div class="col-sm-6">

                <div class="xe-widget xe-conversations">
                    <div class="panel-heading">
                        <h3 class="panel-title">购买商品顾客统计</h3>
                        <div class="panel-options">
                        </div>
                        <div class="btn-group  pull-right">
                            <div class="btn btn-primary customerTimeLine" data-days="7">7天</div>
                            <div class="btn btn-primary customerTimeLine" data-days="30">30天</div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="customer-time-line" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">

            <div class="col-sm-6">

                <div class="xe-widget xe-conversations">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="linecons-comment"></i>
                        </div>
                        <div class="xe-label">
                            <h3>
                                系统提醒
                                <small>Chatting arround</small>
                            </h3>
                        </div>
                    </div>
                    <div class="xe-body  ps-container" id="sys_notice" style="height: 336px; overflow: hidden">
                        <ul class="list-unstyled">
                            <?php foreach($data['notice'] as $item):?>
                                <li>
                                    <div class="xe-comment-entry">
                                        <a href="#" class="xe-user-img">
                                            <img src="<?=$item['user_avatar']?>" class="img-circle" width="40" />
                                        </a>

                                        <div class="xe-comment">
                                            <a href="#" class="xe-user-name">
                                                <strong><?=$item['user_nickname']?></strong>
                                            </a>

                                            <p><?=$item['message_content']?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>

            </div>

            <!--<div class="col-sm-3">

                <div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
                    <div class="xe-icon">
                        <i class="linecons-cloud"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">0.0%</strong>
                        <span>Server uptime</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" data-count=".num" data-from="1" data-to="117" data-suffix="k" data-duration="3" data-easing="false">
                    <div class="xe-icon">
                        <i class="linecons-user"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">1k</strong>
                        <span>Users Total</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="1000" data-to="2470" data-duration="4" data-easing="true">
                    <div class="xe-icon">
                        <i class="linecons-camera"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">1000</strong>
                        <span>New Daily Photos</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-red" data-count=".num" data-from="0" data-to="57" data-prefix="-," data-suffix="%" data-duration="5" data-easing="true" data-delay="1">
                    <div class="xe-icon">
                        <i class="linecons-lightbulb"></i>
                    </div>
                    <div class="xe-label">
                        <strong class="num">-,0%</strong>
                        <span>Exchange Commission</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="linecons-cloud"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">0.0%</strong>
                            <span>Server uptime</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Result</span>
                        <strong>78% Increase</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-purple" data-count=".num" data-from="0" data-to="512" data-duration="3">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="linecons-camera"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">0</strong>
                            <span>Photos Taken</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Increase</span>
                        <strong>512 more photos</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-blue" data-suffix="k" data-count=".num" data-from="0" data-to="310" data-duration="4" data-easing="false">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">0k</strong>
                            <span>Daily Visits</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Bounce Rate</span>
                        <strong>51.55%</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-orange">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="fa-life-ring"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">24/7</strong>
                            <span>Live Support</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Tickets Opened</span>
                        <strong data-count="this" data-from="0" data-to="14215" data-duration="2">0</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-progress-counter xe-progress-counter-pink" data-count=".num" data-from="0" data-to="12425" data-duration="2">

                    <div class="xe-background">
                        <i class="linecons-heart"></i>
                    </div>

                    <div class="xe-upper">
                        <div class="xe-icon">
                            <i class="linecons-heart"></i>
                        </div>
                        <div class="xe-label">
                            <span>likes</span>
                            <strong class="num">0</strong>
                        </div>
                    </div>

                    <div class="xe-progress">
                        <span class="xe-progress-fill" data-fill-from="0" data-fill-to="56" data-fill-unit="%" data-fill-property="width" data-fill-duration="2" data-fill-easing="true"></span>
                    </div>

                    <div class="xe-lower">
                        <span>Likes p/ Month</span>
                        <strong>41% more likes</strong>
                    </div>

                </div>


                <div class="xe-widget xe-todo-list">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="fa-file-text-o"></i>
                        </div>
                        <div class="xe-label">
                            <span>to do list</span>
                            <strong>Tasks</strong>
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <li class="done">
                                <label>
                                    <input type="checkbox" class="cbr" checked />
                                    <span>Web Design</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cbr" />
                                    <span>Slicing</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cbr" />
                                    <span>WooCommerce</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cbr" />
                                    <span>Programming</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cbr" />
                                    <span>SEO Optimize</span>
                                </label>
                            </li>
                        </ul>

                    </div>
                    <div class="xe-footer">
                        <input type="text" class="form-control" placeholder="Add task..." />
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-progress-counter xe-progress-counter-turquoise" data-count=".num" data-from="0" data-to="520" data-suffix="k" data-duration="3">

                    <div class="xe-background">
                        <i class="linecons-paper-plane"></i>
                    </div>

                    <div class="xe-upper">
                        <div class="xe-icon">
                            <i class="linecons-paper-plane"></i>
                        </div>
                        <div class="xe-label">
                            <span>chat lines</span>
                            <strong class="num">0</strong>
                        </div>
                    </div>

                    <div class="xe-progress">
                        <span class="xe-progress-fill" data-fill-from="0" data-fill-to="82" data-fill-unit="%" data-fill-property="width" data-fill-duration="3" data-fill-easing="true"></span>
                    </div>

                    <div class="xe-lower">
                        <span>Chat lines p/ Month</span>
                        <strong>82% more communication</strong>
                    </div>

                </div>

                <div class="xe-widget xe-status-update" data-auto-switch="5">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="fa-twitter"></i>
                        </div>
                        <div class="xe-nav">
                            <a href="#" class="xe-prev">
                                <i class="fa-angle-left"></i>
                            </a>
                            <a href="#" class="xe-next">
                                <i class="fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <li class="active">
                                <span class="status-date">21 May</span>
                                <p>Build your own Fake Twitter Post now! Check it out @ simitator.com #laborator #envato</p>
                            </li>
                            <li>
                                <span class="status-date">18 April</span>
                                <p> Micro-finance clean water sustainable future Oxfam protect. Enabler meaningful work change-makers.</p>
                            </li>
                            <li>
                                <span class="status-date">08 March</span>
                                <p>Fight against malnutrition Aga Khan Bloomberg, economic independence inspire breakthroughs benefit civil.</p>
                            </li>
                        </ul>

                    </div>
                    <div class="xe-footer">
                        <a href="#">
                            <i class="fa-retweet"></i>
                            Retweet
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-vertical-counter xe-vertical-counter-primary" data-count=".num" data-from="0" data-to="128.4" data-decimal="," data-suffix="%" data-duration="2.5">
                    <div class="xe-icon">
                        <i class="linecons-videocam"></i>
                    </div>

                    <div class="xe-label">
                        <strong class="num">0,0%</strong>
                        <span>Video Views</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-vertical-counter xe-vertical-counter-danger" data-count=".num" data-from="0" data-to="67.9" data-decimal="," data-suffix="%" data-duration="3">
                    <div class="xe-icon">
                        <i class="linecons-doc"></i>
                    </div>

                    <div class="xe-label">
                        <strong class="num">0,0%</strong>
                        <span>Document Downloads</span>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-red" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="linecons-beaker"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">0.0%</strong>
                            <span>Server uptime</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Result</span>
                        <strong>78% Increase</strong>
                    </div>
                </div>

            </div>

            <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-yellow" data-count=".num" data-from="0" data-to="512" data-duration="3">
                    <div class="xe-upper">

                        <div class="xe-icon">
                            <i class="linecons-attach"></i>
                        </div>
                        <div class="xe-label">
                            <strong class="num">0</strong>
                            <span>Photos Taken</span>
                        </div>

                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <span>Increase</span>
                        <strong>512 more photos</strong>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="col-sm-8">

                <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        var map = $("#sample-map-widget");

                        var gdpData = { "AF": 16.63, "AL": 11.58, "DZ": 158.97, "AO": 85.81, "AG": 1.1, "AR": 351.02, "AM": 8.83, "AU": 1219.72, "AT": 366.26, "AZ": 52.17, "BS": 7.54, "BH": 21.73, "BD": 105.4, "BB": 3.96, "BY": 52.89, "BE": 461.33, "BZ": 1.43, "BJ": 6.49, "BT": 1.4, "BO": 19.18, "BA": 16.2, "BW": 12.5, "BR": 2023.53, "BN": 11.96, "BG": 44.84, "BF": 8.67, "BI": 1.47, "KH": 11.36, "CM": 21.88, "CA": 1563.66, "CV": 1.57, "CF": 2.11, "TD": 7.59, "CL": 199.18, "CN": 5745.13, "CO": 283.11, "KM": 0.56, "CD": 12.6, "CG": 11.88, "CR": 35.02, "CI": 22.38, "HR": 59.92, "CY": 22.75, "CZ": 195.23, "DK": 304.56, "DJ": 1.14, "DM": 0.38, "DO": 50.87, "EC": 61.49, "EG": 216.83, "SV": 21.8, "GQ": 14.55, "ER": 2.25, "EE": 19.22, "ET": 30.94, "FJ": 3.15, "FI": 231.98, "FR": 2555.44, "GA": 12.56, "GM": 1.04, "GE": 11.23, "DE": 3305.9, "GH": 18.06, "GR": 305.01, "GD": 0.65, "GT": 40.77, "GN": 4.34, "GW": 0.83, "GY": 2.2, "HT": 6.5, "HN": 15.34, "HK": 226.49, "HU": 132.28, "IS": 12.77, "IN": 1430.02, "ID": 695.06, "IR": 337.9, "IQ": 84.14, "IE": 204.14, "IL": 201.25, "IT": 2036.69, "JM": 13.74, "JP": 5390.9, "JO": 27.13, "KZ": 129.76, "KE": 32.42, "KI": 0.15, "KR": 986.26, "UNDEFINED": 5.73, "KW": 117.32, "KG": 4.44, "LA": 6.34, "LV": 23.39, "LB": 39.15, "LS": 1.8, "LR": 0.98, "LY": 77.91, "LT": 35.73, "LU": 52.43, "MK": 9.58, "MG": 8.33, "MW": 5.04, "MY": 218.95, "MV": 1.43, "ML": 9.08, "MT": 7.8, "MR": 3.49, "MU": 9.43, "MX": 1004.04, "MD": 5.36, "MN": 5.81, "ME": 3.88, "MA": 91.7, "MZ": 10.21, "MM": 35.65, "NA": 11.45, "NP": 15.11, "NL": 770.31, "NZ": 138, "NI": 6.38, "NE": 5.6, "NG": 206.66, "NO": 413.51, "OM": 53.78, "PK": 174.79, "PA": 27.2, "PG": 8.81, "PY": 17.17, "PE": 153.55, "PH": 189.06, "PL": 438.88, "PT": 223.7, "QA": 126.52, "RO": 158.39, "RU": 1476.91, "RW": 5.69, "WS": 0.55, "ST": 0.19, "SA": 434.44, "SN": 12.66, "RS": 38.92, "SC": 0.92, "SL": 1.9, "SG": 217.38, "SK": 86.26, "SI": 46.44, "SB": 0.67, "ZA": 354.41, "ES": 1374.78, "LK": 48.24, "KN": 0.56, "LC": 1, "VC": 0.58, "SD": 65.93, "SR": 3.3, "SZ": 3.17, "SE": 444.59, "CH": 522.44, "SY": 59.63, "TW": 426.98, "TJ": 5.58, "TZ": 22.43, "TH": 312.61, "TL": 0.62, "TG": 3.07, "TO": 0.3, "TT": 21.2, "TN": 43.86, "TR": 729.05, "TM": 0, "UG": 17.12, "UA": 136.56, "AE": 239.65, "GB": 2258.57, "US": 14624.18, "UY": 40.71, "UZ": 37.72, "VU": 0.72, "VE": 285.21, "VN": 101.99, "YE": 30.02, "ZM": 15.69, "ZW": 5.57 };

                        var vmap = map.vectorMap({
                            map: 'world_mill_en',
                            backgroundColor: '',
                            regionStyle: {
                                initial: {
                                    "fill": '#fff',
                                    "fill-opacity": 0.2,
                                    "stroke": '',
                                    "stroke-width": .7,
                                    "stroke-opacity": .5
                                },
                                hover: {
                                    "fill-opacity": 1,
                                    "fill": "#ddd"
                                }
                            },
                            markerStyle: {
                                initial: {
                                    fill: '#fff',
                                    "stroke": "#fff",
                                    "stroke-width": 0,
                                    r: 2.5
                                },
                                selected: {
                                    fill: '#7c38bc',
                                    "stroke-width": 0
                                }
                            },
                            markers: [
                                {latLng: [42.58, 20.88], name: 'Kosovo'},
                                {latLng: [40.71, -74.00], name: 'New York'},
                                {latLng: [36.77, -119.41], name: 'California'},
                                {latLng: [-22.90, -43.19], name: 'Rio De Janiero'},
                                {latLng: [35.68, 139.69], name: 'Tokyo'},
                                {latLng: [59.32, 18.06], name: 'Stockholm'},
                                {latLng: [25.04, 55.18], name: 'Dubai'},
                                {latLng: [51.50, -0.12], name: 'London'},
                                {latLng: [-33.92, 18.42], name: 'Cape Town'},
                            ]
                        });

                    });
                </script>
                <div class="xe-widget xe-map-stats">
                    <div class="xe-map">
                        <div id="sample-map-widget"></div>
                    </div>
                    <div class="xe-details">
                        <div class="xe-label">
                            <h3>Top Destinations</h3>
                            <p>3 month period</p>
                        </div>

                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-map-data">
                                    <span class="label label-secondary">5k</span>
                                    <span class="xe-label">Los Angeles</span>
                                </div>
                            </li>
                            <li>
                                <div class="xe-map-data">
                                    <span class="label label-purple">2k</span>
                                    <span class="xe-label">Barcelona</span>
                                </div>
                            </li>
                            <li>
                                <div class="xe-map-data">
                                    <span class="label label-yellow">311</span>
                                    <span class="xe-label">Helsinki</span>
                                </div>
                            </li>
                            <li>
                                <div class="xe-map-data">
                                    <span class="label label-red">892</span>
                                    <span class="xe-label">Sao Paolo</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-sm-4">

                <div class="xe-widget xe-status-update xe-status-update-facebook" data-auto-switch="3">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="fa-facebook"></i>
                        </div>
                        <div class="xe-nav">
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <li>
                                <span class="status-date">21 May</span>
                                <p>Build your own Fake Twitter Post now! Check it out @ simitator.com #laborator #envato</p>
                            </li>
                            <li class="active">
                                <span class="status-date">18 April</span>
                                <p> Micro-finance clean water sustainable future Oxfam protect. Enabler meaningful work change-makers.</p>
                            </li>
                            <li>
                                <span class="status-date">08 March</span>
                                <p>Fight against malnutrition Aga Khan Bloomberg, economic independence inspire breakthroughs benefit civil.</p>
                            </li>
                        </ul>

                    </div>
                    <div class="xe-footer">
                        <a href="#">
                            <i class="linecons-megaphone"></i>
                            Share This
                        </a>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4">

                <div class="xe-widget xe-status-update xe-status-update-google-plus" data-auto-switch="0">
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="fa-google-plus"></i>
                        </div>
                        <div class="xe-nav">
                            <a href="#" class="xe-prev">
                                <i class="fa-angle-left"></i>
                            </a>
                            <a href="#" class="xe-next">
                                <i class="fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <li class="active">
                                <span class="status-date">21 May</span>
                                <p>Build your own Fake Twitter Post now! Check it out @ simitator.com #laborator #envato</p>
                            </li>
                            <li>
                                <span class="status-date">18 April</span>
                                <p> Micro-finance clean water sustainable future Oxfam protect. Enabler meaningful work change-makers.</p>
                            </li>
                            <li>
                                <span class="status-date">08 March</span>
                                <p>Fight against malnutrition Aga Khan Bloomberg, economic independence inspire breakthroughs benefit civil.</p>
                            </li>
                        </ul>

                    </div>
                    <div class="xe-footer">
                        <a href="#">
                            <i class="linecons-thumbs-up"></i>
                            +1 this post
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-sm-8">

                <div class="xe-widget xe-weather">
                    <div class="xe-background xe-background-animated">
                        <img src="<?/*=$this->img('')*/?>clouds.png" />
                    </div>

                    <div class="xe-current-day">
                        <div class="xe-now">
                            <div class="xe-temperature">
                                <div class="xe-icon">
                                    <i class="meteocons-cloud-moon"></i>
                                </div>
                                <div class="xe-label">
                                    Now
                                    <strong>21&deg;</strong>
                                </div>
                            </div>
                            <div class="xe-location">
                                <h4>San Francisco, USA</h4>
                                <time>Today, 03 October</time>
                            </div>
                        </div>

                        <div class="xe-forecast">
                            <ul>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>11:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-sunrise"></i>
                                        </div>
                                        <strong class="xe-temp">12&deg;</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>12:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-clouds-flash"></i>
                                        </div>
                                        <strong class="xe-temp">13&deg;</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>13:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-cloud-moon-inv"></i>
                                        </div>
                                        <strong class="xe-temp">16&deg;</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>14:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-eclipse"></i>
                                        </div>
                                        <strong class="xe-temp">19&deg;</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>15:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-rain"></i>
                                        </div>
                                        <strong class="xe-temp">21&deg;</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="xe-forecast-entry">
                                        <time>16:00</time>
                                        <div class="xe-icon">
                                            <i class="meteocons-cloud-sun"></i>
                                        </div>
                                        <strong class="xe-temp">25&deg;</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="xe-weekdays">
                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-weekday-forecast">
                                    <div class="xe-temp">21&deg;</div>
                                    <div class="xe-day">Monday</div>
                                    <div class="xe-icon">
                                        <i class="meteocons-windy-inv"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-weekday-forecast">
                                    <div class="xe-temp">23&deg;</div>
                                    <div class="xe-day">Tuesday</div>
                                    <div class="xe-icon">
                                        <i class="meteocons-sun"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-weekday-forecast">
                                    <div class="xe-temp">19&deg;</div>
                                    <div class="xe-day">Wednesday</div>
                                    <div class="xe-icon">
                                        <i class="meteocons-na"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-weekday-forecast">
                                    <div class="xe-temp">18&deg;</div>
                                    <div class="xe-day">Thursday</div>
                                    <div class="xe-icon">
                                        <i class="meteocons-windy"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-weekday-forecast">
                                    <div class="xe-temp">20&deg;</div>
                                    <div class="xe-day">Friday</div>
                                    <div class="xe-icon">
                                        <i class="meteocons-sun"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="col-sm-12">

                <div class="xe-widget xe-conversations">
                    <div class="xe-bg-icon">
                        <i class="linecons-comment"></i>
                    </div>
                    <div class="xe-header">
                        <div class="xe-icon">
                            <i class="linecons-comment"></i>
                        </div>
                        <div class="xe-label">
                            <h3>
                                Conversations
                                <small>Chatting arround</small>
                            </h3>
                        </div>
                    </div>
                    <div class="xe-body">

                        <ul class="list-unstyled">
                            <li>
                                <div class="xe-comment-entry">
                                    <a href="#" class="xe-user-img">
                                        <img src="<?/*=$this->img('user-2.png')*/?>" class="img-circle" width="40" />
                                    </a>

                                    <div class="xe-comment">
                                        <a href="#" class="xe-user-name">
                                            <strong>Jack Gates</strong>
                                        </a>

                                        <p>In it except to so temper mutual tastes mother. Interested cultivated its continuing now yet are. <br />Out interested acceptance our partiality affronting unpleasant why add. Esteem garden me...</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <a href="#" class="xe-user-img">
                                        <img src="<?/*=$this->img('')*/?>user-5.png" class="img-circle" width="40" />
                                    </a>

                                    <div class="xe-comment">
                                        <a href="#" class="xe-user-name">
                                            <strong>Arlind Nushi</strong>
                                            <span class="label label-secondary">5</span>
                                        </a>

                                        <p>Age sold some full like rich new. Amounted repeated as believed in confined juvenile.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="xe-comment-entry">
                                    <a href="#" class="xe-user-img">
                                        <img src="<?/*=$this->img('user-4.png')*/?>" class="img-circle" width="40" />
                                    </a>

                                    <div class="xe-comment">
                                        <a href="#" class="xe-user-name">
                                            <strong>Bryan Green</strong>
                                        </a>

                                        <p>Stuff sight equal of my woody. Him children bringing goodness suitable she entirely put far daughter.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="xe-footer">
                        <a href="#">View All</a>
                    </div>
                </div>

            </div>-->

        </div>
    </div>

</div>


<!-- Imported scripts on this page -->
<script src="<?=$this->js('plugins/jvectormap/jquery-jvectormap-1.2.2.min', true)?>"></script>
<script src="<?=$this->js('plugins/jvectormap/regions/jquery-jvectormap-world-mill-en', true)?>"></script>
<script src="<?=$this->js('qianyi-widgets')?>"></script>
<script src="<?=$this->js('controllers/dashboard')?>"></script>


