<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/multiselect/css/multi-select', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-new', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-bootstrap', true)?>">

<div class="page-container">
    <div class="main-content">
        <div class="page-title">
            
            <div class="title-env">
                <h1 class="title"><?= __('用户中心站点设置') ?></h1>
            </div>
            
        </div>
        
        <div class="form-group">
            <div class="col-md-12">
                <div class="tabs-vertical-env">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-site">
                            <div class="wrapper page">
                                <form method="post" enctype="multipart/form-data" id="site-setting-form" name="form1"
                                      class="form-horizontal">
                                    <input type="hidden" name="config_type[]" value="site"/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">网站名称</label>
                                        
                                        <div class="col-sm-10">
                                            <input id="account_site_name" name="site[account_site_name]"
                                                   value="<?= ($data['account_site_name']['config_value']) ?>"
                                                   class="form-control" type="text"/>
                                            <p class="help-block">网站名称，将显示在前台顶部欢迎信息等位置</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="theme_id_wrap">网站默认模板</label>
                                        <div class="col-sm-10">
                                            <span id="theme_id_wrap"></span>
                                            <input id="theme_id" name="site[theme_id]"
                                                   value="<?= ($data['theme_id']['config_value']) ?>"
                                                   type="hidden"/>
                                            <p class="help-block">设置网站默认模板</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="language_id_wrap">系统默认语言</label>
                                        <div class="col-sm-10">
                                            <span id="language_id_wrap"></span>
                                            <input id="language_id" name="site[language_id]"
                                                   value="<?= ($data['language_id']['config_value']) ?>"
                                                   type="hidden"/>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="date_default_timezone_set_wrap">使用时区</label>
                                        <div class="col-sm-10">
                                            <span id="date_default_timezone_set_wrap"></span>
                                            <input id="date_default_timezone_set" name="site[date_default_timezone_set]"
                                                   value="<?= ($data['date_default_timezone_set']['config_value']) ?>"
                                                   type="hidden"/>
                                            <p class="help-block">设置系统使用的时区，中国为+8</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="monetary_unit">货币单位符号</label>
                                        <div class="col-sm-10">
                                            <input id="monetary_unit" name="site[monetary_unit]"
                                                   value="<?= ($data['monetary_unit']['config_value']) ?>"
                                                   class="form-control" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="date_format_wrap">日期格式</label>
                                        <div class="col-sm-10">
                                            <span id="date_format_wrap"></span>
                                            <input id="date_format" name="site[date_format]"
                                                   value="<?= ($data['date_format']['config_value']) ?>"
                                                   type="hidden"/>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="time_format_wrap">时间格式</label>
                                        <div class="col-sm-10">
                                            <span id="time_format_wrap"></span>
                                            <input id="time_format" name="site[time_format]"
                                                   value="<?= ($data['time_format']['config_value']) ?>"
                                                   type="hidden"/>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="icp_number">ICP证书号</label>
                                        <div class="col-sm-10">
                                            <input id="icp_number" name="site[icp_number]"
                                                   value="<?= ($data['icp_number']['config_value']) ?>"
                                                   class="form-control" type="text"/>
                                            <p class="help-block">前台页面底部可以显示 ICP
                                                备案信息，如果网站已备案，在此输入你的授权码，它将显示在前台页面底部，如果没有请留空</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="statistics_code">第三方流量统计代码</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control autosize" name="site[statistics_code]"
                                                      id="statistics_code"><?= ($data['statistics_code']['config_value']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="copyright">版权信息</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control autosize" name="site[copyright]"
                                                      id="copyright"><?= ($data['copyright']['config_value']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="site_status">站点状态</label>
                                        <div class="col-sm-10">
                                            <label title="开启" for="site_status1"><input class="cbr cbr-success"
                                                                                        id="site_status1"
                                                                                        name="site[site_status]"
                                                                                        value="1"
                                                                                        type="radio" <?= ($data['site_status']['config_value'] == 1 ? 'checked' : '') ?>>
                                                开启</label>
                                            &nbsp;&nbsp;
                                            <label title="关闭" for="site_status0"><input class="cbr " id="site_status0"
                                                                                        name="site[site_status]"
                                                                                        value="0"
                                                                                        type="radio" <?= ($data['site_status']['config_value'] == 0 ? 'checked' : '') ?>>关闭</label>
                                            
                                            <p class="help-block">可暂时将站点关闭，其他人无法访问，但不影响管理员访问后台</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="closed_reason">关闭原因</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control autosize" name="site[closed_reason]"
                                                      id="closed_reason"><?= ($data['closed_reason']['config_value']) ?></textarea>
                                            
                                            <p class="help-block">当网站处于关闭状态时，关闭原因将显示在前台</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <a type="submit"
                                               class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                               id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab-api">
                            <div class="wrapper page">
                                
                                <form method="post" id="shop_api-setting-form" name="settingForm"
                                      class="form-horizontal">
                                    <input type="hidden" name="config_type[]" value="shop_api"/>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">店铺网站URL</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_url" name="shop_api[shop_app_url]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_url') ?>"
                                                   class="form-control" type="text"/>
                                            <p class="help-block">后台与网站通信的URL</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">店铺网站URL</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="shop_api[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <a type="submit"
                                               class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                               id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                </form>

                                <br />
                                <br />

                                <form method="post" id="ucenter-shop_api-setting-form" name="ucenterSettingForm"
                                      class="form-horizontal">
                                    <input type="hidden" name="config_type[]" value="passport_api"/>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">用户中心API URL</label>
                                        <div class="col-sm-10">
                                            <input id="passport_app_url" name="passport_api[passport_app_url]"
                                                   value="<?= Base_ConfigModel::getConfig('passport_app_url') ?>"
                                                   class="form-control" type="text"/>
                                            
                                            <p class="help-block">后台与用户中心网站通信的URL</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">管理用户中心KEY</label>
                                        <div class="col-sm-10">
                                            <input id="passport_app_key" name="passport_api[passport_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('passport_app_key') ?>"
                                                   class="form-control" type="text"/>
                                            <p class="help-block">后台与用户中心网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <a type="submit"
                                               class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                               id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                </form>
                            </div>
                        
                        </div>

                        <div class="tab-pane" id="tab-secure">
                            <div class="wrapper page">
                                
                                <form method="post" id="secure-setting-form" name="settingForm"
                                      class="form-horizontal">
                                    <input type="hidden" name="config_type[]" value="security"/>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">Access-Control-Allow-Origin</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_url" name="security[shop_app_url]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_url') ?>"
                                                   class="form-control" type="text"/>
                                            <p class="help-block">后台与网站通信的URL</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">Content-Security-Policy</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="security[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    

                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">Strict-Transport-Security</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="security[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>

                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">X-Content-Type-Options</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="security[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>

                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">X-Frame-Options</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="security[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="account_site_name">X-XSS-Protection</label>
                                        <div class="col-sm-10">
                                            <input id="shop_app_key" name="security[shop_app_key]"
                                                   value="<?= Base_ConfigModel::getConfig('shop_app_key') ?>" class="form-control"
                                                   type="text"/>
                                            
                                            <p class="help-block">后台与网站通信的数据加密验证Key</p>
                                        </div>
                                    </div>
                                    <div class="form-group-separator"></div>

                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <a type="submit"
                                               class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                                               id="submit-btn">
                                                <i class="fa-pencil"></i>
                                                <span>修改</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                </form>


                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<script type="text/javascript">
    var date_default_timezone_set = '<?= ($data['date_default_timezone_set']['config_value']) ?>';
    
    var language_id = <?= intval($data['language_id']['config_value']) ?>;
    var language_row = <?= encode_json($data['language_row']) ?>;
    
    var theme_id =  <?= encode_json($data['theme_id']['config_value']) ?>;
    var theme_row = <?= encode_json($data['theme_row']) ?>;
    
    
    var date_format_combo = "<?= ($data['date_format']['config_value']) ?>";
    var time_format_combo = "<?= ($data['time_format']['config_value']) ?>";

</script>
<script type="text/javascript" src="<?=$this->js('plugins/tagsinput/bootstrap-tagsinput.min', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('modules/account/config')?>" charset="utf-8"></script>
