<?php
/**
 * 
 * 通过这个类，统一管理支付类。
 * 
 * @category   Framework
 * @package    Payment
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo       
 */
class PaymentModel
{
    const PAYMENT_MET_MONEY          = 1; //余额支付
    const PAYMENT_MET_RECHARGE_CARD             = 2; //充值卡支付
    const PAYMENT_MET_POINTS = 3; //积分支付
    const PAYMENT_MET_CREDIT = 4; //信用支付
    const PAYMENT_MET_REDPACK          = 5; //红包支付
    
    /**
     * 构造函数
     *
     * @access    private
     */
    public function __construct()
    {
    }

    /**
     * 得到支付句柄
     *
     * @param array  $channel   使用的支付驱动
     *
     * @return    Payment_Interface
     *
     * @access public
     */
    public static function create($channel, $store_id=0, $chain_id=0)
    {
        $Payment_ChannelModel = new Payment_ChannelModel();
		$config_row = $Payment_ChannelModel->getChannelConfig($channel, $store_id, $chain_id);

		if (!$config_row)
		{
			throw new Exception(__('支付配置数据错误!'));
		}

        $PaymentModel = null;

        if ('alipay' == $channel)
        {
			$detect = new Device_Detect();

            if ($detect->isMobile())
            {
                //wap修改字段
                $PaymentModel = new Payment_AlipayModel($config_row, 'wap');
            }
            else
            {
				$PaymentModel = new Payment_AlipayModel($config_row, 'pc');
            }
        }
        elseif ('tenpay' == $channel)
        {
            $PaymentModel = new Payment_TenpayModel($config_row);
        }
        elseif ('tenpay_wap' == $channel)
        {
            $PaymentModel = new Payment_TenpayWapModel($config_row);
        }
        elseif ('wx_native' == $channel)
        {
            //小程序app
            if (i('prepay_flag'))
            {
                //!defined('APPID_DEF') && define('APPID_DEF', Base_ConfigModel::getConfig('wechat_xcx_app_id'));
                //!defined('APPSECRET_DEF') && define('APPSECRET_DEF', Base_ConfigModel::getConfig('wechat_xcx_app_secret'));
                
                !defined('APPID_DEF') && define('APPID_DEF', $config_row['wechat_xcx_app_id']);
                !defined('APPSECRET_DEF') && define('APPSECRET_DEF', $config_row['wechat_xcx_app_secret']);
            }
            else
            {
                //!defined('APPID_DEF') && define('APPID_DEF', Base_ConfigModel::getConfig('wechat_app_id'));
                //!defined('APPSECRET_DEF') && define('APPSECRET_DEF', Base_ConfigModel::getConfig('wechat_app_secret'));
    
    
                !defined('APPID_DEF') && define('APPID_DEF', $config_row['wechat_app_id']);
                !defined('APPSECRET_DEF') && define('APPSECRET_DEF', $config_row['wechat_app_secret']);
            }
            
            //微信变量, 不变动程序,修正数据
            !defined('MCHID_DEF') && define('MCHID_DEF', $config_row['mchid']);
            !defined('KEY_DEF') && define('KEY_DEF', $config_row['key']);

            !defined('SSLCERT_PATH_DEF') && define('SSLCERT_PATH', LIB_PATH . '/Api/wx/cert/apiclient_cert.pem');
            !defined('SSLKEY_PATH_DEF') && define('SSLKEY_PATH', LIB_PATH . '/Api/wx/cert/apiclient_key.pem');
    
            $config_row['appid'] = APPID_DEF;
            $config_row['appsecret'] = APPSECRET_DEF;
            
            //自动检测是否在微信中调用，如果在则Payment_WxJsModel
            if (Zero_Utils_Device::isWeixin() || i('mp_flag') ||  i('prepay_flag'))
            {
                $PaymentModel = new Payment_WxJsModel($config_row);
            }
            else
            {
                if (Zero_Utils_Device::isMobile())
                {
                    $PaymentModel = new Payment_WxH5Model($config_row);
                
                }
                else
                {
                    $PaymentModel = new Payment_WxNativeModel($config_row);
                }
            }
        }
        else
        {
        }

        return $PaymentModel;
    }

    /**
     * 得到支付句柄
     *
     * @param array  $channel   使用的支付驱动
     *
     * @return Object   Payment Object
     *
     * @access public
     */
    public static function get($channel)
    {
        return self::create($channel);
    }
}
?>