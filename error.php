<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="renderer" content="webkit">
    <title>404 Page</title>
    
    <?php
    //request_string
    if (!function_exists("s"))
    {
        function s($key, $default = '')
        {
            $val = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
            
            return $val;
        }
    }
    $app_url = isset($app_url) ? $app_url : s('app_url', './account');
    ?>
    <style>.page-errors .page-error{height:90px}.page-error .error-mark{margin-bottom:33px}.page-error header .icon:before{margin-bottom:20px;font-size:120px}.page-error header h1{font-size:80px;color:#76838f; margin: 100px 0 0 0}.page-error header h3{margin-top:30px}.page-error header p{margin-bottom:30px;text-transform:uppercase}main.site-page .page-error .page-copyright{display:none}
        .page-error-search{
            padding: 20px;
        }


        input,select,textarea, button {
            height: 46px;
            resize: none;

            padding: 6px 12px;
        }


        .form-control {
            width: 200px;
            height: 34px;
            padding: 6px 12px;
            background-color: #fff;
            border: 1px solid #e4e4e4;
            border-radius: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
        }

        .form-control:focus {
            border-color: #ff6700;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255,103,0,.6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255,103,0,.6)
        }
    </style>
</head>
<body>

<div class="page page-full vertical-align text-center animation-fade page-error" style="text-align: center;">
    <div class="page-content vertical-align-middle container">
        <header>
            <h1 class="animation-slide-top"><?php
                if (isset($error_code))
                {
                    echo $error_code;
                }
                elseif (isset($_REQUEST['code']))
                {
                    echo htmlspecialchars($_REQUEST['code']);
                }
                {
                
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
                    echo htmlspecialchars($_REQUEST['msg']);
                }
                ?>
            </small>
        </header>

        <div class="page-error-search centered  animated fadeInDown">
            <form class="form-half" action="./index.php?ctl=Product&met=lists" method="get" enctype="application/x-www-form-urlencoded">
                <input type="text" class="form-control" placeholder="Search..." name="keywords" />
                <button type="submit" class="btn-unstyled">
                    <i class="linecons-search">搜索</i>
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
