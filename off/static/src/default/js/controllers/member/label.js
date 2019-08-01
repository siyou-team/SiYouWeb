$(function() {
    var $grid = $("#grid");
    var $form = $("#manage-form");
    var $handle = $.extend(handle, {

        initDom: function() 
		{
            return this;
        },
		
        initEvent: function() 
		{
            return this;
        },
		
        initField: function(data) 
		{
			
            if (rowData.id) 
			{
                $('#member_label_id').val(rowData.member_label_id);
                $('#member_label_name').val(rowData.member_label_name);
                $('#member_label_condition').val(rowData.member_label_condition);
                $('#member_label_color').val(rowData.member_label_color);
                
				//$('#member_label_type').val(rowData.member_label_type);
				$("input[name='member_label_type'][value='" + rowData.member_label_type + "']").click();
				$("#label-color").find("li[data-id='"+rowData.member_label_color+"']").addClass("selected").siblings().removeClass("selected");
 
                this.initState();
            }else{

                this.resetForm();
            }
 
            return this;
        },

        resetForm: function(t) 
		{
			$('#member_label_id').val();
            $('#member_label_name').val();
            $('#member_label_condition').val();
            $('#member_label_color').val();
 
			this.initState();

            return this;
        }
        ,operate: function(oper, row_id, w, h)  //修改、新增
		{
            if(oper == 'add' && !row_id)
            {
                var title = __('新增会员标签');
                var data = {
                    oper: oper,
                    rowData:{},
                    callback: this.callback.bind(this)
                };
                var met = 'manage';
            }
            else if (oper == 'edit')
            {
                var title = sprintf(__('修改会员标签 [%s]'), this.$grid.data('gridData')[row_id]['member_label_name']);
                var data = {
                    oper: oper,
                    rowId: row_id,
                    rowData: this.$grid.data('gridData')[row_id],
                    callback: this.callback.bind(this)
                };

                var met = 'manage';
            }
 
            $.dialog({
                title: title,
                content: 'url:' + this.$url.manage,
                data: data,
                width: 600,
                height: $(window).height() * 0.8,
                max: false,
                min: false,
                cache: false,
                lock: true
            });
        },
        callback: function(data, oper, dialogWin) {
			var gridData = $("#grid").data('gridData');
            if (!gridData) {
                gridData = {};
                $("#grid").data('gridData', gridData);
            }

            gridData[data.id] = data;
 
            if (oper == "edit" || oper == "close" ||  oper == "verify") 
			{
                $("#grid").jqGrid('setRowData', data.id, data);
                
                dialogWin.$api.close();
            } else {
                $("#grid").jqGrid('addRowData', data.id, data, 'first');
				dialogWin.$api.close();
            }
			
        },
		labelType: function (val, opt, row) 
		{
			var txt = '';
			switch(val)
			{
				case 1:  txt = __('累计消费超过');break;
				case 2:  txt = __('消费单价超过');break;
				case 3:  txt = __('累计消费次数超过');break;
				case 4:  txt = __('累计充值超过');break;
			}
			
			return txt;
		},
		color: function(val,opt,row)
		{
			var txt = '';
			return '<li style="background: '+val+';width:25px;height:25px;margin:0 auto;"></li>';
		}
    });

    var $col_model = [{
        "name": "operate",
        "label": __("操作"),
        "width": 80,
        "sortable": false,
        "search": false,
        "resizable": false,
        "frozen":true,
        "fixed": true,
        "align": "center",
        "title": false,
        "formatter": $handle.operFormatter
    },{
		"name": "member_label_name",
        "index": "member_label_name",
        "label": __("标签名称"),
        "classes": "ui-ellipsis",
        "align": "center",
        "title": false,
        "fixed": true,
        "width": 120,
        "frozen":true
	},{
		"name": "member_label_color",
        "index": "member_label_color",
        "label": __("标签颜色"),
        "classes": "ui-ellipsis",
        "align": "center",
        "title": false,
        "fixed": true,
        "width": 100,
        "frozen":true,
		'formatter':$handle.color
	},{
		"name": "member_label_type",
        "index": "member_label_type",
        "label": __("标签方案"),
        "classes": "ui-ellipsis",
        "align": "center",
        "title": false,
        "fixed": true,
        "width": 120,
        "frozen":true,
		"formatter": $handle.labelType
	},{
		"name": "member_label_condition",
        "index": "member_label_condition",
        "label": __("标签方案条件"),
        "classes": "ui-ellipsis",
        "align": "center",
        "title": false,
        "fixed": true,
        "width": 100,
        "frozen":true
	}];

    var $opt = {
        autowidth: true,
        shrinkToFit: false,
        forceFit: false
    };

    $handle.init($grid, $form, 'member_label_id', 'Member_Label', 'offline');

    if ($grid.length > 0) {
        $handle.initDom().initGrid($col_model, $opt).initGridEvent();
    }

    //manage
    if (frameElement && frameElement.api) {
        //var curRow, curCol, curArrears;
        var api = frameElement.api;
		var oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

        $handle.initPopBtns(api, {
            fields: {
                'member_number': 'required;'
            }
        });
		
        $handle.initField(api.data.rowData || {}).initState();
    }
});