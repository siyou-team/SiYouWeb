
<?php
$user_menu_row = array();/*
$user_menu_row[] = array(
    'name' => __('订单中心'),
    'url' => null,
    'sub' => array(
        array(
            'name' => __('我的订单'),
            'ctl' => 'User_Order',
            'met' => 'index',
            'action' => ''
        ),
        array(
            'name' => __('评价晒单'),
            'ctl' => 'User_Order',
            'met' => 'comment',
            'action' => ''
        ),
    )
);

$user_menu_row[] = array(
    'name' => __('关注中心'),
    'url' => null,
    'sub' => array(
        array(
            'name' => __('商品收藏'),
            'ctl' => 'User_Favorites',
            'met' => 'item',
            'action' => '',
        ),
        array(
            'name' => __('店铺收藏'),
            'ctl' => 'User_Favorites',
            'met' => 'store',
            'action' => ''
        ),
        array(
            'name' => __('我的足迹'),
            'ctl' => 'User_Favorites',
            'met' => 'browser',
            'action' => ''
        )
    )
);*/

$user_menu_row[] = array(
    'name' => __('个人中心'),
    'url' => null,
    'sub' => array(
        array(
            'name' => __('账户信息'),
            'ctl' => 'User_Account',
            'met' => 'index',
            'app' => 'account',
            'mdu' => null,
            'action' => ''
        ),
        array(
            'name' => __('帐号安全'),
            'ctl' => 'User_Security',
            'met' => 'index',
            'app' => 'account',
            'mdu' => null,
            'action' => ''
        ),
/*
        array(
            'name' => __('绑定授权'),
            'ctl' => 'User_Connect',
            'met' => 'index',
            'app' => 'account',
            'mdu' => null,
            'action' => ''
        ),*/
        array(
            'name' => __('收货地址'),
            'ctl' => 'User_DeliveryAddress',
            'met' => 'lists',
            'action' => ''
        )
    )
);

/*
$user_menu_row[] = array(
    'name' => __('客户服务'),
    'url' => null,
    'sub' => array(
        array(
            'name' => __('退款退货'),
            'ctl' => 'User_Order',
            'met' => 'index',
            'action' => 'item'
        ),
        array(
            'name' => __('商品咨询'),
            'ctl' => '',
            'met' => 'lists',
            'action' => ''
        )
    )
);*/

//通过代理读取或者页面跳转。 目前采用wap方式，html+ajax读取显示。
$user_menu_row[] = array(
    'name' => __('账户中心'),
    'url' => null,
    'sub' => array(
        array(
            'name' => __('交易查询'),
            'ctl' => 'Index',
            'met' => 'consumeTrade',
            'app' => 'account',
            'mdu' => 'pay',
            'action' => '',
        ),
        array(
            'name' => __('账户余额'),
            'ctl' => 'Index',
            'met' => 'resourceIndex',
            'app' => 'account',
            'mdu' => 'pay',
            'action' => '',
        ),
        array(
            'name' => __('我的优惠券'),
            'ctl' => 'User_Voucher',
            'met' => 'lists',
            'action' => ''
        ),
        array(
            'name' => __('我的充值卡'),
            'ctl' => 'Card',
            'met' => 'cardHistory',
            'app' => 'account',
            'mdu' => 'pay',
            'action' => ''
        ),
        array(
            'name' => __('我的红包'),
            'ctl' => 'Redpacket',
            'met' => 'index',
            'app' => 'account',
            'mdu' => 'pay',
            'action' => ''
        ),
        array(
            'name' => __('我的积分'),
            'ctl' => 'User_Resource',
            'met' => 'pointsHistory',
            'action' => ''
        ),
        array(
            'name' => __('信用支付-白条'),
            'ctl' => 'Credit',
            'met' => 'index',
            'app' => 'account',
            'mdu' => 'pay',
            'action' => ''
        )
    )
);

?>
<!-- Left colunm -->
<div class="column col-xs-12 col-sm-3" id="left_column">
    <!-- block filter -->
    <div class="uc-box uc-sub-box">
        <?php foreach ($user_menu_row as $item):?>
            <div class="uc-nav-box">
                <div class="box-hd">
                    <h3 class="title"><?=$item['name']?></h3>
                </div>
                <div class="box-bd">
                    <ul class="uc-nav-list">
                        <?php foreach ($item['sub'] as $menu):?>
                            <?php
                            $host = null;
                            if (isset($menu['app']) && 'account'==$menu['app'])
                            {
                                $host = Zero_Registry::get('base_url') . '/account.php';
                                
                                if ('account.php' == Zero_Registry::get('index_page'))
                                {
                                    $host = null;
                                }
                            }
                            else
                            {
                                $host = Zero_Registry::get('base_url') . '/index.php';
    
                                if ('index.php' == Zero_Registry::get('index_page'))
                                {
                                    $host = null;
                                }
                            }
                            
                            
                            ?>
                            <li <?php if ($menu['ctl']==s('ctl') && $menu['met']==s('met')  && $menu['action']==s('action')){ echo 'class="active"';} ?>><a href="<?=url($menu['ctl'], $menu['met'], isset($menu['mdu']) ? $menu['mdu'] : null, sprintf('action=%s', $menu['action'], @$menu['app']), array(), 'default', 'e', $host, true)?>" <?=( $host ? '' : 'data-pjax="#page-container"')?> ><?=$menu['name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <!-- ./block filter  -->

</div>
<!-- ./left colunm -->