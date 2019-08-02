<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 系统参数设置模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @version    1.0
 * @todo
 */
class Base_ConfigModel extends Zero_Config
{   

    public $language_code = 'zh-CN';

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'base_config_cond'=>array(
            'config_type'=>null
        ),

        'base_config_store_cond'=>array(
            'config_type'=>null
        )
    );

    public $_languageField = array(
        'it'=>array('config_value')
    );

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='account', &$user=null)
    {
        $this->_useCache  = CHE;

        if ('127.0.0.1' == $_SERVER['HTTP_HOST'] || 'localhost' == $_SERVER['HTTP_HOST'])
        {
            $this->_tableName       = 'base_config';
        }
        else
        {
            $this->_tableName       = 'base_config';
        }


        $this->_tabelPrefix  = TABLE_ACCOUNT_PREFIX;

        $this->language_code = Lang::range();

        parent::__construct($db_id, $user);
    }



    /**
     * 读取分页列表 -- 重写
     *
     * @param  array $column_row where查询条件
     * @param  array $sort  排序条件order by
     * @param  int $page 当前页码
     * @param  int $rows 每页显示记录数
     * @return array $data 返回的查询内容
     * @access public
     */
    public function lists($column_row=array(), $sort=array(), $page=1, $rows=500)
    {   
        //修改值 $column_row
        $data = parent::lists($column_row, $sort, $page, $rows);

        //同一字段有多语言版本
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){
            foreach ($data['items'] as $key => $rows ) {
                 foreach ($languageField[$this->language_code] as $field ) {
                    $data['items'][$key][$field] = $rows[$field.'_'.$this->language_code];
                }
            }
        }
        return $data;
    }


    /**
     * 读取列表 -- 重写
     *
     * @param  array $column_row where查询条件
     * @param  array $sort  排序条件order by
     * @return array $data 返回的查询内容
     * @access public
     */
    public function find($column_row=array(), $sort=array())
    {   
        //修改值 $column_row
        $data = parent::find($column_row, $sort);
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){
            foreach ($data as $key => $rows ) {
                foreach ($languageField[$this->language_code] as $field ) {
                    $data[$key][$field] = $rows[$field.'_'.$this->language_code];
                }
            }
        }
        return $data;
    }

     /**
     * 读取单条数据 -- 重写
     *
     * @param  array $column_row where查询条件
     * @param  array $sort  排序条件order by
     * @return array $data 返回的查询内容
     * @access public
     */
    public function findOne($column_row=array())
    {   
        //修改值 $column_row
        $data = parent::findOne($column_row);
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){
            foreach ($languageField[$this->language_code] as $field ) {
                $data[$field] = $data[$field.'_'.$this->language_code];
            }

        }

        return $data;
    }


    /**
     * 读取单条数据 -- 重写
     *
     * @param  array $key where查询条件
     * @return array $data 返回的查询内容
     * @access public
     */
    public function get( $key )
    {   
        //修改值 $column_row
        $data = parent::get( $key );
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){
            foreach ($data as $key => $rows ) {
                foreach ($languageField[$this->language_code] as $field ) {
                    $data[$key][$field] = $rows[$field.'_'.$this->language_code];
                }
            }
        }
        return $data;
    }

    /**
     * 读取单条数据 -- 重写
     *
     * @param  array $key where查询条件
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getOne( $key )
    {   
       
        //修改值 $column_row
        $data = parent::getOne( $key );
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){
            foreach ($languageField[$this->language_code] as $field ) {
                $data[$field] = $data[$field.'_'.$this->language_code];
            }
        }

        return $data;
    }


    public function edit($table_primary_key_value = null, $field_row, $flag = null, $field_old_row = null)
    {   
        Base_ConfigModel::incDataVersionIni();
        //Zero_Log::log(json_encode($field_row), Zero_Log::ERROR, 'config_row');
        // var_dump( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code] );die();
        if( $this->language_code != 'zh-CN' && isset($this->_languageField) && ($languageField = $this->_languageField) && $languageField[$this->language_code]){

           foreach ($field_row as $key => $value) {
                if( in_array($key, $languageField[$this->language_code])){
                    $field_row[$key.'_'.$this->language_code] = $value;
                    unset($field_row[$key]);
                }
           }
        }

        return parent::edit($table_primary_key_value, $field_row, $flag, $field_old_row); // TODO: Change the autogenerated stub
    }

    public function save($filed_rows = array(), $return_insert_id = false, $flag = false)
    {
        Base_ConfigModel::incDataVersionIni();
        //Zero_Log::log(json_encode($filed_rows), Zero_Log::ERROR, 'config_row1');
        return parent::save($filed_rows, $return_insert_id, $flag); // TODO: Change the autogenerated stub
    }

    /*
     * 生成版本全局配置文件, 数据版本增加
     */
    public static function incDataVersionIni($version='1.0.1')
    {
        $file = INI_PATH . '/version.ini.php';
        $version_row = include $file;

        $version_row['data'] = $version_row['data'] + 0.00001;

        //生成文件内容
        $rows = array('config_row'=>$version_row);
        $rows[] = 'return $config_row';

        $rs = Zero_Utils_File::generatePhpFile($file, $rows);


        //更改缓存

        $shop_manifest_file_row = array();
        $shop_manifest_file_row[] = ROOT_PATH . '/shop/static/src/shop.manifest';
        $shop_manifest_file_row[] = ROOT_PATH . '/wap/wap.manifest';

        foreach ($shop_manifest_file_row as $shop_manifest_file)
        {
            if (is_file($shop_manifest_file))
            {
                $manifest_file_content = file_get_contents($shop_manifest_file);

                $is_matched = preg_match('/# version [1-9]\d*.\d*|0.\d*[1-9]\d*/', $manifest_file_content, $matches);

                if ($is_matched)
                {
                    $matches_row = explode(' ', $matches[0]);
                    $version = end($matches_row);

                    $version = $version + 0.00001;
                    $version = $version_row['data'];

                    $message = @preg_replace('/# version [1-9]\d*.\d*|0.\d*[1-9]\d*/', '# version ' . $version, $manifest_file_content);

                    file_put_contents($shop_manifest_file, $message);
                }
                else
                {

                }
            }
        }

        $shop_sw_file_row = array();
        $shop_sw_file_row[] = ROOT_PATH . '/sw.js';
        //$shop_sw_file_row[] = ROOT_PATH . '/wap/service-worker.js';

        foreach ($shop_sw_file_row as $shop_sw_file)
        {
            if (is_file($shop_sw_file))
            {
                $sw_file_content = file_get_contents($shop_sw_file);
                $is_matched = preg_match('/var SW_CACHE_VERSION="v[1-9]\d*.\d*|0.\d*[1-9]\d*";/', $sw_file_content, $matches);

                if ($is_matched)
                {
                    $matches_row = explode('var SW_CACHE_VERSION="v', $matches[0]);
                    $version = end($matches_row);

                    $version = $version + 0.00001;
                    $version = $version_row['data'];

                    $message = @preg_replace('/var SW_CACHE_VERSION="v[1-9]\d*.\d*|0.\d*[1-9]\d*";/', sprintf('var SW_CACHE_VERSION="v%s', $version), $sw_file_content);

                    file_put_contents($shop_sw_file, $message);
                }
                else
                {

                }
            }
        }

        return $rs;
    }

    /**
     * 是否启用 多店铺
     *
     * @return bool
     */
    public static function ifMultishop()
    {
        return Base_ConfigModel::getConfig('multishop_enable', false);
    }


    /**
     * 是否启用 IM
     *
     * @return bool
     */
    public static function ifIm()
    {
        return Base_ConfigModel::getConfig('im_enable', false);
    }

    /**
     * 是否启用 SNS系统
     *
     * @return bool
     */
    public static function ifSns()
    {
        return Base_ConfigModel::getConfig('sns_enable', false);
    }


    /**
     * 商品列表展示样式
     *
     * @return bool
     */
    public static function getProductShowType()
    {
        return Base_ConfigModel::getConfig('product_show_type', 'SPU');
    }


    /**
     * 是否启用右边购物车栏目
     *
     * @return bool
     */
    public static function ifSideCart()
    {
        return Base_ConfigModel::getConfig('sidecart_enable', false);
    }

    /**
     * 是否启用进销存管理
     *
     * @return bool
     */
    public static function ifInvoicing()
    {
        return Base_ConfigModel::getConfig('invoicing_enable', false);
    }


    /**
     * 是否启用 O2o
     *
     * @return bool
     */
    public static function ifO2o()
    {
        return Base_ConfigModel::getConfig('o2o_enable', false);
    }

    /**
     * 是否启用 平台分销
     *
     * @return bool
     */
    public static function ifPlantformFx()
    {
        return Base_ConfigModel::getConfig('plantform_fx_enable', false);
    }

    /**
     * 是否启用 店铺分销
     *
     * @return bool
     */
    public static function ifStoreFx()
    {
        return Base_ConfigModel::getConfig('store_fx_enable', false);
    }

    /**
     * 是否启用评论
     *
     * @return bool
     */
    public static function ifEvaluation()
    {
        return Base_ConfigModel::getConfig('evaluation_enable', false);
    }


    /**
     * 交易模式  2直接交易:商家直接收款； 1担保交易：平台收款，平台和商家结算。
     *
     * @return bool
     */
    public static function getTradeMode()
    {
        return Base_ConfigModel::getConfig('trade_mode', false);
    }

    /**
     * 担保交易
     *
     * @return bool
     */
    public static function getTradeModePlantform()
    {
        return 1 == self::getTradeMode();
    }

    /**
     * 是否启用虚拟商品
     *
     * @return bool
     */
    public static function ifVirtual()
    {
        return Base_ConfigModel::getConfig('virtual_enable', false);
    }

    /**
     * 是否启用saas系统， 云订货，云小程序等等
     *
     * @return bool
     */
    public static function ifSaas()
    {
        return Base_ConfigModel::getConfig('saas_status', false);
    }

    /**
     * qrcode
     *
     * @return bool
     */
    public static function qrcodeUrl($url)
    {
        if ('http' == substr( $url, 0, 4 ))
        {

        }
        else
        {
            $url = 'http:' . $url;
        }

        //return sprintf('%s/shop/api/qrcode.php?data=%s', Zero_Registry::get('base_url'), urlencode(url('Product', 'item', null, 'item_id' . $item_id)));
        return sprintf('%s/shop/api/qrcode.php?data=%s', Zero_Registry::get('base_url'), urlencode($url));
    }


    /**
     * qrcode
     *
     * @return bool
     */
    public static function qrcode($data, $w=450, $h=450)
    {
        $data = urlencode($data);

        if ($qrcode_url = Base_ConfigModel::getConfig('qrcode_url'))
        {
            return sprintf('%s?url=%s&w=%d&h=%d', $qrcode_url, $data, $w, $h);
        }
        else
        {
            return sprintf('%s/shop/api/qrcode.php?url=%s&w=%d&h=%d', Zero_Registry::get('base_url'), $data, $w, $h);
        }

    }


    public static function isMobile()
    {
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset($_SERVER['HTTP_USER_AGENT']))
        {
            $client_keywords = Array(
                '240x320',
                'acer',
                'acoon',
                'acs-',
                'abacho',
                'ahong',
                'airness',
                'alcatel',
                'amoi',
                'android',
                'anywhereyougo.com',
                'applewebkit/525',
                'applewebkit/532',
                'asus',
                'audio',
                'au-mic',
                'avantogo',
                'becker',
                'benq',
                'bilbo',
                'bird',
                'blackberry',
                'blazer',
                'bleu',
                'cdm-',
                'compal',
                'coolpad',
                'danger',
                'dbtel',
                'dopod',
                'elaine',
                'eric',
                'etouch',
                'fly ',
                'fly_',
                'fly-',
                'go.web',
                'goodaccess',
                'gradiente',
                'grundig',
                'haier',
                'hedy',
                'hitachi',
                'htc',
                'huawei',
                'hutchison',
                'inno',
                'ipad',
                'ipaq',
                'ipod',
                'jbrowser',
                'kddi',
                'kgt',
                'kwc',
                'lenovo',
                'lg ',
                'lg2',
                'lg3',
                'lg4',
                'lg5',
                'lg7',
                'lg8',
                'lg9',
                'lg-',
                'lge-',
                'lge9',
                'longcos',
                'maemo',
                'mercator',
                'meridian',
                'micromax',
                'midp',
                'mini',
                'mitsu',
                'mmm',
                'mmp',
                'mobi',
                'mot-',
                'moto',
                'nec-',
                'netfront',
                'newgen',
                'nexian',
                'nf-browser',
                'nintendo',
                'nitro',
                'nokia',
                'nook',
                'novarra',
                'obigo',
                'palm',
                'panasonic',
                'pantech',
                'philips',
                'phone',
                'pg-',
                'playstation',
                'pocket',
                'pt-',
                'qc-',
                'qtek',
                'rover',
                'sagem',
                'sama',
                'samu',
                'sanyo',
                'samsung',
                'sch-',
                'scooter',
                'sec-',
                'sendo',
                'sgh-',
                'sharp',
                'siemens',
                'sie-',
                'softbank',
                'sony',
                'spice',
                'sprint',
                'spv',
                'symbian',
                'tablet',
                'talkabout',
                'tcl-',
                'teleca',
                'telit',
                'tianyu',
                'tim-',
                'toshiba',
                'tsm',
                'up.browser',
                'utec',
                'utstar',
                'verykool',
                'virgin',
                'vk-',
                'voda',
                'voxtel',
                'vx',
                'wap',
                'wellco',
                'wig browser',
                'wii',
                'windows ce',
                'wireless',
                'xda',
                'xde',
                'zte'
            );


            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', str_replace('/', '\\/', $client_keywords)) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }

        // 协议法，因为有可能不准确，放到最后判断
        if (isset($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }

        return false;
    }
}