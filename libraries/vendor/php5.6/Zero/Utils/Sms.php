<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     
 */
class Zero_Utils_Sms
{
    public static function send($mob, $code)
    {
        $url = "https://www.qrmenu.app/siyou/public/api/home/sms/sendsms";

        $data = json_encode(array('telnum' => $mob,'code' => $code));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        $flag = json_decode($result,true);
        return $flag['code'];
    }

}
