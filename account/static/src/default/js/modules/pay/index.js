$(function () {
    var tableObj = $('#consume-trade-table').DataTable({
        "language": {
          "lengthMenu": __('每页 _MENU_ 条记录'),
          "zeroRecords": __('没有找到记录'),
          "info": __('第 _PAGE_ 页 ( 总共 _PAGES_ 页 )'),
          "infoEmpty": __('无记录'),
          "infoFiltered": __('从 _MAX_ 条记录过滤'),
          "search": __('搜索'),

            /**
             * Pagination string used by DataTables for the built-in pagination
             * control types.
             *  @namespace
             *  @name DataTable.defaults.language.paginate
             */
             "paginate": {
                 "first": __('第一页'),
                 "last": __('最后一页'),
                 "next": __('下一页'),
                 "previous": __('上一页')
             }

        },
        "bFilter" : false,
        "bSort" : false,
        "bLengthChange": false,

        "processing": true,
        "serverSide": true,

        //请求url
        "sAjaxSource" : SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=consumeTrade&typ=json',
        //服务器端，数据回调处理
        "fnServerData" : function(sSource, aDataSet, fnCallback) {
            $.ajax({
                "dataType" : 'json',
                "type" : "post",
                "url" : sSource,
                "data" : aDataSet,
                "success" : function(resp){
                    var o = {};
                    o['data'] = resp.data.items;
                    o['recordsTotal'] = resp.data.records;
                    o['recordsFiltered'] = resp.data.records;

                    fnCallback(o);

                    //clear the table
                    tableObj.clear();
                }
            });
        },

        "columns": [
            //{"data": "consume_trade_id"},
            //{"data": "trade_title"},
            {"data": "order_id"},
            {
                "data": "trade_type_id",
                "render": function ( data, type, full, meta ) {
                    var r = {
                        "1201": __('购物'),
                        "1202": __('转账'),
                        "1203": __('充值'),
                        "1204": __('提现'),
                        "1205": __('销售'),
                        "1206": __('佣金')
                    };

                    var d = typeof r[data] == 'undefined' ? '' : r[data];

                    return '<span class="badge badge-dark">' + d + '</span>';
                }
            },
            {"data": "order_payment_amount"},
            //{"data": "trade_date"},
            {"data": "trade_create_time"},
            {
                "data": "trade_is_paid",
                "render": function ( data, type, full, meta ) {
                    var r = {
                        "3010": '<a href="' + SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=pay&typ=e&pay_sn=' + full.order_id + '"><span class="badge badge-danger">'__("未付款")'</span></a>',
                        "3011": '<a href="' + SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=pay&typ=e&pay_sn=' + full.order_id + '"><span class="badge badge-danger">'__("待付款审核")'</span></a>',
                        "3012": '<a href="' + SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=pay&typ=e&pay_sn=' + full.order_id + '"><span class="badge badge-danger">'__("部分付款")'</span></a>',
                        "3013": __('已付款')
                    };

                    //return '<span class="label label-danger">' + r[data] + '</span>';
                    return r[data];
                }
            }
            //{"data": "trade_pay_time"}
        ]
    });
});
