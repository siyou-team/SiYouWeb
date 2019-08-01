jQuery(document).ready(function ($) {
    PointsManage.init();
});
var PointsManage = {
    isClearPoint: false,
    isCompleted: false,
	memInfo: Object,
	user_id: 0,
    init: function () 
	{
        var obj = this;
        obj.event();
    },
    event: function () 
	{
        var obj = this;
		
        //积分清零操作
        $("#btn-reset").on('click', function () 
		{
            obj.isClearPoint = false;
            if (obj.user_id == 0) {
                alertError(__("请选择要积分清零的会员"));
                return false;
            }
			
            Layer.confirm({ message: __('是否会员积分清零？') }).on(function (e) {
                if (!e) { return; }
                if (!obj.isClearPoint) {
                    obj.isClearPoint = true;
                    $(".layui-layer-shade").hide();
                    $(".layui-layer-dialog").hide();
                    obj.changePoints(3, 0);
                }
            });
        });

        $("#pointsForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                points: {
                    validators:
                        {
                            notEmpty: {
                                message: __("变动数额不能为空")
                            },
                            regexp: {
                                regexp: /^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$/,
                                message: __('请输入大于0的数字（小数点最多保留2位）')
                            }
                        }
                },
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            
			if (obj.user_id == 0) {
                alertError(__("请选择要变动积分的会员"));
                $("#pointsForm").data('bootstrapValidator').resetForm(true);//重置验证
                return;
            }
			
            var flag = 0;
            var data = $("#pointsForm").serializeObject();
            if ($('#points_add').is(':checked')) {
                if (data.points == "") {
                    alertError(__("请输入变动"));
                    return;
                }
                flag = 1;
            } else {
                if (data.points == "") {
                    alertError(__("请输入变动"));
                    return;
                }
                flag = 2;
            }
            $("#btn-confirm").attr("disabled", "disabled");
            obj.changePoints(flag, data.points);
        });
    },
    //处理积分变动
    changePoints: function (flag, points) {
        var obj = this;
        var isSubmit = true;
		
        if (flag == 2) 
		{
			var member_points = obj.memInfo.member_points;
			var user_account  = obj.memInfo.user_account;
            if (parseFloat(member_points) < parseFloat(points)) {
                alertError(__("积分变动失败！会员卡号") + user_account + __("的积分不足"));
                isSubmit = false;
            }
        }
        if (isSubmit) {
            var data = {};
            if (flag == 3) {
                data.remark = $("#clear_remark").val();
            }
            else {
                data.remark = $("#remark").val();
            }

            data.user_id = obj.user_id;
            data.flag = flag;
            data.points = points;
 
            $.ajax({
                url: SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=changePoint&typ=json',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data)
                {
                    if (data && data.status == 200)
                    {
                        alertMessage(__("积分变动成功"));
                        obj.refresh();
                    } else {
                        alertError(data.msg);
						obj.refresh();
                    }
					
                    if (flag == 3) {
                        obj.isClearPoint = false;
                    } else {
                        $("#btn-confirm").removeAttr("disabled");
                    }
                }, error: function () {
                    obj.isCompleted = true;
                    if (flag == 3) {
                        obj.isClearPoint = false;
                    } else {
                        $("#btn-confirm").removeAttr("disabled");
                    }
					obj.refresh();
                },
            });
        } else {
            $("#btn-confirm").removeAttr("disabled");
			obj.refresh();
        }
    },
    //刷新
    refresh: function () {
        var obj = this;
		
		$("#pointsForm")[0].reset();
        $("#pointsForm").data('bootstrapValidator').resetForm(true);
		obj.memInfo = Object;
		obj.user_id = 0;
		$("#memberKey").val('');
		MemberSelect.initMember();
    },
	//获取会员数据
	bindMemInfo: function(res){
		var obj = this;
		
		obj.memInfo = res.info;
		obj.user_id = res.info.user_id;
	}
}