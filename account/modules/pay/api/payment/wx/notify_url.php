<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */
$_REQUEST['mdu'] = 'pay';
require_once '../../../../../../shop/configs/config.ini.php';

Zero_Log::log("r=" . json_encode($_REQUEST), 'pay_wxnative_notify', Zero_Log::INFO);
Zero_Log::log("p=" . json_encode($_POST), 'pay_wxnative_notify', Zero_Log::INFO);

$xml = $GLOBALS['HTTP_RAW_POST_DATA'];

//将XML转为array
//禁止引用外部xml实体
libxml_disable_entity_loader(true);
$values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

Zero_Log::log("pp=" . json_encode($values), 'pay_wxnative_notify', Zero_Log::INFO);

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
    $out_trade_no = $values['out_trade_no'];
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
$verify_result          = $Payment_WxNativeModel->verifyNotify();

Zero_Log::log('$verify_result=' . $verify_result, 'pay_wxnative_notify', Zero_Log::INFO);

//计算得出通知验证结果
if ($verify_result)
{
    try
    {
        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        $notify_row = $Payment_WxNativeModel->getNotifyData();
    
        if ($notify_row)
        {
            //插入充值记录
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
            
                echo "SUCCESS";        //请不要修改或删除
                Zero_Log::log('Process-SUCCESS', 'pay_wxnative_notify', Zero_Log::INFO);
            }
            else
            {
                $Consume_DepositModel->sql->rollBackDb();
            
                echo "FAIL";
                Zero_Log::log('Process-FAIL', 'pay_wxnative_notify_error', Zero_Log::ERROR);
                Zero_Log::log('Process-FAIL', 'pay_wxnative_notify', Zero_Log::ERROR);
            }
        }
        else
        {
            echo "FAIL";
            Zero_Log::log('Process-FAIL', 'pay_wxnative_notify_error', Zero_Log::ERROR);
            Zero_Log::log('Process-FAIL', 'pay_wxnative_notify', Zero_Log::ERROR);
        }
    
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    catch (Exception $e)
    {
        Zero_Log::log($e->getMessage(), 'pay_wxnative_notify_error', Zero_Log::ERROR);
    }
}
else
{
	//验证失败
	echo "FAIL";
	Zero_Log::log($error_msg, 'pay_wxnative_notify_error', Zero_Log::ERROR);
	Zero_Log::log($error_msg, 'pay_wxnative_notify', Zero_Log::ERROR);

}
?>