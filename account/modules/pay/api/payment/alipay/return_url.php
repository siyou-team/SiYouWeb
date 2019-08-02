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

Zero_Log::log("r=" . json_encode($_REQUEST), 'pay_alipay_return', Zero_Log::INFO);
Zero_Log::log("g=" . json_encode($_GET), 'pay_alipay_return', Zero_Log::INFO);
Zero_Log::log("p=" . json_encode($_POST), 'pay_alipay_return', Zero_Log::INFO);

$order_id = $_REQUEST['out_trade_no'];


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
    $out_trade_no = s('out_trade_no');
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

$Payment_AlipayWapModel = PaymentModel::create('alipay', $payment_store_id, $payment_chain_id);
$verify_result          = $Payment_AlipayWapModel->verifyReturn();

Zero_Log::log('$verify_result=' . $verify_result, 'pay_alipay_return', Zero_Log::INFO);


//Android webview 下面返回和浏览器下面，少了一次urlencode， 尝试一次。
if (!$verify_result)
{
    $_GET['notify_id'] = urlencode($_GET['notify_id']);
    $verify_result          = $Payment_AlipayWapModel->verifyReturn();
}


//
$jump_url = sprintf('%s/shop/api/order_proxy.php?order_id=%s', $registry['base_url'], $order_id);

/*
if (Zero_Utils_Device::isMobile())
{
    $jump_url = sprintf('%s/tmpl/member/order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
}
else
{
    
    $jump_url = urlh($registry['index_page'],'User_Order', 'detail', '', '', array('order_id'=>$order_id));
}
*/

//计算得出通知验证结果
if ($verify_result)
{
	//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代


	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

	//解密（如果是RSA签名需要解密，如果是MD5签名则下面一行清注释掉）
	//$notify_data = $alipayNotify->decrypt($_POST['notify_data']);
	$notify_data = $_GET;

	//交易状态
	if (isset($_GET['trade_status']))
	{
		if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS')
		{
			//交易目前所处的状态。成功状态的值只有两个：
			//TRADE_FINISHED（普通即时到账的交易成功状态）；
			//TRADE_SUCCESS（开通了高级即时到账或机票分销产品后的交易成功状态）
			//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			$Consume_TradeModel = new Consume_TradeModel();
			$notify_row = $Payment_AlipayWapModel->getReturnData($Consume_TradeModel);


			$Consume_DepositModel = new Consume_DepositModel();
            //开启事务
            $Consume_DepositModel->sql->startTransactionDb();
            
            $notify_row['store_id']               = $payment_store_id                   ; // 所属店铺
            $notify_row['chain_id']               = $payment_chain_id                   ; // 所属门店
            $notify_row['payment_channel_id']     = $Payment_AlipayWapModel->getChannelId();
            
            $rs = $Consume_DepositModel->processDeposit($notify_row);
            
            if ($rs && $Consume_DepositModel->sql->commitDb())
            {
                //处理一步回调-通知商城更新订单状态
                $Consume_DepositModel->notifyShop($notify_row);
    
                location_to($jump_url, __('支付成功'));
                echo "success";        //请不要修改或删除
            }
            else
            {
                $Consume_DepositModel->sql->rollBackDb();
    
                location_to($jump_url, __('支付失败'));
                echo "fail";
            }
		}
		else
		{
            location_to($jump_url, __('支付失败'));
			echo "fail";
			Zero_Log::log('trade_status 失败:' . $_GET['trade_status'], 'pay_alipay_return_error', Zero_Log::ERROR);
			Zero_Log::log('trade_status 失败:' . $_GET['trade_status'], 'pay_alipay_return', Zero_Log::ERROR);
		}
	}
	else
	{
        location_to($jump_url, __('支付失败'));
		//验证失败
		echo "fail";
		Zero_Log::log('trade_status 失败', 'pay_alipay_return_error', Zero_Log::ERROR);
		Zero_Log::log('trade_status 失败', 'pay_alipay_return', Zero_Log::ERROR);
	}
}
else
{
    location_to($jump_url, __('支付失败'));
	//验证失败
	echo "fail";
	Zero_Log::log('签名验证失败', 'pay_alipay_return_error', Zero_Log::ERROR);
	Zero_Log::log('签名验证失败', 'pay_alipay_return', Zero_Log::ERROR);
	//调试用，写文本函数记录程序运行情况是否正常
	//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>