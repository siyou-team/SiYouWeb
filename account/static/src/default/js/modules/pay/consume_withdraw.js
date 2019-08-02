$(function () {
    function loadWithdraw() {
        $('#J_withdrawTable').DataTable({
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

            "sAjaxSource" : SYS.CONFIG.index_url + '?mdu=pay&ctl=Index&met=consumeWithdraw&typ=json',
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
                //{"data": "consume_trade_id"},
                //{"data": "trade_title"},
                {"data": "withdraw_id"},
                {"data": "withdraw_amount"},
                {"data": "withdraw_time"},
                {"data": function ( data, type, full, meta ) {
                        var r = {
                            "1": __('已审核'),
                            "0": __('未审核')
                        };

                        var d = typeof r[data.withdraw_state] == 'undefined' ? '' : r[data.withdraw_state];
                        return '<span class="badge badge-dark">' + d + '</span>';
                    }},
                {"data": "withdraw_desc"}
                //{"data": "trade_pay_time"}
            ]
        });
    }
    loadWithdraw();
    $(document).on('click', '#J_addWithdraw', function(e) {
        e.preventDefault();
        var that = $(this);
        var form = $('#withdraw-form');
        $('#password').attr('type', 'password').val("");
        $('#withdraw_mobile').attr('type', 'number');
        form.stop().toggle('normal', function () {
            if (form.css('display') == 'none'){
                that.html('申请提现');

            } else {
                that.html(__('关闭申请'));
            }
        });
        /*if (form.hasClass('hide')){
            form.removeClass('hide');
            $(this).html('关闭申请');
        } else {
            form.addClass('hide');
            $(this).html('申请提现');
        }*/

    });

    function checkFormData(params)
    {
        for (var i in params) {
            if (params[i].name == "withdraw_amount") {
                if (parseFloat(params[i].value) >= parseFloat($('#user_money_amount').data("value"))) {
                    Public.tipMsg(__("提现金额超过余额！"));
                    return false;
                }
            }
        }
        return true;
    }

    function submitWithdraw() {
        var form_data = $('#withdraw-form').serializeArray();

        if (checkFormData(form_data)) {
            $.request({
                type: "post",

                url: SYS.URL.pay.consume_withdraw_add,

                data:form_data,

                dataType: "json",
                success:function(result){
                    if(result.status==200){
                        $('#withdraw-form')[0].reset();
                        Public.tipMsg(__('已提交提现申请！'));
                    }else{
                        if (!result.data.user_certification) {
                            Public.tipMsg(__('提现失败，请前往实名认证？'),function () {
                                window.location.href = SYS.URL.account.certificate;
                            });
                        } else {
                            Public.tipMsg(result.msg);
                        }
                    }
                }

            });
        }


    }
    $(document).on('click', "#J_submit", function(e) {

        e.preventDefault();
        submitWithdraw();
    });

    $(document).on('change', "#withdraw_bank", function(e) {
        var id = $(this).val();
        $.ajax({
            type: "post",
            url: SYS.CONFIG.account_url + '?mdu=pay&ctl=Index&met=getUserBank&typ=json',
            data:{id:id},
            dataType: "json",
            success:function(result){
                if(result.status==200){
                    $('#withdraw_account_no').val(result.data.user_bank_card_code);
                    $('#withdraw_account_name').val(result.data.user_bank_card_name);
                    $('#withdraw_mobile').val(result.data.user_bank_card_mobile);
                } else {
                    return;
                }
            }
        });
    });



});
