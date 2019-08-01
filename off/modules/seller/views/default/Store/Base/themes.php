<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style>

    /*店铺模板主页样式*/

    .templateTitle {
        padding-left: 10px;
        height: 20px;
        line-height: 20px;
        margin-bottom: 15px;
        border-left: 2px solid #02b8b1;
    }

    .templateTitle select {
        height: 20px;
        float: left;
    }

    .templateTitle span {
        float: left;
        margin-right: 10px;
    }

    .usertemplate {
        position: absolute;
        left: 15px;
        top: 15px;
        padding: 10px;
        background: #fff;
        width: 195px;
        height: 316px;
        overflow: hidden;
        border: 1px solid #797979;
    }

    .usertemplateInfo {
        margin-left: 240px;
        height: 316px;
        padding-top: 5px;
        position: relative;
    }

    .usertemplateInfo .qrCode {
        width: 90px;
        height: 90px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .usertemplateInfo .qrCode img {
        max-width: 100%;
    }

    .usertemplateInfo .linkCopy {
        position: absolute;
        left: 520px;
        top: 100px;
    }

    .usertemplateInfo .linkCopy button {
        display: block;
    }

    .templateList ul li {
        position: relative;
        float: left;
        width: 195px;
        margin: 0 20px 30px;
        background-color: #fafafa;
    }

    .templateList ul li .img {
        width: 100%;
        height: 328px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .templateList ul li .img div {
        width: 100%;
        height: 326px;
        overflow: hidden;
    }

    .templateList ul li .img div img {
        width: 100%;
    }

    .templateList ul li:hover .img {
        box-shadow: 0 0 20px #999;
    }

    .templateList ul li.active .img {
        box-shadow: 0 0 20px #999;
    }

    .templateList ul li .lightBtn {
        position: absolute;
        top: 0;
        width: 100%;
        height: 328px;
    }

    .templateList ul li:hover .lightBtn {
        background: rgba(0, 0, 0, .6);
    }

    .templateList ul li .templateUser {
        position: relative;
        margin-top: 10px;
        height: 35px;
        text-align: center;
    }

    .templateList ul li:hover .templateUser {}

    .templateList ul li.active .templateUser {}

    .lightBtn .enableExit {
        position: relative;
        top: 50%;
        width: 100%;
        margin-top: -15px;
        text-align: center;
        opacity: 0;
        -webkit-transition: all .5s;
        transition: all .5s;
        -webkit-transform: translateY(-150%);
        transform: translateY(-150%);
        /* background-color: rgba(0, 0, 0, 0.4); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#44000000, endColorstr=#44000000);*/
    }

    .templateList ul li:hover .lightBtn .enableExit {
        opacity: 1;
        -webkit-transition: all .5s;
        transition: all .5s;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
</style>
<?php
$wap_url = Zero_Registry::get('wap_url') . '/tmpl/store.html?store_id=' . $data['store_id'];
$pc_url = urlh('index.php', 'Store', 'get', null, '', array('store_id'=>$data['store_id']));

$current_tpl = array();
foreach ($data['items'] as $k=> $item)
{
    if ($data['items'][$k]['tpl_id'] > 1000)
    {
        unset($data['items'][$k]);
    }
    
    if ($data['info']['store_template'] == $item['tpl_label'])
    {
        $current_tpl = $item;
        
        $store_template_preview = $item['tpl_image'];
        $store_template_name    = $item['tpl_name'];
        //break;
    }
}
?>
<div class="page-container">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel" id="process">
                    <div class="panel-heading">
                        <h3 class="panel-title">当前使用的模板</h3>
                    </div>
                    <div class="panel-body">
                        <div class="pearls row">
                            <div class="" style="position: relative">
                                <div class="usertemplate">
                                    <img src="<?=$store_template_preview?>" width="175" height="296">
                                </div>
                                <div class="usertemplateInfo">
                                    <div class="qrCode">
                                        <img src="//pan.baidu.com/share/qrcode?w=300&amp;h=300&amp;url=<?=urlencode($wap_url)?>">
                                    </div>
                                    <p class="mb20">手机扫描此二维码，可直接在手机上访问店铺</p>
                                    <p class="mb20 ng-binding">店铺网址：<br><?=$pc_url?></p>
                                    <p class="mb20 ng-binding">模板名称：<?=$store_template_name?> <?php if ($current_tpl['tpl_id'] < 1000 && 107!=$current_tpl['tpl_id']):?>(基础模板，不可DIY)<?php endif;?></p>
                                    <input type="button" class="btn btn-primary mt20" value="编辑模板" onclick="edit(<?= $current_tpl['tpl_id']?>, '<?= $current_tpl['tpl_name']?>')" id="btn_edit">
                                    <input type="button" class="btn btn-primary mt20" id="btn_show" onclick="preview_store('<?=$wap_url?>')" value="预览店铺">
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="panel" id="return_process">
                <div class="panel-heading">
                    <h3 class="panel-title">可选用的模板</h3>
                </div>
                <div class="panel-body">
                    <div class="pearls row">
                        <div class="templateList ng-scope">
                            <ul class="clearfix">

                                <?php foreach ($data['items'] as $item):?>
                                    <li class="col-md-3" ng-repeat="template in Templates" on-finish-render-filters="">
                                        <div class="img">
                                            <div>
                                                <img src="<?=$item['tpl_image']?>">
                                            </div>
                                        </div>
                                        <div class="lightBtn">
                                            <div style="" class="enableExit">
                                                <input type="button" class="btn btn-sm btn-success" onclick="setTemp(<?=$item['tpl_id']?>, '<?=$item['tpl_label']?>')" value="启用">
                                                <input type="button" class="btn btn-sm btn-primary" onclick="edit(<?=$item['tpl_id']?>, '<?= $item['tpl_name']?>')"  value="编辑">

                                            </div>
                                        </div>
                                        <p class="templateUser ng-binding"><?=$item['tpl_name']?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


    <script>

        function setTemp(tpl_id, tpl_label){
            //设置启用的模板

            $.dialog.confirm(__('确定启用此模板风格？'), function () {

                Public.ajax({
                    url: SYS.CONFIG.index_url + '?mdu=seller&ctl=Store_Base&met=setTemplate&typ=json', // 请求的URL
                    dataType: 'json',
                    cache: false,
                    data: {tpl_id: tpl_id, store_template:tpl_label},
                    success: function (response) {
                        if (response.status == 200) {
                            parent.Public.tips({content: __('修改成功！')});
                            
                            window.location.reload();
                        }
                        else
                        {
                            parent.Public.tips({type: 1, content: __('修改失败！')});
                        }
                    }
                });
            });
        }
        
        function edit(tpl_id, tpl_name) {
            if (tpl_id < 1000 && 107!=tpl_id)
            {
                var url =  "<?=Zero_Registry::get('url')?>?mdu=seller&ctl=Store_Base&met=index&typ=e&tpl_id=" + tpl_id;

            }
            else {
                var url =  "<?=Zero_Registry::get('url')?>?mdu=seller&ctl=Page_Base&met=diy&typ=e&tpl_id=" + tpl_id;

            }

            parent.tab.addTabItem({
                text:tpl_name,
                url: url
            });
        }


        function preview_store(wap_url) {

            parent.tab.addTabItem({
                text:'预览',
                url: wap_url
            });
        }

        
        function preview(tpl_id) {
            parent.tab.addTabItem({
                text:'预览',
                url: "<?=Zero_Registry::get('base_url')?>/index.php?mdu=mobile&ctl=Wechat&met=preview&typ=e&id=" + tpl_id
            });
        }
        
        $('#dashboard a').click(function(e){

            e.preventDefault();

            var aurl = $(this).attr('href');
            var text = $(this).find('span').html();


            var target = $(this).attr('target');

            if (target == '_blank')
            {
                return true;
            }
            else
            {
                parent.tab.addTabItem({
                    text:text,
                    //url: SYS.config.index_url + '/' +aurl
                    url: aurl
                });
            }

            return false;
        });
    </script>
