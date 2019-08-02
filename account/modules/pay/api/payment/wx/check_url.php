<?php
/* *
    同步返回。
 */
$_REQUEST['mdu'] = 'pay';
require_once '../../../../../../shop/configs/config.ini.php';

Zero_Log::log("r=" . json_encode($_REQUEST), 'pay_wx_return', Zero_Log::INFO);
Zero_Log::log("g=" . json_encode($_GET), 'pay_wx_return', Zero_Log::INFO);
Zero_Log::log("p=" . json_encode($_POST), 'pay_wx_return', Zero_Log::INFO);

$order_id = $_REQUEST['order_id'];
$return_row = array();

//基于安全考虑，检测支付模式及数据
//判断是门店 店铺 平台
if (Base_ConfigModel::getTradeModePlantform())
{
    $payment_store_id        = 0;
    $payment_chain_id        = 0;
}
else
{
    //不可以联合支付。
    $out_trade_no = s('order_id');
    $trade_row_tmp = Consume_TradeModel::getInstance()->findOne(array('order_id'=>$out_trade_no));
    
    //固定死， 是门店收银还是店铺收银。， 统一店铺收银
    if (true)
    {
        $payment_store_id        = $trade_row_tmp['store_id'];
        $payment_chain_id        = 0;
    }
    else
    {
        $payment_store_id        = 0;
        $payment_chain_id        = $trade_row_tmp['chain_id'];;
    }
}

$Payment_WxNativeModel = PaymentModel::create('wx_native', $payment_store_id, $payment_chain_id);
$verify_result          = $Payment_WxNativeModel->verifyReturn($order_id, null, $return_row);


//
if (Zero_Utils_Device::isMobile())
{
    $jump_url = sprintf('%s/tmpl/member/order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
}
else
{
    
    $jump_url = url('User_Order', 'detail', '', '', array('order_id'=>$order_id));
}

header('Content-Type: application/json; charset=utf-8');

//计算得出通知验证结果
if($verify_result)
{
    //交易目前所处的状态。成功状态的值只有两个：
    //TRADE_FINISHED（普通即时到账的交易成功状态）；
    //TRADE_SUCCESS（开通了高级即时到账或机票分销产品后的交易成功状态）
    //判断该笔订单是否在商户网站中已经做过处理
    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
    //如果有做过处理，不执行商户的业务程序
    $Consume_TradeModel = new Consume_TradeModel();
    $notify_row = $Payment_WxNativeModel->getReturnData($Consume_TradeModel);
    
    
    $Consume_DepositModel = new Consume_DepositModel();
    //开启事务
    $Consume_DepositModel->sql->startTransactionDb();
    
    $notify_row['store_id']               = $payment_store_id                   ; // 所属店铺
    $notify_row['chain_id']               = $payment_chain_id                   ; // 所属门店
    $notify_row['payment_channel_id']     = $Payment_WxNativeModel->getChannelId();
    
    $rs = $Consume_DepositModel->processDeposit($notify_row);
    
    if ($rs && $Consume_DepositModel->sql->commitDb())
    {
        //处理一步回调-通知商城更新订单状态
        $Consume_DepositModel->notifyShop($notify_row);
        
        //echo "success";        //请不要修改或删除
        $data['status'] = 200;
        
    }
    else
    {
        $Consume_DepositModel->sql->rollBackDb();

        $data['status'] = 250;
        Zero_Log::log('数据处理 失败 $order_id : ' . $order_id, 'pay_wx_return', Zero_Log::ERROR);
        
    }
}
else
{
    $data['status'] = 250;
    Zero_Log::log('trade_status 失败 $order_id:' . $order_id, 'pay_wx_return_error', Zero_Log::ERROR);
}

echo json_encode($data);
