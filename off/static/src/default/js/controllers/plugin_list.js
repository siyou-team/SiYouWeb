$(function ()
{

    var gridData = {};

    var searchFlag = false;
    var filterClassCombo, userCombo;
    var handle = {
        //操作项格式化，适用于有“修改、删除”操作的表格
        operFormatter : function (val, opt, row)
        {
            var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-pencil" title="'+__('插件管理')+'">'+__('插件管理')+'</span></div>';


            return html_con;
            var html_con = '';
        },

        statusFmatter: function (val, opt, row, oper)
        {

            if (gridData[row.id].plugin_allow_disabled)
            {
                var text = val == 1 ? __('已启用') : __('已禁用');
                var cls = val == 1 ? 'ui-label-success' : 'ui-label-default';
                return '<span class="set-status ui-label ' + cls + '" data-enable="' + val + '" data-id="' + row.id + '">' + text + '</span>';
            }
            else
            {
                return __('已启用');
            }

        },

        //修改状态
        setStatus: function (id, is_enable)
        {
            if (!id)
            {
                return;
            }
            Public.ajaxPost(SYS.CONFIG.index_url + '?ctl=Config&met=setPluginState&typ=json', {
                plugin_id: id,
                enable: Number(is_enable)
            }, function (data)
            {
                if (data && data.status == 200)
                {
                    parent.Public.tips({content: __('状态修改成功！')});
                    $('#grid').jqGrid('setCell', id, 'plugin_state', is_enable);
                }
                else
                {
                    parent.Public.tips({type: 1, content: __('状态修改失败！') + data.msg});
                }
            });
        }
    };


    SYSTEM = system = parent.SYSTEM;

    function initDom()
    {
        var defaultPage = Public.getDefaultPage();
        defaultPage.SYSTEM = defaultPage.SYSTEM || {};
        defaultPage.SYSTEM.categoryInfo = defaultPage.SYSTEM.categoryInfo || {};

    };

    function initGrid()
    {
        var grid_row = Public.setGrid();
        var colModel = [{
            "name": "operate",
            "label": __("操作"),
            "width": 120,
            "classes": 'boostrap-dropmenu',
            "sortable": false,
            "search": false,
            "resizable": false,
            "frozen": true,
            "fixed": true,
            "hidden": false,
            "align": "center",
            "title": false,
            "formatter": handle.operFormatter
        }, {
            "name": "plugin_icon",
            "index": "plugin_icon",
            "label": __("插件图标"),
            "classes": "ui-ellipsis",
            "align": "left",
            "title": false,
            "fixed": true,
            "width": 45,
            "formatter": function (val, opt, row)
            {
                var html_con = '<img  width="35px" height="35px" src="' + sprintf('%s/images/plugins/%s.png', SYS.CONFIG.static_url, row.plugin_name) + '"  rel="' + val + '" />';
                return html_con;

            }
        }, {
            "name": "plugin_id",
            "index": "plugin_id",
            "label": __("插件Id"),
            "classes": "ui-ellipsis",
            "align": "left",
            "title": false,
            hidden: true
        }, {
            "name": "plugin_name",
            "index": "plugin_name",
            "label": __("插件名称"),
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "width": 150
        }, {
            "name": "plugin_desc",
            "index": "plugin_desc",
            "label": __("插件描述"),
            "classes": "ui-ellipsis",
            "align": "left",
            "width": 200,
            "title": false
        }, {
            "name": "plugin_state",
            "index": "plugin_state",
            "label": __("插件状态"),
            "classes": "ui-ellipsis",
            "align": "center",
            "fixed": true,
            "width": 140,
            "title": false, "formatter": handle.statusFmatter
        }];
        //colModelConfig.gridReg('grid', colModel);
        //colModel = colModelConfig.conf.grids['grid'].colModel;

        data = plugin_data;
        for (var i = 0; i < plugin_data.length; i++)
        {
            var item = plugin_data[i];
            gridData[item.plugin_id] = item;
        }

        $('#grid').jqGrid({
                data: plugin_data,
                datatype: 'local',
                autowidth: true,
                shrinkToFit: true,
                forceFit: true,
                width: grid_row.w,
                height: grid_row.h,
                altRows: true,
                gridview: true,
                onselectrow: false,
                multiselect: false, //多选
                colModel: colModel,
                viewrecords: true,
                cmTemplate: {
                    sortable: false
                },
                rowNum: 100,
                rowList: [100, 200, 500],
                localReader: {root: "data.items", records: "data.records", total: "data.total", repeatitems: !1, id: "plugin_id"},
                //scroll: 1,
                loadComplete: function (res)
                {
                    console.info(res);
                    var re_records = $("#grid").getGridParam('records');
                    if (re_records==0 || re_records==null)
                    {
                        $("#grid").parent().append("<div class=\"norecords\">"+__('没有符合数据')+"</div>");

                        $(".norecords").show();
                    }
                    else
                    {
                        //如果存在记录，则隐藏提示信息。
                        $(".norecords").hide();
                    }
                    /*+

                     var gridData = {};

                     for (var i = 0; i < plugin_data.length; i++)
                     {
                     gridData[plugin_data[i]['plugin_id']] = plugin_data[i];
                     }

                     $("#grid").data('gridData', gridData);
                     */
                },
                resizeStop: function (newwidth, index)
                {
                    //colModelConfig.setGridWidthByIndex(newwidth, index, 'grid');
                }
            }
        ).navGrid('#page', {
            edit: false,
            add: false,
            del: false,
            search: false,
            refresh: false
        }).navButtonAdd('#page', {
            caption: "",
            buttonicon: "ui-icon-config",
            onClickButton: function ()
            {
                //colModelConfig.config();
            },
            position: "last"
        });
    }

    function initEvent()
    {
        var match_con = $('#matchCon');
        //查询
        $('#search').on('click', function (e)
        {
            e.preventDefault();
            var skey = match_con.val() === '请输入查询内容' ? '' : $.trim(match_con.val());
            var begin_date = $.trim($('#begin_date').val());
            var end_date = $.trim($('#end_date').val());


            var user_id = userCombo ? userCombo.getValue() : -1;
            $("#grid").jqGrid('setGridParam', {
                page: 1,
                postData: {
                    skey: skey,
                    user_id: user_id,
                    begin_date: begin_date,
                    end_date: end_date,
                }
            }).trigger("reloadGrid");

        });



        //管理
        $('#grid').on('click', '.ui-icon-pencil', function (e)
        {
            e.stopPropagation();
            e.preventDefault();

            var id = $(this).data('id');


            alert('todo '+__('管理'));
        });


        //设置状态
        $('#grid').on('click', '.set-status', function (e)
        {
            e.stopPropagation();
            e.preventDefault();

            var id = $(this).data('id'),
                is_enable = Number(!$(this).data('enable'));
            handle.setStatus(id, is_enable);
        });

        //导入
        $('#grid').on('click', '.plugin-manage-index',function (e)
        {
            e.preventDefault();

            parent.$.dialog({
                width: 560,
                height: 300,
                title: __('批量导入'),
                content: 'url:/import.jsp',
                lock: true
            });
        });
    }

    //var colModelConfig = Public.colModelConfig.init('customerList');//页面配置初始化
    initDom();
    initGrid();
    initEvent();
})
;