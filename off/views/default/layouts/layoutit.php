<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?=__('ibootstrap - Bootstrap可视化布局系统')?></title>
    <meta name="keywords" content="<?=__('bootstrap,ibootstrap,爱bootstrap,可视化,操作,布局')?>">
    <meta name="description" content="LayoutIt! 可拖放排序在线编辑的Bootstrap可视化布局系统">

    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/tt/branches/shop/static/src/default/css/reset.css"/>

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="./shop/static/src/common/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="./shop/static/src/common/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="./shop/static/src/common/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./shop/static/src/default/css/default.css"/>
    <link href="<?= $this->css('', true) ?>/layoutit.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./shop/static/src/default/css/option2.css"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?=$this->js('html5shiv', true)?>"></script>
    <![endif]-->
    <script type="text/javascript" src="<?= $this->js('', true) ?>/jquery-1.12.4.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
    <script type="text/javascript" src="./shop/static/src/common/js/common.js"></script>


    <script type="text/javascript" src="<?= $this->js('jquery-ui.min', true) ?>"></script>
    <script type="text/javascript" src="<?=$this->js('jquery.ui.touch-punch.min', true) ?>"></script>
    <script type="text/javascript" src="<?= $this->js('plugins/jquery.htmlClean', true) ?>"></script>
    <script type="text/javascript" src="<?= $this->js('ckeditor/ckeditor', true) ?>"></script>
    <script type="text/javascript" src="<?= $this->js('ckeditor/config', true) ?>"></script>


    <script type="text/javascript" src="<?= $this->js('layoutit', true) ?>"></script>
    <!--
    <script type="text/javascript" src="<?= $this->js('', true) ?>/scripts.js"></script>
    <script type="text/javascript" src="<?= $this->js('', true) ?>/FileSaver.js"></script>
    <script type="text/javascript" src="<?= $this->js('', true) ?>/blob.js"></script>
    <script type="text/javascript" src="<?= $this->js('', true) ?>/docs.min.js"></script>
    -->
</head>

<body style="min-height: 824px;" class="edit home option2">


