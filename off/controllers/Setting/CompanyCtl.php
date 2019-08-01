<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_CompanyCtl extends Zero_Api_AdminController
{
	public $store_id = null;
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
		
		$this->store_id = Zero_Perm::getStoreId();
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {
		$data = $this->getUrl('Store_Company', 'get',array('store_id'=>$this->store_id),'seller');
		$this->render('default',$data['data']);
    }
	
	/**
     * 首页
     * 
     * @access public
     */
	public function edit()
	{
		$params['company_name'] = s('company_name');
		$params['company_area'] = s('company_area');
		$params['company_address'] = s('company_address');
		$params['company_taxnum'] = s('company_taxnum');
		$params['company_phone'] = s('company_phone');
		$params['company_id'] = i('company_id');
		$params['contacts_position'] = s('contacts_position');
		$params['contacts_name'] = s('contacts_name');
		$params['contacts_email'] = s('contacts_email');
		$params['company_phone'] = s('company_phone');
		$params['company_country'] = s('company_country');
		//$params['contacts_position'] = s('contacts_position');
		
		$data = $this->getUrl('Store_Company', 'edit',$params,'seller');
		$this->render('default', $data['data'], $data['msg'], $data['status']);
	}
}
?>