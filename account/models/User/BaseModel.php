<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户基本信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @version    1.0
 * @todo
 */
class User_BaseModel extends Zero_Model
{
	public $_cacheName       = 'user';
	public $_tableName       = 'user_base';
	public $_tablePrimaryKey = 'user_id';
	public $_useCache        = false;
    public $_languageCond    = false;
    
	public $fieldType = array('rights_group_id'=>'DOT', 'store_ids'=>'DOT', 'chain_ids'=>'DOT');

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'user_base_cond'=>array(
			'user_account'=>null,
            'user_nickname'=>null,
			'user_token'=>null,
			'user_state'=>null,
			'user_is_admin'=>null,
			'store_id'=>null,
            'store_ids'=>null,
            'chain_ids'=>null,
            'user_id'=>null,
		)
	);

	public $_validateRules = array('integer'=>array('user_id', 'user_state'));

	public $_validateLabels= array();


	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='account', &$user=null)
	{
		$this->_useCache  = CHE;

		$this->_tabelPrefix  = TABLE_ACCOUNT_PREFIX;
		parent::__construct($db_id, $user);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  array $column_row where查询条件
	 * @param  array $sort  排序条件order by
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @return array $data 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$data = $this->lists($column_row, $sort, $page, $rows);
        
        foreach ($data['items'] as $k=>$item)
        {
			unset($data['items'][$k]['user_key']);
			unset($data['items'][$k]['user_password']);
			unset($data['items'][$k]['user_salt']);
			unset($data['items'][$k]['user_token']);
		}

		return $data;
	}


	public function clean()
	{
		$data = array();

		foreach ($this->_multiCond as $group=>$cond)
		{
			//通过组删除操作, 数据量如果大, 则可以通过异步方式删除
			$flag = $this->cleanGroup($group);
			$data[] = $flag;
		}

		return $data;
	}


	public function getByAccount($user_account)
	{
		$data = array();
		$group = 'user_base_cond';
		$column_row['user_account'] = $user_account;


		//修改值 $column_row
		//$column_tpl_row = $this->checkColumn($group, $column_row);
        
        $data = $this->findOne($column_row, array('user_account'=>'asc', 'user_password'=>'asc'), 1, 500);


		return $data;
	}

    public function getByNickname($user_nickname){
        $column_row['user_nickname'] = $user_nickname;

        $data = $this->findOne($column_row);


        return $data;
    }

    public function getByMobile($user_mobile){
        $user_connect_row = User_BindConnectModel::getInstance()->getOne($user_mobile);

        if ($user_connect_row && $user_connect_row['bind_type']==User_BindConnectModel::MOBILE)
        {

        }
        else
        {
            return false;
        }

        return $user_connect_row;
    }

	public function removeUser($user_id)
    {
        $rs_row = array();

        $flag = $this->remove($user_id);

        check_rs($flag, $rs_row);

        $remove_array = ['User_BindConnectModel','User_FriendModel','User_GroupModel','User_InfoModel','User_ResourceModel'];

        foreach($remove_array as $val)
        {
            $tmp = $val::getInstance();

            $flag = $tmp->removeCond(array('user_id'=>$user_id));

            check_rs($flag, $rs_row);

        }

        return is_ok($rs_row);

    }
    
    
    /**
     * 用户数量
     *
     * @access public
     * @return int
     */
    public function getUserNum($user_state = null)
    {
        $where = array();
        
    	if (null !== $user_state)
		{
            $where = array('user_state' => $user_state);
		}

        return $this->getNum($where);
    }
    
    /**
     * 门店客户来源
     *
     * @access public
     * @return int
     */
    public static function getSourceChainId()
    {
        return i('source_chain_id') ? i('source_chain_id') : Zero_Cookie::getInstance()->getCookie('chid');
    }
    
    /**
     * 添加分销来源用户 - 台推广员功能，佣金平台出
     *
     * @access public
     * @return int
     */
    public static function addSourceChainId($user_id, $chain_id=null)
    {
        $flag = true;
        
        
        if ($chain_id || $chain_id = User_BaseModel::getSourceChainId())
        {
            //读取门店所属店铺
            $chain_base_row = Chain_BaseModel::getInstance()->getOne($chain_id);
            if ($chain_base_row && @$chain_base_row['store_id'])
            {
                $User_ChainModel = User_ChainModel::getInstance();
                $user_chain_row  = $User_ChainModel->findOne(array('user_id' => $user_id));

                $user_chain_row['chain_id'] = $chain_id;
                $user_chain_row['user_id']  = $user_id;
                $user_chain_row['store_id']  = $chain_base_row['store_id'];

                $flag = $User_ChainModel->saveUserChain($user_chain_row);
            }
            else
            {
                $flag = false;
            }
        }
        
        return $flag;
    }
    
    
    /**
     * 用户来源
     *
     * @access public
     * @return int
     */
    public static function getSourceUserId()
    {
        return i('source_user_id') ? i('source_user_id') : Zero_Cookie::getInstance()->getCookie('fxid');
    }
    
    /**
     * 添加分销来源用户 - 台推广员功能，佣金平台出
     *
     * @access public
     * @return int
     */
    public static function addSourceUserId($user_id, $user_parent_id=null)
    {
    	$flag = true;
    	
    	//分销用户来源 - 平台推广员功能，佣金平台出
        if ($user_parent_id || $user_parent_id = User_BaseModel::getSourceUserId())
        {
            $fx_row = array();
            $fx_row['user_id'] = $user_id;
            $fx_row['user_parent_id'] = $user_parent_id;
            $fx_row['user_time'] = time();
            
            $flag = Distribution_PlantformUserModel::getInstance()->addPlantformUser($fx_row);
            
            //添加父收益表，判断
    
            if (!Distribution_UserCommissionModel::getInstance()->getOne($user_parent_id))
            {
                $distribution_user_commission_row = array();
                $distribution_user_commission_row['user_id'] = $user_parent_id;
    
                Distribution_UserCommissionModel::getInstance()->add($distribution_user_commission_row);
            }
            
    
            //初始化推销员记录
            if (!Distribution_UserModel::getInstance()->getOne($user_parent_id))
            {
                Distribution_UserModel::getInstance()->add(array('user_id'=>$user_parent_id, 'user_time'=>time()));
            }
        }
        
        return $flag;
    }
    
    /**
     * 店铺客户来源
     *
     * @access public
     * @return int
     */
    public static function getSourceStoreId()
    {
        return i('source_store_id') ? i('source_store_id') : Zero_Cookie::getInstance()->getCookie('stid');
    }
    
    /**
     * 添加分销来源用户 - 店铺销售员功能  - 所有分享入口都要判断。 用户关系可更改。
     *
     * @access public
     * @return int
     */
    public static function addStoreSourceUserId($user_id, $user_parent_id=null, $store_id=null)
    {
        $flag = true;
        
        //分销用户来源 - 平台推广员功能，佣金平台出
        if (($user_parent_id|| $user_parent_id = User_BaseModel::getSourceUserId()) && ($store_id || $store_id=User_BaseModel::getSourceStoreId()))
        {
            $fx_row = array();
            $fx_row['user_id'] = $user_id;
            $fx_row['user_parent_id'] = $user_parent_id;
            $fx_row['store_id'] = $store_id;
            $fx_row['user_time'] = time();
            
            //$flag = Distribution_PlantformUserModel::getInstance()->addPlantformUser($fx_row);
        }
        
        return $flag;
    }

}
?>
