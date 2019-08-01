<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *  * @author     Xinze <xinze@live.cn>
 *   */
class Base_AppCtl extends AccountAdminController
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

