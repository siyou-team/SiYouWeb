<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class IndexCtl extends SellerAdminController
{
    public function dashboard()
    {
        $data = $this->getUrl('Analytics', 'dashboardSeller');

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
}
?>