<?php if (!defined('ROOT_PATH')){exit('No Permission');} ?>

<link rel="stylesheet" href="<?=$this->css('bootstrap-treeview', true)?>">
<script type="text/javascript" src="<?= $this->js('plugins/jquery-validate/jquery.validate', true) ?>"></script>

<div class="page-container">
    <div class="main-content">
        <div class="box-content-container">
            <form method="post" enctype="multipart/form-data" id="product-form" name="product-form"
                  class="form-horizontal" action="<?=$this->registry('url')?>?mdu=seller&ctl=Product_Base&met=manage&typ=json"  data-validator-option="{stopOnError:false, timely:false}">
                <span id="store_category_ids"></span>
                <input type="hidden"  name="store_category_ids"></input>


                <div class="form-group"  id="btn-sel-cat">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <a type="submit"
                           class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
                           id="submit-btn">
                            <i class="fa-pencil"></i>
                            <span><?=__('添加此分类下商品')?></span>
                        </a>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>
        </div>

    </div>
</div>


<script src="<?=$this->js('bootstrap-treeview', true)?>"></script>

<script>

    var $_form = $('#product-form');
    var $handle = {
        $form : $('#product-form'),
        initPopBtns : function (api, validator_opt)
        {
            this.$api = api;
            var $handle = this;
            var oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;


            var btn = "add" == oper ? [__("选择分类"), __("关闭")] : [__("确定"), __("取消")];


            if (api.config.ok)
            {

            }
            else
            {
                api.button({
                    id: "confirm", name: btn[0], focus: !0, callback: function ()
                    {
                        $handle.postData(validator_opt);
                        return $handle.cancleGridEdit(), $_form.trigger("validate"), !1;
                    }
                }, {id: "cancel", name: btn[1]})
            }
        },

        postData : function (validator_opt)
        {
            var api = this.$api;
            var oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

            var $grid = this.$grid;
            var $handle = this;
            var $_form = this.$form;

            var validator_opt = $.extend({
                ignore: ':hidden',
                theme: 'yellow_bottom',
                timely: 1,
                stopOnError: true,
                fields: {
                    //'keyword_find': 'required;'
                },
                valid: function (form)
                {
                    //加入input value
                    var arr = $('#store_category_ids').treeview('getSelected');

                    var ids = [];
                    $.each(arr , function (index, val)
                    {
                        ids.push(val.id);
                    });


                    if (ids.length > 0)
                    {

                    }
                    else
                    {
                        parent.parent.Public.tips({type: 1, content: __("请先选择商品分类")})
                        return;
                    }
                    
                    var me = this;
                    // 提交表单之前，hold住表单，防止重复提交
                    me.holdSubmit();

                    $.dialog.confirm(__("添加商品,是否继续？"), function ()
                    {
                            // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                            me.holdSubmit(false);

                            var url = SYS.CONFIG.index_url + '?mdu=seller&ctl=Product_Base&met=manage&typ=e&category_id=' + ids[0];
                            var title = __('添加商品');
                            var data = {};


                            parent.tab.addTabItem({
                                tabid: 'Product_Base-add',
                                text:title,
                                url: url
                            });

                            frameElement.api.close();
                        },
                        function ()
                        {
                            me.holdSubmit(false);
                        });
                },
            }, validator_opt);

            $_form.validator(validator_opt).on("click", "a.submit-btn", function (e)
            {
                $(e.delegateTarget).trigger("validate");
            });
        },

        cancleGridEdit : function ()
        {
            $handle = this;
        }
    }
    
    //manage
    if (frameElement && frameElement.api) {
        //var curRow, curCol, curArrears;
        var api = frameElement.api;

        $handle.initPopBtns(api, {
            fields: {},
        });

        //$handle.initField(api.data.rowData || {}).initState();

        $('#btn-sel-cat').hide();

    }
    else
    {
        $('#btn-sel-cat').show();
        
        $('#submit-btn').click(function ()
        {

            //加入input value
            var arr = $('#store_category_ids').treeview('getSelected');

            var ids = [];
            $.each(arr , function (index, val)
            {
                ids.push(val.id);
            });


            if (ids.length > 0)
            {

            }
            else
            {
                parent.Public.tips({type: 1, content: __("请先选择商品分类")})
                
                return
            }


            $.dialog.confirm(__("添加商品,是否继续？"), function ()
                {
                    var url = SYS.CONFIG.index_url + '?mdu=seller&ctl=Product_Base&met=manage&typ=e&category_id=' + ids[0];
                    var title = __('添加商品');
                    var data = {};

                    window.location.href = url;
                    /*
                    parent.tab.addTabItem({
                        tabid: 'Product_Base-add',
                        text:title,
                        url: url
                    });*/

                },
                function ()
                {
                }
            );
        })

    }
    
    
    Public.ajax({
        url : SYS.CONFIG.index_url + '?mdu=seller&ctl=Base_ProductCategory&met=treeview&typ=json', // 请求的URL
        dataType : 'json',
        cache : false,
        success : function(response) {
            if (response.status == 200) {
                if (response.data.items.length > 0)
                {

                    var options = {
                        bootstrap2: false,
                        showTags: true,
                        levels: 5,
                        data: response.data.items,
                        highlightSelected : true,// 选中项不高亮，避免和上述制定的颜色变化规则冲突
                        multiSelect : false,// 不允许多选，因为我们要通过check框来控制

                        onNodeSelected : function(event, node) {
                        },
                        onNodeUnchecked : function(event, node) {
                        }
                    };

                    $('#store_category_ids').treeview(options);

                    //$('#store_category_ids').data('treeview').collapseAll({ silent: true });
                    $('#store_category_ids').treeview('collapseAll', { silent: true });

                    $('#store_category_ids').on('nodeSelected', function(event, node) {

                        // 省级节点被选中，那么市级节点都要选中
                        if (node.nodes != null) {

                            $(this).treeview('toggleNodeExpanded', node.nodeId, { 
                                silent: true 
                            });
                            // parent.Public.tips({type: 1, content : __('只允许选择最后一级分类, 点击 + 可展开分类！')});

                            //$this.treeview('checkNode', node.nodeId, {
                            $(this).treeview('unselectNode', node.nodeId, {
                                silent : false
                            });
                        } else {
                            //加入input value
                            var arr = $('#store_category_ids').treeview('getSelected');

                            var ids = [];
                            $.each(arr , function (index, val)
                            {
                                ids.push(val.id);
                            });

                            $('input[name="' + $(this).prop('id') + '"]').val(ids);
                        }
                    });
                }
                else
                {
                    $('#store_category_ids').html('平台尚未初始化分类!');
                }
            }
        }
    });
</script>
