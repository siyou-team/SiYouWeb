$(function () {
    $('#J_ecardTable').DataTable({
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
        "sAjaxSource" : SYS.CONFIG.index_url + '?mdu=pay&ctl=Card&met=eCart&typ=json',
        //服务器端，数据回调处理
        "fnServerData" : function(url, data, fnCallback) {
            $.ajax({
                "dataType" : 'json',
                "type" : "post",
                "url" : url,
                "data" : data,
                "success" : function(resp){
                    var o = {};
                    o['data'] = resp.data.items;
                    o['recordsTotal'] = resp.data.records;
                    o['recordsFiltered'] = resp.data.records;

                    fnCallback(o);
                }
            });
        },

        "columns": [
            //{"data": "consume_trade_id"},
            //{"data": "trade_title"},
            {"data": "card_code"},
            {"data": "user_recharge_card"},
            {"data": "card_history_time"},
            {"data": "card_history_remark"},
            //{"data": "trade_pay_time"}
        ]
    });
});
