<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class AccountController extends PassportController
{
    protected function userLeftWidgets()
    {
        $data = array(1, 2, 3);
        
        $this->renderWidget('user-left', $data);
    }

}


function strHandel($type = 1, $str='')
{

    $str_complete = '';

    if($type == User_BindConnectModel::MOBILE )
    {
        $str_complete = substr($str,0,3).'******'.substr($str,9,2);

    }

    if($type == User_BindConnectModel::EMAIL )
    {
       $str_complete = substr($str,0,2).'******'.substr($str,-6,6);
    }


    return $str_complete;
}
?>