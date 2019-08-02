<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="renderer" content="webkit">
    <title><?=$layout_data['site_name']?></title>

</head>
<body>

<style>.page-errors .page-error{height:90vh}.page-error .error-mark{margin-bottom:33px}.page-error header .icon:before{margin-bottom:20px;font-size:120px}.page-error header h1{font-size:120px;color:#76838f}.page-error header h3{margin-top:30px}.page-error header p{margin-bottom:30px;text-transform:uppercase}main.site-page .page-error .page-copyright{display:none}
</style>
<div class="page page-full vertical-align text-center animation-fade page-error">
    <div class="page-content vertical-align-middle container">
        <header>
            <h1 class="animation-slide-top"><?php
                if (isset($error_code))
                {
                    echo $error_code;
                }
                elseif (isset($_REQUEST['code']))
                {
                    echo encode_html($_REQUEST['code']);
                }
                else
                {
                    echo $this->status;
                }
                ?></h1>

            <i class="fa fa-warning"></i>
            <small>
                Error
                <?php
                if (isset($error_msg))
                {
                    echo $error_msg;
                }
                elseif (isset($_REQUEST['msg']))
                {
                    echo encode_html($_REQUEST['msg']);
                }
                else
                {
                    echo $this->msg;
                }
                ?>
            </small>
        </header>

        <div class="page-error-search centered  animated fadeInDown">
            <form class="form-half" action="<?=url('Product', 'lists')?>" method="get" enctype="application/x-www-form-urlencoded">
                <input type="text" class="form-control" placeholder="Search..." name="keywords" />
                <button type="submit" class="btn-unstyled">
                    <i class="linecons-search"><?=__('搜索')?></i>
                </button>
            </form>

            <!--            <a href="#" class="go-back">
                            <i class="fa fa-angle-left"></i>
                            Go Back
                        </a>-->
        </div>
    </div>
</div>

</body>
</html>