<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content" style="padding-top: 10px;">

        <div class="navbar navbar-inverse navbar-fixed-top navbar-layoutit">
            <div class="collapse navbar-collapse">

                <ul class="nav" id="menu-layoutit">
                    <li>
                        <div class="btn-group" data-toggle="buttons-radio">
                            <button type="button" id="edit" class="btn btn-xs btn-primary active"><i
                                        class="glyphicon glyphicon-edit "></i>
                                <?=__('编辑')?>
                            </button>
                            <button type="button" class="btn btn-xs btn-primary" id="devpreview">
                                <i class="glyphicon-eye-close glyphicon"></i>
                                <?=__('开发')?>
                            </button>
                            <button type="button" class="btn btn-xs btn-primary" id="sourcepreview">
                                <i class="glyphicon-eye-open glyphicon"></i>
                                <?=__('预览')?>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-primary" id="button-download-modal"
                                    data-target="#downloadModal"
                                    role="button" data-toggle="modal"><i class="glyphicon-chevron-down glyphicon"></i>
                                <?=__('下载')?>
                            </button>
                            <button class="btn btn-xs btn-primary" id="button-save-modal" role="button"
                                    data-toggle="modal" data-target="#saveModal"><i
                                        class="glyphicon-share glyphicon"></i>
                                <?=__('保存')?>
                            </button>
                            <button class="btn btn-xs btn-primary" href="#clear" id="clear">
                                <i class="glyphicon-trash glyphicon"></i>
                                <?=__('清空')?>
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-primary" href="#undo" id="undo"><i
                                            class="glyphicon-arrow-left glyphicon"></i><?=__('撤销')?>
                                </button>
                                <button class="btn btn-primary" href="#redo" id="redo"><i
                                            class="glyphicon-arrow-right glyphicon"></i><?=__('重做')?>
                                </button>
                            </div>
                        </div>

                        <!--
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-target="#downloadModal"
                                    rel="/build/downloadModal" role="button" data-toggle="modal"><i
                                        class="glyphicon-chevron-down glyphicon"></i>下载
                            </button>
                            <button class="btn btn-primary" role="button" data-toggle="modal"
                                    data-target="#saveModal"><i class="glyphicon-share glyphicon"></i>保存
                            </button>
                            
                            <button class="btn btn-primary" href="./index.php" role="button" data-toggle="modal"
                                    data-target="#saveModal"><i class="glyphicon-share glyphicon"></i>保存
                            </button>
                            
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-primary" href="#undo" id="undo"><i
                                        class="glyphicon-arrow-left glyphicon"></i>撤销
                            </button>
                            <button class="btn btn-primary" href="#redo" id="redo"><i
                                        class="glyphicon-arrow-right glyphicon"></i>重做
                            </button>
                        </div>-->
                    </li>
                </ul>
            </div>
            <!--/.navbar-collapse -->
        </div>
        <!--/.navbar-fixed-top -->

        <div class="container">
            <div class="row">
                <div class="">
                    <div class="sidebar-nav">

                        <ul class="nav nav-list accordion-group">
                            <li class="nav-header">
                                <div class="pull-right popover-info">
                                    <i class="glyphicon glyphicon-question-sign"></i>

                                    <div class="popover fade right">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title"><?=__('帮助')?></h3>

                                        <div class="popover-content">
                                            <?=__('在这里设置你的栅格布局, 栅格总数默认为12, 用空格分割每列的栅格值, 如果您需要了解更多信息，请访问')?>
                                            <a href="http://v3.bootcss.com/css/#grid"><?=__('BOOTSTRAP栅格系统')?>.</a>
                                        </div>
                                    </div>
                                </div>
                                <i class="glyphicon-plus glyphicon"></i>
                                <?=__('布局设置')?>
                            </li>
                            <li class="rows" id="estRows">

                                <div class="lyrow ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon-remove glyphicon"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                                    <div class="preview">
                                        <input value="12" class="form-control" type="text"></div>
                                    <div class="view">
                                        <div class="row clearfix">
                                            <div class="col-md-12 column"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lyrow ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon-remove glyphicon"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                                    <div class="preview">
                                        <input value="6 6" class="form-control" type="text"></div>
                                    <div class="view">
                                        <div class="row clearfix">
                                            <div class="col-md-6 column"></div>
                                            <div class="col-md-6 column"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lyrow ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon-remove glyphicon"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                                    <div class="preview">
                                        <input value="8 4" class="form-control" type="text"></div>
                                    <div class="view">
                                        <div class="row clearfix">
                                            <div class="col-md-8 column"></div>
                                            <div class="col-md-4 column"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lyrow ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon-remove glyphicon"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                                    <div class="preview">
                                        <input value="4 4 4" class="form-control" type="text"></div>
                                    <div class="view">
                                        <div class="row clearfix">
                                            <div class="col-md-4 column"></div>
                                            <div class="col-md-4 column"></div>
                                            <div class="col-md-4 column"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lyrow ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon-remove glyphicon"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                                    <div class="preview">
                                        <input value="2 6 4" class="form-control" type="text"></div>
                                    <div class="view">
                                        <div class="row clearfix">
                                            <div class="col-md-2 column"></div>
                                            <div class="col-md-6 column"></div>
                                            <div class="col-md-4 column"></div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>


                        <ul class="nav nav-list accordion-group">
                            <li class="nav-header">
                                <i class="glyphicon glyphicon-plus"></i>
                                JavaScript
                                <div class="pull-right popover-info">
                                    <i class="glyphicon glyphicon-question-sign "></i>

                                    <div class="popover fade right">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title"><?=__('帮助')?></h3>

                                        <div class="popover-content">
                                            <?=__('将组件元素拖放入你需要放入的栅格列中。之后，你可以设置该javascript组件的样式。如果你需要了解更多内容，请访问')?>
                                            <a target="_blank" href="http://v3.bootcss.com/javascript/">JavaScript.</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="boxes mute" id="elmJS">
                                <div class="box box-element ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('拖动')?>
                                    </span>

                                    <div class="preview"><?=__('遮罩窗体')?></div>
                                    <div class="view">
                                        <!-- Button to trigger modal -->
                                        <a id="myModalLink" href="#myModalContainer" role="button" class="btn"
                                           data-toggle="modal"><?=__('触发遮罩窗体')?></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModalContainer" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel"
                                                            contenteditable="true"><?=__('标题')?></h4>
                                                    </div>
                                                    <div class="modal-body" contenteditable="true"><?=__('内容')?>...</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal" contenteditable="true"><?=__('关闭')?>
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                                contenteditable="true"><?=__('保存')?>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                    </div>
                                </div>
                                <div class="box box-element ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('拖动')?>
                                    </span>
                                    <span class="configuration">
                                        <span class="btn-group btn-group-xs">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                                              <?=__('位置')?>
                                              <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                              <li class="active">
                                                <a href="#" rel=""><?=__('默认')?></a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="navbar-static-top"><?=__('头部')?></a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="navbar-fixed-top"><?=__('固定在头部')?></a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="navbar-fixed-bottom"><?=__('固定在底部')?></a>
                                              </li>
                                            </ul>
                                        </span>
                                        <a class="btn btn-xs btn-default" href="#" rel="navbar-inverse"><?=__('反转')?></a>
                                                <!--a class="btn btn-xs btn-default" href="#" rel="navbar-static-top">Static top</a>
                                            <a class="btn btn-mini" href="#" rel="navbar-fixed-top">Navbar fixed top</a>
                                            <a class="btn btn-mini" href="#" rel="navbar-fixed-bottom">Navbar fixed bottom</a-->
                                    </span>

                                    <div class="preview"><?=__('导航栏')?></div>
                                    <div class="view">

                                        <nav class="navbar navbar-default" role="navigation">
                                            <!-- Brand and toggle get grouped for better mobile display -->
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                                        data-target="#bs-example-navbar-collapse-1">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                                <a class="navbar-brand" href="#">Brand</a>
                                            </div>

                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                <ul class="nav navbar-nav">
                                                    <li class="active">
                                                        <a href="#">Link</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Link</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            Dropdown <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="#">Action</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Another action</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Something else here</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="#">Separated link</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="#">One more separated link</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <form class="navbar-form navbar-left" role="search">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Search" type="text">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </form>
                                                <ul class="nav navbar-nav navbar-right">
                                                    <li>
                                                        <a href="#">Link</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            Dropdown
                                                            <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="#">Action</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Another action</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Something else here</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <a href="#">Separated link</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.navbar-collapse -->
                                        </nav>

                                    </div>
                                </div>
                                <div class="box box-element ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('拖动')?>
                                    </span>
                                    <span class="configuration"></span>

                                    <div class="preview"><?=__('选项卡')?></div>
                                    <div class="view">
                                        <div class="tabbable" id="myTabs">
                                            <!-- Only required for left/right tabs -->
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab1" data-toggle="tab" contenteditable="true">Section
                                                        1</a>
                                                </li>
                                                <li>
                                                    <a href="#tab2" data-toggle="tab" contenteditable="true">Section
                                                        2</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <p contenteditable="true">I'm in Section 1.</p>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <p contenteditable="true">Howdy, I'm in Section 2.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-element ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('拖动')?>
                                    </span>


                                    <span class="configuration">
                                        <span class="btn-group btn-group-xs">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                                              <?=__('样式')?>
                                              <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                              <li class="">
                                                <a href="#" rel="alert-success">Success</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-info">Info</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-warning">Warning</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-danger">Danger</a>
                                              </li>
                                            </ul>
                                        </span>
                                        
							            <button type="button" class="btn btn-xs btn-default" data-target="#editorModal"
                                                data-module_id="1" role="button" data-toggle="modal"><?=__('编辑')?></button>
						            </span>


                                    <div class="preview"><?=__('提示框')?></div>
                                    <div class="view">
                                        <div class="alert alert-success alert-dismissable" contenteditable="true">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <h4><?=__('注意')?>!</h4>
                                            <strong>Warning!</strong>
                                            Best check yo self, you're not looking too good.
                                            <a href="#" class="alert-link">alert link</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-element ui-draggable">
                                    <a href="#close" class="remove label label-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?=__('ibootstrap - Bootstrap可视化布局系统')?><?=__('删除')?>
                                    </a>
                                    <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('ibootstrap - Bootstrap可视化布局系统')?><?=__('拖动')?>
                                    </span>

                                    <span class="configuration">
							            <button type="button" class="btn btn-xs btn-default" data-target="#editorModal"
                                                data-module_id="1" role="button" data-toggle="modal"><?=__('编辑')?></button>
						            </span>
                                    <div class="preview"><?=__('手风琴切换')?></div>
                                    <div class="view">
                                        <div class="panel-group" id="myAccordion">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a class="panel-title" data-toggle="collapse"
                                                       data-parent="#myAccordion" href="#collapseOne"
                                                       contenteditable="true">Collapsible Group Item #1</a>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                    <div class="panel-body" contenteditable="true">Anim pariatur
                                                        cliche...
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a class="panel-title" data-toggle="collapse"
                                                       data-parent="#myAccordion" href="#collapseTwo"
                                                       contenteditable="true">Collapsible Group Item #2</a>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body" contenteditable="true">Anim pariatur
                                                        cliche...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                $module_rows = $data['module_rows'];
                                ?>
                                <?php foreach ($module_rows as $module_row): ?>
                                    <div class="box box-element ui-draggable">
                                        <a href="#close" class="remove label label-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                            <?=__('删除')?>
                                        </a>
                                        <span class="drag label label-default">
                                            <i class="glyphicon glyphicon-move"></i>
                                            <?=__('拖动')?>
                                        </span>
                                        <span class="configuration">
                                            <button type="button" class="btn btn-xs btn-default"
                                                    data-target="#editorCustomModal"
                                                    data-module_id="<?= $module_row['module_id'] ?>" role="button"
                                                    data-toggle="modal"><?=__('编辑')?></button>
                                        </span>

                                        <div class="preview"><?= $module_row['module_name'] ?></div>
                                        <div class="view">
                                            <?= $module_row['module_tpl'] ?>
                                        </div>
                                    </div>
                                <?php
                                $module_js_row = explode(',', $module_row['module_js']);
                                
                                foreach ($module_js_row
                                
                                as $module_js):
                                ?>
                                    <script src="<?= $module_js ?>"></script>
                                    <?php
                                endforeach;
                                    ?>
                                <?php endforeach; ?>
                            </li>
                        </ul>

                    </div>
                </div>

                <div style="min-height: 763px;" class="demo ui-sortable changeDimension">

                    <div class="lyrow ui-draggable" style="display: block;">
                        <a href="#close" class="remove label label-danger">
                            <i class="glyphicon-remove glyphicon"></i>
                            <?=__('删除')?>
                        </a>
                        <span class="drag label label-default">
								<i class="glyphicon glyphicon-move"></i>
								<?=__('拖动')?>
							</span>

                        <div class="preview">
                            <input value="12" class="form-control" type="text"></div>
                        <div class="view">
                            <div class="row clearfix">
                                <div class="col-md-12 column ui-sortable"><div class="box box-element ui-draggable" style="display: block;">
                                        <a href="#close" class="remove label label-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                            <?=__('删除')?>
                                        </a>
                                        <span class="drag label label-default">
                                        <i class="glyphicon glyphicon-move"></i>
                                        <?=__('拖动')?>
                                    </span>


                                        <span class="configuration">
                                        <span class="btn-group btn-group-xs">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                                              <?=__('样式')?>
                                              <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                              <li class="">
                                                <a href="#" rel="alert-success">Success</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-info">Info</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-warning">Warning</a>
                                              </li>
                                              <li class="">
                                                <a href="#" rel="alert-danger">Danger</a>
                                              </li>
                                            </ul>
                                        </span>
                                        
							            <button type="button" class="btn btn-xs btn-default" data-target="#editorModal" data-module_id="1" role="button" data-toggle="modal"><?=__('编辑')?></button>
						            </span>


                                        <div class="preview"><?=__('提示框')?></div>
                                        <div class="view">
                                            <div class="alert alert-success alert-dismissable cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="<?=__('所见即所得编辑器, editor2')?>" title="<?=__('所见即所得编辑器')?>, editor2" aria-describedby="cke_174" style="position: relative;"><p>×</p><p><?=__('注意')?>!</p><p><strong>Warning!</strong> Best check yo self, you're not looking too good. <a data-cke-saved-href="#" href="#">alert link</a></p></div>
                                            <div>fdasfdasfdsfdsaf</div>
                                        </div>
                                    </div></div>
                            </div>
                        </div>
                    </div></div>
                <!--/span-->
                <div id="download-layout">
                    <div class="container">
                    </div>
                </div>
            </div>
            <!--/row-->

            <script type="text/javascript">
                $(document).ready(function () {
                    // alert($('#download-layout').html());
                });
            </script>
        </div>
        <!--/.fluid-container-->
    </div>
