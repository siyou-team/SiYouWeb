<?php

class LoginsCtl extends Zero_AppController
{
    
    public function doLogin()
    {
        $user_account = s('user_account', null);
        $user_password = s('user_password', null);

        $user_account = strtolower($user_account);

        $LoginModel = new LoginModel();
        $data = $LoginModel->login($user_account, $user_password);

        if ($data) {
            $status = 200;
            $msg = $LoginModel->msg->getMsg();
        } else {
            $status = 250;
            $msg = $LoginModel->msg->getMsg();
        }

        $this->render('default', $data, $msg, $status);
    }
}

?>