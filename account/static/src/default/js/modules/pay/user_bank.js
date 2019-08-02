$(function () {
    function loadWithdraw() {
        $('#J_userBankTable').DataTable({
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

            "sAjaxSource" : SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=userBank&typ=json',
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
                        o['recordsTotal'] = resp.data.total;
                        o['recordsFiltered'] = resp.data.records;
                        fnCallback(o);
                    }
                });
            },

            "columns": [
                {"data": "user_bank_id"},
                {"data": "bank_name"},
                {"data": "user_bank_card_code"},
                {"data": "user_id"},
                //{"data": function ( data, type, full, meta ) {
                //    var r = {
                //        "1": "已审核",
                //        "0": "未审核"
                //    };
                //
                //    var d = typeof r[data.withdraw_state] == 'undefined' ? '' : r[data.withdraw_state];
                //    return '<span class="badge badge-dark">' + d + '</span>';
                //}},
                {"data": function ( data, type, full, meta ) {
                    return '<a class="badge badge-dark remove" data-id="'+data.user_bank_id+'">删除</a>';
                }}
            ]
        });
    }
    loadWithdraw();

    $(document).on('click', '#addUserBank', function(e) {
        e.preventDefault();
        var that = $(this);
        var form = $('#userBank-form');
        $('#password').attr('type', 'password').val("");
        $('#withdraw_mobile').attr('type', 'number');
        form.stop().toggle('normal', function () {
            if (form.css('display') == 'none'){
                that.html(__('添加银行卡'));

            } else {
                that.html(__('点击关闭'));
            }
        });
    });

    function submitUserBank() {
        $('#bank_name').attr('value',$("#bank_id option:selected").text());
        var form_data = $('#userBank-form').serializeArray();
        $.request({
            type: "post",
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=addUserBank&typ=json',
            data:form_data,
            dataType: "json",
            success:function(result){
                if(result.status==200){
                    $('#userBank-form')[0].reset();
                    Public.tipMsg(result.msg);
                    window.location.href = SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=userBank';
                } else {
                    Public.tipMsg(result.msg);
                }
            }
        });
    }

    $(document).on('click', "#J_submit", function(e) {
        e.preventDefault();
        submitUserBank();
    });

    $(document).on('click', ".remove", function(e) {
        var id = $(this).data('id');
        $.ajax({
            type: "post",
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=removeUserBank&typ=json',
            data:{id:id},
            dataType: "json",
            success:function(result){
                if(result.status==200){
                    Public.tipMsg(result.msg);
                    window.location.href = SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=userBank';
                } else {
                    Public.tipMsg(result.msg);
                }
            }
        });
    });



});
