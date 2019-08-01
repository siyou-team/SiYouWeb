<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Product_BaseCtl extends SellerAdminController
{
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {
		$this->render('default');
    }
    /**
     * 首页
     *
     * @access public
     */
    public function selectCategory()
    {
        $this->render('manage');
    }
    
    /**
     * 管理界面
     * 
     * @access public
     */
	public function manage()
	{
	    $data = array();
	    
	    $product_id = null;
        $category_id = null;

	    if ($data = decode_json(s('data', '[]')))
        {
            $product_id = @$data['rowData']['product_id'];
            
            $_POST['product_id'] = $product_id;
        }
        else
        {
        }
        // var_dump( $data );die();
        if ($category_id = i('category_id'))
        {
            $_POST['category_id'] = $category_id;
        }
        
        unset($_GET['data']);
	    
        $data = $this->getUrl('Product_Base', 'info', '');
        
        if (!$category_id && $product_id)
        {
            $_POST['category_id'] = $data['data']['product'][$product_id]['category_id'];
            
        }

        $category_data = $this->getUrl('Base_ProductCategory', 'get', '');
        $data['data']['category_row'] = $category_data['data'];
      
		$this->render('default', $data['data'], $data['msg'], $data['status']);
	}

	/**
	 * 管理界面
	 *
	 * @access public
	 */
	public function closeManage()
	{
		$this->render('manage');
	}

	/**
	 * 管理界面
	 *
	 * @access public
	 */
	public function verifyManage()
	{
		$this->render('manage');
	}
    
    
    public function specItemManage()
    {
        $this->render('manage');
    }
    
	public function details()
	{
		$this->render('manage');
	}

    /**
     * 首页
     *
     * @access public
     */
    public function filter()
    {
        $this->render('default');
    }
}
?>