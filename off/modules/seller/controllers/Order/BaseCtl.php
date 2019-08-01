<?php if (!defined('ROOT_PATH')) exit('No Permission');


class Order_BaseCtl extends SellerAdminController
{
    /**
     * 订单详细信息-检索不分也行，cache首页
     * 
     * @access public
     */
    public function index()
    {
        $data = $this->getUrl('Store_Config', 'get', null);

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
    
    /**
     * 订单详细信息-检索不分也行，cache管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
    
    public function logisticsManage()
    {
        $this->render('manage');
    }


    /**
     * 订单核销---通过提货核销
     */
    public function checkPickUpCode()
    {
        $this->render('default');
    }


    /**
     * 订单审核详细信息
     *
     * @access public
     */
    public function detail()
    {

        $data = $this->getUrl('Store_Config', 'get', null);

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }

    /**
     * 订单Excel导出/打印页面
     */
    public function push(){

        $data = $this->getUrl('Order_Base', 'getOrderDetail', 'seller');
        if (i('export',0) === 1){
            $filename = "订单-" . $data['data']['order_id'];
            header("Content-type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename.xls");
        }

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
    /**
     * 出库单Excel导出/打印页面
     */
    public function outStock(){

        $data = $this->getUrl('Stock_Bill', 'get', 'invoicing');

        if (i('export',0) === 1){
            $filename = "出库单-" . $data['data']['stock_bill_id'];
            header("Content-type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename.xls");
        }

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
    /**
     * 送货单Excel导出/打印页面
     */
    public function outLogistics(){

        $data = $this->getUrl('Stock_Bill', 'get', 'invoicing');
        if (i('export',0) === 1){
            $filename = "送货单-" . $data['data']['order_id'];
            header("Content-type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename.xls");
        }

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
}
