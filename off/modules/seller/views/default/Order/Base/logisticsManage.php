<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form class="form-inline box-main" role="form" method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="order_id" id="order_id"  placeholder="<?=__('订单Id')?>" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="stock_bill_id" id="stock_bill_id" value="" >

                <input type="hidden" class="input-text form-control" name="order_logistics_id" id="order_logistics_id" value="" >
                
                <p>如确认已经发货，请填写发货信息：</p>
                <div class="form-section col-sm-12">
                    <label class="input-label" for="logistics_time">发货日期</label>
                    <input type="text" class="input-text form-control datepicker" name="logistics_time" id="logistics_time" placeholder="<?=__('请选择日期')?>" >
                </div>

                <div class="form-section col-sm-12">
                    <span id="logistics_id"></span>
                </div>
                <div class="form-section col-sm-12">
                    <label class="input-label" for="order_tracking_number">物流单号</label>
                    <input type="text"  class="input-text form-control" name="order_tracking_number" id="order_tracking_number" placeholder="<?=__('请物流单号')?>" >
                </div>
                <div class="form-section col-sm-12">
                    <label class="input-label" for="logistics_explain">物流备注</label>
                    <input type="text"  class="input-text form-control" name="logistics_explain" id="logistics_explain" placeholder="<?=__('请物流备注')?>" >
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {

        var expressCombo = null;

        expressCombo = Business.categoryCombo($('#logistics_id'), {
            editable: false,
            extraListHtml: '',
            addOptions: {
                value: -1,
                text: '选择物流公司'
            },
            defaultSelected: ['logistics_id', -1],
            trigger: true,
            callback: {
                onFocus : null,
                onBlur: null,
                beforeChange: null,
                onChange: function (t)
                {
                },
                onExpand: null,
                onCollapse: null,
                onEnter:null,
                onListClick:null
            }
        }, 'store_logistics_id');

        setTimeout(function(){
            var store_logistics_lists = Public.getDefaultPage().SYSTEM.categoryInfo['store_logistics_id'];

            for (var i=0; i<store_logistics_lists.length; i++)
            {
                if (1 == store_logistics_lists[i].logistics_is_default)
                {
                    expressCombo.selectByValue( store_logistics_lists[i].logistics_id);
                    break;
                }
            }
        }, 1000);



        var offline = {
            $form:$('#manage-form'),

            //manage+++++++++++++++++++++++++++++
            initPopBtns : function (api, validator_opt)
            {
                this.$api = api;
                var $handle = this;
                var oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

                $_form = this.$form;

                var btn = "add" == oper ? [__("保存"), __("关闭")] : [__("确定"), __("取消")];


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
                    valid: function (form)
                    {
                        var me = this;
                        // 提交表单之前，hold住表单，防止重复提交
                        me.holdSubmit();

                        $.dialog.confirm(__("修改立马生效,是否继续？"), function ()
                            {
                                var n = "add" == oper ? __("新增") : __("修改");


                                var  params = $_form.serializeJSON();


                                if ($grid)
                                {
                                    $grid.jqGrid('saveCell', curRow, curCol);

                                    var por = $grid.jqGrid('getRowData');
                                    /*
                                     var default_search_rows = {'aaa':111};

                                     console.info(por);
                                     $.each(por,function(name, value){
                                     var array = {};
                                     array['default_search_label'] = value.default_search_label;
                                     array['default_search_words'] = value.default_search_words;
                                     //array['default_search_words_id']  = $(value.operate).data('id');
                                     default_search_rows[name] = array;
                                     });
                                     */

                                    params['items'] = por;
                                }

                                Public.ajaxPost(SYS.CONFIG.index_url + '?mdu=seller&ctl=Order_Base&met=saveOrderLogistics&typ=json', params, function (resp)
                                {
                                    if (200 == resp.status)
                                    {
                                        resp.data['id'] = resp.data[$handle.$priKey];
                                        resp.data['operate'] = null;

                                        parent.parent.Public.tips({content: n + __("成功！")});
                                        //callback && "function" == typeof callback && callback(resp.data, oper, window)
                                        callback && "function" == typeof callback && callback(resp.data, oper, $handle, window)
                                    }
                                    else
                                    {
                                        parent.parent.Public.tips({type: 1, content: n + __("failure") + resp.msg})
                                    }

                                    // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                                    me.holdSubmit(false);
                                })
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
            }
        };

        //manage
        if (frameElement && frameElement.api) {
            //var curRow, curCol, curArrears;
            var api = frameElement.api;

            if (api.data.isFilter)
            {
                $opt = {
                    multiselect: true
                };

                $('#search_box').show()
            }
            else
            {
                $('#search_box').hide()
            }


            $('#order_id').val(frameElement.api.data.rowData.order_id);
            $('#stock_bill_id').val(frameElement.api.data.rowData.stock_bill_id);

            
            if ('add' == frameElement.api.data.oper)
            {
            
            }
            else
            {

                $('#order_logistics_id').val(frameElement.api.data.rowData.order_logistics_id);
                $('#logistics_explain').val(frameElement.api.data.rowData.logistics_explain);
                $('#logistics_number').val(frameElement.api.data.rowData.logistics_number);
                $('#logistics_time').val(frameElement.api.data.rowData.logistics_time);
                $('#logistics_name').val(frameElement.api.data.rowData.logistics_name);

                expressCombo.selectByValue(frameElement.api.data.rowData.logistics_id);
            }
      
            offline.initPopBtns(api, {});



            $(".box-main .form-section:has(label)").each(function(i, el)
            {
                var $this = $(el),
                    $label = $this.find('label'),
                    $input = $this.find('.form-control');

                $input.on('focus', function()
                {
                    $this.addClass('form-section-active');
                    $this.addClass('form-section-focus');
                });

                $input.on('keydown', function()
                {
                    $this.addClass('form-section-active');
                    $this.addClass('form-section-focus');
                });

                $input.on('blur', function()
                {
                    $this.removeClass('form-section-focus');

                    if(!$.trim($input.val()))
                    {
                        $this.removeClass('form-section-active');
                    }
                });

                $label.on('click', function()
                {
                    $input.focus();
                });

                if($.trim($input.val()))
                {
                    $this.addClass('form-section-active');
                }
            });
        }
    });
</script>
