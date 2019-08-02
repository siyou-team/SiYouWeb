<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 支付渠道-可以用config取代控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-11-12, Xinze
 * @request int $payment_channel_id ID
 * @request string $payment_channel_code 代码名称
 * @request string $payment_channel_name 支付名称
 * @request string $payment_channel_config 支付接口配置信息(JSON)
 * @request int $payment_channel_status 接口状态
 * @request string $payment_channel_allow 类型
 * @request int $payment_channel_wechat 微信中是否可以使用
 * @request int $payment_channel_enable 是否启用
 */
class Api_Payment_ChannelCtl extends Api_PayController
{
    public $paymentChannelModel = null;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->paymentChannelModel = new Payment_ChannelModel();
    }

    /**
     * 支付渠道-可以用config取代列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $store_id = Zero_Perm::getStoreId();

		$page = i('page', 1);  //当前页码
		$rows = i('rows', 500); //每页记录条数
		$sort = grid_sort();
    
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();
        
        $where = array();
        $where['store_id'] = $store_id;
        $where['chain_id'] = $chain_id;

		$data = $this->paymentChannelModel->getLists($where, $sort, $page, $rows);

        $this->render('pay', $data);
    }

    /**
     * 读取支付渠道-可以用config取代
     *
     * @access public
     */
    public function get()
    {
        return ;
        
        $store_id = Zero_Perm::getStoreId();

		$payment_channel_id_str = s('payment_channel_id'); //ID ","分割
		$payment_channel_id_row = explode(',', $payment_channel_id_str);

		//权限判断

		$rows = $this->paymentChannelModel->get($payment_channel_id_row);

        $this->render('pay', $rows);
    }
    
    /**
     * 添加支付渠道-可以用config取代-收款账户
     *
     * @access public
     */
    public function add()
    {
        $data['payment_channel_id']     = i('payment_channel_id')         ; // ID
        $data['payment_channel_code']   = s('payment_channel_code')       ; // 代码名称
        $data['payment_channel_name']   = s('payment_channel_name')       ; // 账户名称
        $data['payment_channel_config'] = decode_json(s('payment_channel_config'))     ; // 支付接口配置信息(JSON)
        $data['payment_channel_allow']  = s('payment_channel_allow')      ; // 类型(LIST):both-全终端使用;wap-移动端;pc-PC端
        $data['payment_channel_wechat'] = i('payment_channel_wechat')     ; // 微信中是否可以使用(LIST):1-启用; 0-禁用
        $data['payment_channel_enable'] = i('payment_channel_enable')     ; // 是否启用(ENUM):1-启用; 0-禁用
        $data['payment_type_id']        = i('payment_type_id')            ; // 支付方式(LIST):1302-在线支付【站内支付余额充值卡白条】;1305-线下支付
        $data['payment_channel_order']  = i('payment_channel_order')      ; // 排序:数字越小排序越靠前
        $data['payment_channel_buildin'] = 0      ;
        
        unset($data['payment_channel_id']);
        
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $data['store_id'] = $store_id;
    
        $chain_id = Zero_Perm::getChainId();
        $data['chain_id'] = $chain_id;
        
        $payment_channel_id = $this->paymentChannelModel->add($data, true);
        
        if ($payment_channel_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
        
        $data['payment_channel_id'] = $payment_channel_id;
        
        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 删除支付渠道-可以用config取代-收款账户
     *
     * @access public
     */
    public function remove()
    {
        $payment_channel_id_row = id('payment_channel_id'); //ID
    
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();
    
        $row = $this->paymentChannelModel->getOne($payment_channel_id_row);
    
        if (!$row['payment_channel_buildin'])
        {
            $rows=$this->paymentChannelModel->get($payment_channel_id_row);
            
            if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows, 'store_id') || Zero_Perm::checkDataRights($chain_id, $rows, 'chain_id'))
            {
                $flag = $this->paymentChannelModel->remove($payment_channel_id_row);
        
                if ($flag !== false)
                {
                    $msg = __('操作成功');
                    $status = 200;
                }
                else
                {
                    $msg = __('操作失败');
                    $status = 250;
                }
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
    
            $data['payment_channel_id'] = $payment_channel_id_row;
        }
        else
        {
            $msg = __('系统内置，不可以删除');
            $status = 250;
        }
        
        $data['payment_channel_id'] = $payment_channel_id_row;
        
        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 修改支付渠道-可以用config取代-收款账户
     *
     * @access public
     */
    public function edit()
    {
        $data['payment_channel_id']     = i('payment_channel_id')         ; // ID
        $data['payment_channel_code']   = s('payment_channel_code')       ; // 代码名称
        $data['payment_channel_name']   = s('payment_channel_name')       ; // 账户名称
        $data['payment_channel_config'] = s('payment_channel_config')     ; // 支付接口配置信息(JSON)
        $data['payment_channel_allow']  = s('payment_channel_allow')      ; // 类型(LIST):both-全终端使用;wap-移动端;pc-PC端
        $data['payment_channel_wechat'] = i('payment_channel_wechat')     ; // 微信中是否可以使用(LIST):1-启用; 0-禁用
        $data['payment_channel_enable'] = i('payment_channel_enable')     ; // 是否启用(ENUM):1-启用; 0-禁用
        $data['payment_type_id']        = i('payment_type_id')            ; // 支付方式(LIST):1302-在线支付【站内支付余额充值卡白条】;1305-线下支付
        $data['payment_channel_order']  = i('payment_channel_order')      ; // 排序:数字越小排序越靠前
        
        
        $payment_channel_id = $data['payment_channel_id'];
        $data_rs = $data;
        unset($data['payment_channel_id']);
        
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();
    
    
        $row = $this->paymentChannelModel->getOne($payment_channel_id);
        
        if ($row['payment_channel_buildin'])
        {
            unset($data['payment_channel_code']);
        }
    
        $rows=$this->paymentChannelModel->get($payment_channel_id);
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows, 'store_id') || Zero_Perm::checkDataRights($chain_id, $rows, 'chain_id'))
        {
            $flag = $this->paymentChannelModel->edit($payment_channel_id, $data);
        
            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
        
        $this->render('user', $data_rs, $msg, $status);
    }
    
    public function resource()
    {
        $store_id = i('store_id'); //用户ID ","分割
        
        //权限判断
        $data = User_ResourceModel::getInstance()->getOne($store_id);
        
        $this->render('pay', $data);
    }
}
