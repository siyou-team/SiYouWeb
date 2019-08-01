<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_InfoCtl extends AccountAdminController
{
    function index()
    {
        $this->render();
    }

    public function manage()
    {
        $this->render('manage');
    }
}
