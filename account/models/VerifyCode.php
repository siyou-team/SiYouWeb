<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 验证码生成管理类
 *
 *
 * @category   Framework
 * @package    Zero
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class VerifyCode
{

	private static $_prefix = 'm|zero|';

	/**
	 * 构造函数
	 *
	 * @access    private
	 */
	public function __construct()
	{
	}

	/**
	 *
	 * 多台服务器的话,需要使用分布式存储, 或者存入数据库, 可以修改为远程调用
	 *
	 *
	 * @param string $key 随机key值, 如果手机短信,则为手机号码 , 邮件同理
	 * @var   int $code_type 数字\字母\中文
	 * @var   int $type 类型
	 * @return void
	 * @access public
	 */
	public static function getVerifyCode($key, $code_type = null)
	{
        $user_code = mt_rand(100000, 999999);

        $save_result = self::_saveCodeCache($key,$user_code,'verify_code');

        if($save_result)
        {
            $content = $user_code;
            $flag = Sms::send($key,$content);
        }

		return $user_code;
	}

    /**
     *  缓存验证码
     * @param type $key
     * @param type $value
     * @param type $group
     * @return type
     */
    private static function _saveCodeCache($key,$value,$group='default'){

        $config_cache = Zero_Registry::get('config_cache');

        if (!file_exists($config_cache[$group]['cacheDir'])){
            $mk_flag = mkdir($config_cache[$group]['cacheDir'],0777,true);
        }
        $Cache_Lite = new Cache_Lite_Output($config_cache[$group]);

        try
        {
            $result = $Cache_Lite->save($value,$key);
        }
        catch(Exception $e)
        {

        }

        return $result;
    }

	/**
	 * 验证输入code是否正确, 可以修改为远程调用
	 *
	 * @param  string $key 组名称
	 * @param  mixed $user_code 当前页码
	 * @return bool 返回结果
	 * @access public
	 */
	public static function checkCode($key, $user_code = null)
	{
    $config_cache = Zero_Registry::get('config_cache');
    $Cache_Lite   = new Cache_Lite_Output($config_cache['verify_code']);
		$code  = $Cache_Lite->get($key);
		if ($code == $user_code)
		{
			$Cache_Lite->remove($key);

			return true;
		}
		else
		{
			return false;
		}

	}

}
