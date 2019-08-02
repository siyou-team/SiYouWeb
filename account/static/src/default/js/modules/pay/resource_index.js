$(function () {
    $('#J_balanceTable').DataTable({
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
        "sAjaxSource" : SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=consumeRecord&typ=json',
        //服务器端，数据回调处理
        "fnServerData" : function(url, data, fnCallback) {
            $.ajax({
                "dataType" : 'json',
                "type" : "post",
                "url" : url,
                "data" : {aDataSet:data, 'trade_type_id':window.get_trade_type_id},
                "success" : function(resp){
                    var o = {};
                    o['data'] = resp.data.items;
                    o['recordsTotal'] = resp.data.total;
                    o['recordsFiltered'] = resp.data.records;
                    fnCallback(o);
                }
            });
        },

        "columns": [
            //{"data": "consume_trade_id"},
            //{"data": "trade_title"},
            {"data": "record_money"},
            {
                "data": "trade_type_id",
                "render": function ( data, type, full, meta ) {
                    var r = {
                        "1201": __("购物"),
                        "1202": __("转账"),
                        "1203": __("充值"),
                        "1204": __("提现"),
                        "1205": __("销售"),
                        "1206": __("佣金"),
                        "1207": __("退款"),
                        "1208": __("退货"),
                        "1209": __("转账收款"),
                        "1210": __("佣金"),
                        "1211": __("分红"),
                        "1212": __("购买SP"),
                        "1213": __("销售SP")
                    };

                    var d = typeof r[data] == 'undefined' ? '' : r[data];

                    return '<span class="badge badge-dark">' + d + '</span>';
                }
            },
            {"data": "record_time"},
            {"data": "record_desc"}
            //{"data": "trade_pay_time"}
        ]
    });
});