</div>


<script type="text/javascript">


</script>

<div style="display: none;" class="modal fade" id="downloadModal" tabindex="-1" role="dialog"
     aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('下载')?></h4>
            </div>
            <div class="modal-body">

                <div id="download-logged" class="">
                    <div class="alert alert-info"><?=__('已在下面生成干净的HTML, 可以复制粘贴代码到你的body内')?><br>
                        <?=__('请使用bootstrap3.0.1,可在这里下载')?> <a target="_blank" href="http://www.bootcdn.cn/bootstrap/">http://www.bootcdn.cn/bootstrap</a>
                    </div>
                    <p>
                        <textarea></textarea>
                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=__('关闭')?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <script type="text/javascript">
        downloadLayoutSrc();
    </script>

</div>

<div style="display: none;" class="modal fade" id="editorModal" tabindex="-2" role="dialog"
     aria-labelledby="editorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Save your Layout</h4>
            </div>
            <div class="modal-body">
                <p>
                    <textarea id="contenteditor"></textarea>
                </p>
            </div>
            <div class="modal-footer">
                <a rel="nofollow" id="savecontent" class="btn btn-primary" data-dismiss="modal">Save</a> <a
                        rel="nofollow" class="btn" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div style="display: none;" class="modal fade" id="editorCustomModal" tabindex="-2" role="dialog"
     aria-labelledby="editorCustomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('编辑模块内容')?></h4>
            </div>
            <div class="modal-body" id="custom-module-body">
                <p>
                    <?=__('自定义编辑')?>
                </p>
            </div>
            <div class="modal-footer">
                <a rel="nofollow" id="saveCustomContent" class="btn btn-primary" data-dismiss="modal">Save</a> <a
                        rel="nofollow" class="btn" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div style="display: none;" class="modal fade" role="dialog" id="saveModal" aria-labelledby="saveModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('保存')?></h4>
            </div>
            <div class="modal-body">
                <?=__('保存成功')?>
            </div>
            <div class="modal-footer">
                <a rel="nofollow" class="btn" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
     aria-hidden="true"></div>
