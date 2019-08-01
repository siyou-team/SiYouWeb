<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Store_MediaCtl extends SellerAdminController
{
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {


		$gallery_rows = $this->getUrl('Store_MediaGallery', 'lists');
        $data['gallery_rows'] = $gallery_rows['data']['items'];

		$this->render('default', $data, $gallery_rows['msg'], $gallery_rows['status']);

    }
    
    public function upload()
    {
        $this->render('default');
    }
}
?>