<div style="display: none;" class="modal fade" id="feedbackModal" tabindex="-1" role="dialog"
     aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('联系我们')?></h4>
            </div>
            <div class="modal-body">

                <div id="download-logged" class="">
                    <div class="alert alert-info">
                        Github:
                        <a href="https://github.com/savokiss/layoutit">https://github.com/savokiss/layoutit</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function resizeCanvas(size)
    {

        var containerID = document.getElementsByClassName("changeDimension");
        var containerDownload = document.getElementById("download-layout").getElementsByClassName("container-fluid")[0];
        var row = document.getElementsByClassName("demo ui-sortable");
        var container1 = document.getElementsByClassName("container1");
        if (size == "md")
        {
            $(containerID).width('id', "MD");
            $(row).attr('id', "MD");
            $(container1).attr('id', "MD");
            $(containerDownload).attr('id', "MD");
        }
        if (size == "lg")
        {
            $(containerID).attr('id', "LG");
            $(row).attr('id', "LG");
            $(container1).attr('id', "LG");
            $(containerDownload).attr('id', "LG");
        }
        if (size == "sm")
        {
            $(containerID).attr('id', "SM");
            $(row).attr('id', "SM");
            $(container1).attr('id', "SM");
            $(containerDownload).attr('id', "SM");
        }
        if (size == "xs")
        {
            $(containerID).attr('id', "XS");
            $(row).attr('id', "XS");
            $(container1).attr('id', "XS");
            $(containerDownload).attr('id', "XS");

        }


    }


    $.common = {
        initEvent: function ($dom) {
            if ($('.parallax', $dom).length > 0)
            {
                $('.parallax', $dom).each(function () {
                    $(this).parallax("50%", 0.1);
                })
            }


            /** OWL CAROUSEL**/
            $(".owl-carousel", $dom).each(function (index, el) {
                var config = $(this).data();
                config.navText = ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'];
                config.smartSpeed = "300";
                if ($(this).hasClass('owl-style2'))
                {
                    config.animateOut = "fadeOut";
                    config.animateIn = "fadeIn";
                }
                $(this).owlCarousel(config);
            });

            $(".owl-carousel-vertical", $dom).each(function (index, el) {
                var config = $(this).data();
                config.navText = ['<span class="icon-up"></spam>', '<span class="icon-down"></span>'];
                config.smartSpeed = "900";
                config.animateOut = "";
                config.animateIn = "fadeInUp";
                $(this).owlCarousel(config);
            });


            /** HOME SLIDE**/
            if ($('.home-slider', $dom).length > 0 && $('#contenhomeslider', $dom).length > 0)
            {
                var slider = $('#contenhomeslider', $dom).bxSlider(
                    {
                        nextText: '<i class="fa fa-angle-right"></i>',
                        prevText: '<i class="fa fa-angle-left"></i>',
                        auto: true,
                    }
                );
            }

            /** Custom page sider**/
            if ($('.home-slider', $dom).length > 0 && $('#contenhomeslider-customPage', $dom).length > 0)
            {
                var slider = $('#contenhomeslider-customPage', $dom).bxSlider(
                    {
                        nextText: '<i class="fa fa-angle-right"></i>',
                        prevText: '<i class="fa fa-angle-left"></i>',
                        auto: true,
                        pagerCustom: '#bx-pager',
                        nextSelector: '#bx-next',
                        prevSelector: '#bx-prev',
                    }
                );
            }

            if ($('.home-slider', $dom).length > 0 && $('#slide-background', $dom).length > 0)
            {
                var slider = $('#slide-background', $dom).bxSlider(
                    {
                        nextText: '<i class="fa fa-angle-right"></i>',
                        prevText: '<i class="fa fa-angle-left"></i>',
                        auto: true,
                        onSlideNext: function ($slideElement, oldIndex, newIndex) {
                            var corlor = $($slideElement).data('background');
                            $('.home-slider').css('background', corlor);
                        },
                        onSlidePrev: function ($slideElement, oldIndex, newIndex) {
                            var corlor = $($slideElement).data('background');
                            $('.home-slider').css('background', corlor);
                        }
                    }
                );
                //slider.goToNextSlide();
            }

            // CATEGORY FILTER
            $('.slider-range-price', $dom).each(function () {
                var min = $(this).data('min');
                var max = $(this).data('max');
                var unit = $(this).data('unit');
                var value_min = $(this).data('value-min');
                var value_max = $(this).data('value-max');
                var label_reasult = $(this).data('label-reasult');
                var t = $(this);

                $(this).slider({
                    range: true,
                    min: min,
                    max: max,
                    values: [value_min, value_max],
                    slide: function (event, ui) {
                        var result = label_reasult + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                        console.log(t);
                        t.closest('.slider-range').find('.amount-range-price').html(result);
                    }
                });
            })


            //商品详情页面
            // OWL Product thumb
            $dom.find('.product-img-thumb .owl-carousel').owlCarousel(
                {
                    dots: false,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    margin: 21,
                    responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 2,
                        },
                        // breakpoint from 480 up
                        480: {
                            items: 2,
                        },
                        // breakpoint from 768 up
                        768: {
                            items: 2,
                        },
                        1000: {
                            items: 3,
                        }
                    }
                }
            );
        }
    };

    $(function () {
        $.common.initEvent($('.demo'));
    })

</script>

</body>
</html>