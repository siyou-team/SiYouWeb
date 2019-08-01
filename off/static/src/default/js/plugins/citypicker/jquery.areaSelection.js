/**
 *标题：双向选择地区组件
 */
;(function($,window){
    "use strict";
    var AreaSelection=function(obj,option){
        var _this = this;
        this.defaults = {
            areaid:[[1,1,1]],
            allareaid:null,   //[]
            arealibrary:_this.areaLibrary,
            css:'',	//追加css
            areaSelection:'areaSelection',	//满屏背景元素样式名称
            abox:'abox',					//地址弹窗样式名称
            acontbox:'acontbox',					//地址内容元素样式名称
            isScroll:true,					//是否阻止滚动
            fnCloseBack:function(){},				//回调函数
            fnYesBack:function(){},			//回调函数
            AreaFinal:null					//判断地区数据是否处理过
        };
        this.init(option);
    };
    AreaSelection.prototype={
        constructor:AreaSelection,
        init:function(option){
            var _this =this;
            if(typeof option=='object'){
                //this.defaults=$.extend(this.defaults,option);	//扩展值，与$.extend(false，{}，this.defaults,option)一样
                _this.defaults=$.extend(false,{},_this.defaults,option);
                //地区id
                if(!_this.defaults.areaid){		//防止穿空值，失效，用了默认顶部值，记得查看原因
                    _this.defaults.areaid = [[1,1,1]];
                }else if(typeof(this.defaults.areaid) != "object"){

                    if($.dialog){
                        $.dialog.tips("请传入正确数组",2,"error.gif");
                    }else{
                        alert("请传入正确数组");
                    }
                }
                _this.areaid = _this.defaults.areaid;
            };

            //
            _this.enableDistrict = false;//是否启用三级区域


            _this.areabg = _this.creatAreaSelection();//最外层
            _this.abox = _this.areabg.find('.'+_this.defaults.abox);
            _this.acontbox = _this.abox.find('.'+_this.defaults.acontbox);

            _this.closeBtn = _this.abox.find('.btn-cancle');	//关闭按钮
            _this.OkBtn = _this.abox.find('.btn-ok');	//确定按钮
            _this.sAreaAdd = _this.abox.find('#sAreaAdd');		//中间添加按钮
            _this.DeleteBtn = _this.abox.find('.sIcon-btn-delete')	//删除按钮
            /*会监听失效的按钮，DOM加载后在加？SETHTML后如何判断dom加载*/
            _this.sIconBtn = _this.abox.find('.sIcon-btn');	//折叠条按钮
            _this.provincebtn = _this.abox.find('.provincename');	//省按钮
            _this.citybtn = _this.abox.find('.cityName');	//市按钮

            /*两个列表*/
            _this.provinceLeftList = _this.abox.find('.provinceLeftList');
            _this.provinceRightList = _this.abox.find('.provinceRightList');

            //调用事件
            _this.show();
            _this.clickEvent();

            //阻止页面滚动，有bug
            // _this.defaults.isScroll?_this.areabg.on('DOMMouseScroll mousewheel',function(e){
            // 	e = e || window.e;
            //  			e.stopPropagation();
            //  			return false;
            // }):false;
            // _this.defaults.isScroll?_this.abox.on('DOMMouseScroll mousewheel',function(e){
            // 	e = e || window.e;
            //  			e.stopPropagation();
            //  			return true;
            // }):false;
            _this.defaults.isScroll?_this.areabg.on('DOMMouseScroll mousewheel',function(e){
                $(document.body).css({
                    "overflow-x":"hidden",
                    "overflow-y":"hidden"
                });
            }):false;
        },
        //创建视图结构
        creatAreaSelection:function(){
            var _this =this;
            var html=
                '<div class="'+_this.defaults.areaSelection+' '+_this.defaults.css+'">'+
                '<div class="'+_this.defaults.abox+'">'+
                '<i class="btn-cancle sIcon sIcon_Close"></i>'+
                '<div class="'+_this.defaults.acontbox+' clearfix">'+
                '<div class="sarea-left">'+
                '<h3 class="s-title">'+
                '可选地区'+
                '</h3>'+
                '<ul class="provinceList provinceLeftList">'+
                _this.setHtml(false)+
                '</ul>'+
                '</div>'+
                '<div class="sarea-mid">'+
                '<span class="sarea-mid-inside">'+
                '<button class="sAreaAdd" id="sAreaAdd">添<br>加</button>'+
                '</span>'+
                '</div>'+
                '<div class="sarea-right">'+
                '<h3 class="s-title">'+
                '已选地区'+
                '</h3>'+
                '<ul class="provinceList provinceRightList">'+
                _this.setHtml(true)+
                '</ul>'+
                '</div>'+
                '</div>'+
                '<div class="sBtnbox">'+
                '<button class="btn-ok css-ok">确定</button>'+
                '<button class="btn-cancle css-cancle">取消</button>'+
                '</div>'+
                '</div>'+
                '</div>';
            return $(html);
        },
        clickEvent:function(){
            var _this=this;
            //关闭按钮
            _this.closeBtn.on('click',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                _this.close();
            });
            //确定按钮
            _this.OkBtn.on('click',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                _this.yes();
            });
            //中间添加按钮
            _this.sAreaAdd.on('click',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                _this.addEvent();
            });

            //折叠按钮
            _this.sIconBtn.on('click',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                var _obj = $(this);
                _obj.find(".sIcon").toggleClass('sIcon_add').toggleClass('sIcon_minus');
                _obj.parent().next(".cityList").toggleClass("dn");

                //如果为province
                if (_obj.parent().next(".cityList").length > 0)
                {
                    _obj.parent().next(".cityList").find("li:first").find(".sIcon").toggleClass('sIcon_add').toggleClass('sIcon_minus');

                    _obj.parent().next(".cityList").find("li>ul:first").toggleClass("dn");
                }
                else
                {
                    _obj.parent().next(".districtList").toggleClass("dn");
                }
            });
            //删除按钮
            _this.DeleteBtn.on('click',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                var _obj = $(this);
                _this.deleteEvent(_obj)
            });

            //按省，只有左侧
            _this.provinceLeftList.on('click','.provincename',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                var _obj = $(this);
                _obj.toggleClass('one-active');
                //判断是否全选城市
                if(_obj.hasClass('one-active')){
                    var oNext = _obj.next(".cityList")
                    oNext.find(".cityName").addClass("one-active");
                    //oNext.find(".cityName.OtherSelect").removeClass("one-active");//移除其余行的选中状态

                    //地区
                    oNext.find(".districtName").addClass("one-active");
                }else{
                    _obj.next(".cityList").find(".cityName").removeClass("one-active");
                    _obj.next(".cityList").find(".districtName").removeClass("one-active");
                }
            });

            //按市，只有左侧
            _this.provinceLeftList.on('click','.cityName',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                var _obj = $(this);
                var _oProvince = _obj.parents(".provinceLi");
                _obj.toggleClass('one-active');
                _oProvince.find(".provincename").addClass("one-active");

                //判断是否删除省的选中状态
                if(!_oProvince.find(".cityName.noSelect").hasClass('one-active')){
                    _oProvince.find(".provincename").removeClass("one-active");
                }

                //
                //判断是否全选地区
                if(_obj.hasClass('one-active')){
                    var oNext = _obj.next(".districtList")
                    oNext.find(".districtName").addClass("one-active");
                    //oNext.find(".cityName.OtherSelect").removeClass("one-active");//移除其余行的选中状态

                }else{
                    _obj.next(".districtList").find(".districtName").removeClass("one-active");
                }
            });


            //按区，只有左侧
            _this.provinceLeftList.on('click','.districtName',function(e){
                e= e || window.event;
                e.stopPropagation();    //阻止冒泡事件
                var _obj = $(this);
                var _oCity = _obj.parents(".cityLi");
                _obj.toggleClass('one-active');

                _oCity.find(".cityName").addClass("one-active");

                if(!_oCity.find(".districtName.noSelect").hasClass('one-active')){
                    _obj.parent().prev(".cityName").removeClass("one-active");
                }

                //处理省
                var _oProvince = _oCity.parents(".provinceLi");
                _oProvince.find(".provincename").addClass("one-active");

                if(!_oProvince.find(".cityName.noSelect").hasClass('one-active')){
                    _oProvince.find(".provincename").removeClass("one-active");
                }

                // //判断是否删除省的选中状态
                // if(!_oProvince.find(".cityName.noSelect").hasClass('one-active')){
                //     _oCity.parent().prev(".provincename").removeClass("one-active");
                // }
            });
        },
        //显示
        show:function(){
            var _this = this;
            _this.areabg.appendTo('body');
            var abox=_this.abox;
            var w=abox.width();
            var h=abox.height();
            //设置样式
            abox.css({
                width:w,
                height:h+10,
            });
            //如果为0则是通用
            // if(_this.areaid[0][0] == 0){
            // 	var leftCity = _this.provinceLeftList.find(".cityName");
            // 	var leftProvinceLi = _this.provinceLeftList.find(".provinceLi");
            // 	leftCity.hide().removeClass("noSelect").addClass("AlreadySelect");//重复增加和删除，防止漏选;
            // 	leftProvinceLi.hide();

            // 	var rightCity = _this.provinceRightList.find(".cityName");
            // 	var rightProvinceLi = _this.provinceRightList.find(".provinceLi");
            // 	rightCity.show().removeClass("noSelect").addClass("AlreadySelect");//重复增加，防止漏选
            // 	rightProvinceLi.show();
            // }else{
            // 	_this.setLeftHtml();
            // 	_this.setRightHtml();
            // 	_this.setUsedData();
            // }
            _this.setLeftHtml();
            _this.setRightHtml();
            _this.setUsedData();
        },
        //关闭函数
        close:function(){
            var _this = this;


            $(document.body).css({
                "overflow-x":"auto",
                "overflow-y":"auto"
            });

            if(typeof _this.defaults.fnCloseBack == 'function') _this.defaults.fnCloseBack(_this.DataBack());	//回调
            _this.areabg.remove();
        },
        //确定函数
        yes:function(){
            var _this = this;

            $(document.body).css({
                "overflow-x":"auto",
                "overflow-y":"auto"
            });

            if(typeof _this.defaults.fnYesBack == 'function') _this.defaults.fnYesBack(_this.DataBack());	//回调
            _this.areabg.remove();
        },
        //删除重复数组
        uniqueArray:function(data){
            data = data || [];
            var a = {};
            for (var i=0; i<data.length; i++) {
                var v = data[i];
                if (typeof(a[v]) == 'undefined'){
                    a[v] = 1;
                }
            };
            data.length=0;
            for (var i in a){
                data[data.length] = i;
            }
            return data;
        },
        //返回的Data数据
        DataBack:function(){
            var _this = this;
            var Dareaid = _this.areaid;
            var oReturn = {};
            //如果未选，择返回[1,1,1]
            if(!_this.areaid.length){
                oReturn["id"] = [];
                oReturn["NameinJson"] = [];
                oReturn["idinJson"] = [];
                oReturn["id"][0] = [1,1,1];
                oReturn["NameinJson"][0] = {"citys":[1],"provinces":[1]}
                oReturn["idinJson"][0] = {"citys":[1],"provinces":[1]}
                return oReturn;
            }else if(_this.areaid[0][0] == 1){
                oReturn["id"] = [];
                oReturn["NameinJson"] = [];
                oReturn["idinJson"] = [];
                oReturn["id"][0] = [1,1,1];
                oReturn["NameinJson"][0] = {"citys":[1],"provinces":[1]}
                oReturn["idinJson"][0] = {"citys":[1],"provinces":[1]}
                return oReturn;
            }

            oReturn["id"] = _this.areaid;
            oReturn["NameinJson"] = [];
            oReturn["idinJson"] = [];
            var areaNeedData = _this.areaAllData();
            //var num = 0;
            // var j = 0;
            // var citynum = 0;
            //先取全部省数据

            var arrProv = [];
            for(var a in Dareaid){
                arrProv.push(Dareaid[a][0]);
            }
            arrProv = _this.uniqueArray(arrProv);//删除重复数据
            //获取省数据
            for(var a in arrProv){
                oReturn["idinJson"][a] = {};
                oReturn["idinJson"][a]["provinces"] = arrProv[a];
                oReturn["idinJson"][a]["citys"] = [];
                //取市数据
                for(var i in Dareaid){
                    if(Dareaid[i][0] == arrProv[a]){
                        oReturn["idinJson"][a]["citys"].push(Dareaid[i][1]);
                    }
                }
            }
            //防止通用bug
            if(oReturn["idinJson"][0]["provinces"] == 0 || oReturn["idinJson"][0]["provinces"] == 1){
                oReturn["NameinJson"][0] = {};
                oReturn["NameinJson"][0]["provinces"] = "通用";
                return oReturn;
            }
            //将id数据转换为名字
            for(var i =0;i < oReturn["idinJson"].length;i++){
                for(var j=0;i<areaNeedData.length;j++){
                    if(areaNeedData[j]["id"] == oReturn["idinJson"][i]["provinces"]){	//如果有省级单位匹配
                        oReturn["NameinJson"][i] = {};
                        oReturn["NameinJson"][i]["provinces"] = areaNeedData[j]["name"] ;
                        oReturn["NameinJson"][i]["citys"] = [];
                        for(var a = 0 ;a < oReturn["idinJson"][i]["citys"].length;a++){
                            for(var b = 0;b<areaNeedData[j]["citys"].length;b++){
                                if(areaNeedData[j]["citys"][b]["id"] == oReturn["idinJson"][i]["citys"][a]){
                                    oReturn["NameinJson"][i]["citys"].push(areaNeedData[j]["citys"][b]["name"]);
                                    break;
                                }
                            }
                        }
                        if(oReturn["NameinJson"][i]["citys"].length == areaNeedData[j]["citys"].length){
                            oReturn["NameinJson"][i]["ifAll"] = true;
                        }else{
                            oReturn["NameinJson"][i]["ifAll"] = false;
                        }
                        break;
                    }
                }

            };
            return oReturn;
        },
        //设置html
        setHtml:function(right){
            var _this = this;
            var areaNeedData = _this.areaAllData();
            var html = '';
            right = right?'style="display:none;"':"";
            var right_tmp = right?'':"";

            for(var i in areaNeedData){
                var innerhtml = '';
                var citys = areaNeedData[i]["citys"];
                for(var j in citys){

                    if (_this.enableDistrict)
                    {
                        //地区处理
                        var innerhtmlDistrict = '';
                        var districts = citys[j]["districts"];
                        for(var h in districts){
                            innerhtmlDistrict +=
                                '<li class="districtName noSelect" area-id="'+districts[h]["id"]+'"'+ right+'>'+
                                '<span class="s-name" title="'+districts[h]["name"]+'">'+districts[h]["name"]+'</span>'+
                                (right?'<span class="sIconBox sIcon-btn-delete"><i class="sIcon sIcon_delete"></i></span>':'')+
                                '</li>';
                        }


                        innerhtml +=
                            '<li class="cityLi" area-id="'+citys[j]["id"]+'"'+ right+'>'+
                            '<p class="cityName">'+
                            '<span class="sIconBox sIcon-btn s-name"><i class="sIcon sIcon_add"></i></span>'+
                            '<span class="s-name" title="'+citys[j]["name"]+'">'+citys[j]["name"]+'</span>'+
                            (right?'<span class="sIconBox sIcon-btn-delete"><i class="sIcon sIcon_delete"></i></span>':'')+
                            '</p>'+
                            '<ul class="districtList dn">'+
                            innerhtmlDistrict+
                            '</ul>'+
                            '</li>';

                    }
                    else
                    {
                        innerhtml +=
                        '<li class="cityName noSelect" area-id="'+citys[j]["id"]+'"'+ right+'>'+
                        '<span class="s-name" title="'+citys[j]["name"]+'">'+citys[j]["name"]+'</span>'+
                        (right?'<span class="sIconBox sIcon-btn-delete"><i class="sIcon sIcon_delete"></i></span>':'')+
                        '</li>';
                    }
                }
                html +=
                    '<li class="provinceLi"'+ right+' area-id="'+areaNeedData[i]["id"]+'">'+
                    '<p class="provincename">'+
                    '<span class="sIconBox sIcon-btn"><i class="sIcon sIcon_add"></i></span>'+
                    '<span class="s-name">'+areaNeedData[i]["name"]+'</span>'+
                    (right?'<span class="sIconBox sIcon-btn-delete"><i class="sIcon sIcon_delete"></i></span>':'')+
                    '</p>'+
                    '<ul class="cityList dn">'+
                    innerhtml+
                    '</ul>'+
                    '</li>';
            }

            return html;
        },
        //设置已使用过的数据
        setUsedData:function(){
            var _this = this;
            //debugger;

            if(!_this.defaults.allareaid){
                return false;
            }
            var leftCity = _this.provinceLeftList.find(".cityName");
            var leftCityList = _this.provinceLeftList.find(".cityList");
            var leftProvinceLi = _this.provinceLeftList.find(".provinceLi");
            //隐藏左侧已用过的元素
            for(var i in _this.defaults.allareaid){
                for(var j=0;j<leftCity.length;j++){
                    if(leftCity.eq(j).attr("area-id") == _this.defaults.allareaid[i][1]){
                        leftCity.eq(j).remove();     //增加OtherSelect类名并隐藏
                        break;
                    }
                }
            }
            //debugger;
            //判断是否删除省元素
            for(var i = 0;i<leftProvinceLi.length;i++){
                var oCity = leftProvinceLi.eq(i).find(".cityName");
                if(!oCity.length){							//本条无数据，删除
                    leftProvinceLi.eq(i).remove();
                }else if(!oCity.hasClass("noSelect")){	//没有未选中的，影藏
                    leftProvinceLi.eq(i).hide();
                }
            }
        },
        //设置左侧
        setLeftHtml:function(){
            var _this = this;

            var leftDistrict = _this.provinceLeftList.find(".districtName");
            var leftDistrictLi = _this.provinceLeftList.find(".districtLi");
            var leftCityLi = _this.provinceLeftList.find(".cityLi");

            var leftCity = _this.provinceLeftList.find(".cityName");
            var leftCityList = _this.provinceLeftList.find(".cityList");
            var leftProvinceLi = _this.provinceLeftList.find(".provinceLi");
            leftDistrict.show().removeClass("AlreadySelect").addClass("noSelect").removeClass("one-active");//重复增加和删除，防止漏选;
            leftCity.show().removeClass("AlreadySelect").addClass("noSelect").removeClass("one-active");//重复增加和删除，防止漏选;
            leftProvinceLi.show();
            leftCityLi.show();


            //隐藏左侧已选中市元素
            for(var i in _this.areaid){
                for(var j=0;j<leftCity.length;j++){
                    if(leftCity.eq(j).attr("area-id") == _this.areaid[i][1]){
                        leftCity.eq(j).hide().removeClass("noSelect").addClass("AlreadySelect");//增加类名方便控制
                        break;
                    }
                }
            }


            for(var i in _this.areaid){
                for(var j=0;j<leftDistrict.length;j++){
                    if(leftDistrict.eq(j).attr("area-id") == _this.areaid[i][2]){
                        leftDistrict.eq(j).hide().removeClass("noSelect").addClass("AlreadySelect");//增加类名方便控制
                        break;
                    }
                }
            }


            //判断是否隐藏市元素
            for(var i = 0; i< leftCityLi.length; i++){
                if(!leftCityLi.eq(i).find(".districtName.noSelect").length){
                    leftCityLi.eq(i).hide();
                    leftCityLi.eq(i).find('.cityName').hide();
                }
            }

            var class_str = "";

            if (_this.enableDistrict)
            {
                class_str = ".districtName.noSelect";
            }
            else
            {
                class_str = ".cityName.noSelect";
            }

            //判断是否隐藏省元素
            for(var i = 0;i<leftProvinceLi.length;i++){
                var Nselect = leftProvinceLi.eq(i).find(class_str)
                if(!Nselect.length){
                    leftProvinceLi.eq(i).hide();
                }
                // else if(Nselect.length != leftProvinceLi.eq(i).find(".cityName").length){	//防止本行未选和他行未选=
                // 	Nselect.length == leftProvinceLi.eq(i).find(".cityName.noSelect").length
                // }
            }
        },

        //设置右侧, 运行效率低下，需要优化
        setRightHtml:function(){
            var _this = this;

            var rightDistrict = _this.provinceRightList.find(".districtName");
            var rightDistrictLi = _this.provinceRightList.find(".districtLi");
            var rightCityLi = _this.provinceRightList.find(".cityLi");



            var rightCity = _this.provinceRightList.find(".cityName");
            var rightCityList = _this.provinceRightList.find(".cityList");
            var rightProvinceLi = _this.provinceRightList.find(".provinceLi");

            rightDistrict.hide().removeClass("AlreadySelect").addClass("noSelect");//重复增加，防止漏选
            rightCity.hide().removeClass("AlreadySelect").addClass("noSelect");//重复增加，防止漏选
            rightProvinceLi.hide();

            //显示右侧已选中市元素
            for(var i in _this.areaid){
                for(var j=0;j<rightCity.length;j++){
                    if(rightCity.eq(j).attr("area-id") == _this.areaid[i][1]){
                        rightCity.eq(j).show().removeClass("noSelect").addClass("AlreadySelect");//增加类名方便控制
                        break;
                    }
                }
            }

            for(var i in _this.areaid){
                for(var j=0;j<rightDistrict.length;j++){
                    if(rightDistrict.eq(j).attr("area-id") == _this.areaid[i][2]){
                        rightDistrict.eq(j).show().removeClass("noSelect").addClass("AlreadySelect");//增加类名方便控制
                        break;
                    }
                }
            }

            //判断右侧是否显示市元素
            for(var i = 0; i< rightCityLi.length; i++){
                if(rightCityLi.eq(i).find(".districtName.AlreadySelect").length){
                    rightCityLi.eq(i).show();
                    rightCityLi.eq(i).find('.cityName').show();
                }
            }

            //判断右侧是否显示省元素
            for(var i = 0; i< rightProvinceLi.length; i++){
                if(rightProvinceLi.eq(i).find(".districtName.AlreadySelect, .cityName.AlreadySelect").length){
                    rightProvinceLi.eq(i).show();
                }
            }
        },
        //添加按钮
        addEvent:function(){
            var _this = this;
            var leftDistrict = _this.provinceLeftList.find(".districtName");
            var leftDistrictLi = _this.provinceLeftList.find(".districtLi");
            var leftCity = _this.provinceLeftList.find(".cityName");
            var leftCityList = _this.provinceLeftList.find(".cityList");
            var leftCityLi = _this.provinceLeftList.find(".cityLi");
            var leftProvinceLi = _this.provinceLeftList.find(".provinceLi");
            var occasionarray = [];
            if(!leftCity.hasClass('one-active')){
                if($.dialog){
                    $.dialog.tips("请在左侧选择需要添加的地区",2, "alert.gif");
                }else{
                    alert("请在左侧选择需要添加的地区");
                }

                return false;
            }

            //添加类名

            if (_this.enableDistrict)
            {
                _this.provinceLeftList.find(".districtName.one-active").hide().removeClass("noSelect").addClass("AlreadySelect");

                //启用区域，此处隐藏
                //_this.provinceLeftList.find(".cityName.one-active").hide().removeClass("noSelect").addClass("AlreadySelect");

                //判断是否影藏省元素
                for(var i = 0;i<leftProvinceLi.length;i++){
                    if(!leftProvinceLi.eq(i).find(".districtName.noSelect").length){
                        leftProvinceLi.eq(i).hide();
                    }
                }

                //是否隐藏市
                for(var i = 0;i<leftCityLi.length;i++){
                    if(!leftCityLi.eq(i).find(".districtName.noSelect").length){
                        leftCityLi.eq(i).hide();
                    }
                }


                //ALLselect包含了本条之前选中的省市
                var AllSelect = _this.provinceLeftList.find(".districtName.AlreadySelect");


                //var ProvSelect = AllSelect.parents('.provinceLi')
                for(var i = 0;i<AllSelect.length;i++){
                    occasionarray[i] = [];
                    occasionarray[i][0] = AllSelect.eq(i).parents('.cityLi').parents('.provinceLi').attr('area-id');
                    occasionarray[i][1] = AllSelect.eq(i).parents('.cityLi').attr('area-id');
                    occasionarray[i][2] = AllSelect.eq(i).attr('area-id');;
                }

                //移除省选选中状态的bug
                _this.provinceLeftList.find(".provincename").removeClass('one-active');
                _this.provinceLeftList.find(".cityName").removeClass('one-active');

                //设置通用area-id
                _this.areaid = occasionarray;

                //console.info(occasionarray)
                //_this.setLeftHtml();
                _this.setRightHtml();

            }
            else
            {
                //启用区域，此处隐藏
                _this.provinceLeftList.find(".cityName.one-active").hide().removeClass("noSelect").addClass("AlreadySelect");

                //判断是否影藏省元素
                for(var i = 0;i<leftProvinceLi.length;i++){
                    if(!leftProvinceLi.eq(i).find(".cityName.noSelect").length){
                        leftProvinceLi.eq(i).hide();
                    }
                }

                //ALLselect包含了本条之前选中的省市
                var AllSelect = _this.provinceLeftList.find(".cityName.AlreadySelect");
                //var ProvSelect = AllSelect.parents('.provinceLi')
                for(var i = 0;i<AllSelect.length;i++){
                    occasionarray[i] = [];
                    occasionarray[i][0] = AllSelect.eq(i).parents('.provinceLi').attr('area-id');
                    occasionarray[i][1] = AllSelect.eq(i).attr('area-id');
                    occasionarray[i][2] = 0;
                }
                //移除省选选中状态的bug
                _this.provinceLeftList.find(".provincename").removeClass('one-active');
                //设置通用area-id
                _this.areaid = occasionarray;
                //_this.setLeftHtml();
                _this.setRightHtml();

            }


        },
        //删除按钮
        deleteEvent:function(_obj){
            var _this = this;

            var _oProvinceLi = _obj.parents(".provinceLi");
            var _oCityLi = _obj.parents(".cityLi");
            var _oCity = _obj.parents(".cityName");
            var _oDistrict = _obj.parents(".districtName");

            //判断删除的是省还是市，并添加类名
            if (_oDistrict.length)
            {
                _oDistrict.addClass("noSelect").removeClass("AlreadySelect");
            }
            else if(_oCity.length){
                _oCity.addClass("noSelect").removeClass("AlreadySelect");
                _oCityLi.find(".districtName").addClass("noSelect").removeClass("AlreadySelect");
            }else{
                _oProvinceLi.find(".cityName").addClass("noSelect").removeClass("AlreadySelect");
                _oProvinceLi.find(".districtName").addClass("noSelect").removeClass("AlreadySelect");
            }

            var occasionarray = [];

            if (_this.enableDistrict)
            {
                var AllSelect = _this.provinceRightList.find(".districtName.AlreadySelect");
                for(var i = 0;i<AllSelect.length;i++){
                    occasionarray[i] = [];

                    var district = AllSelect.eq(i);
                    var city = district.parents('.cityLi');
                    var province = city.parents('.provinceLi');

                    occasionarray[i][0] = province.attr('area-id');
                    occasionarray[i][1] = city.attr('area-id');
                    occasionarray[i][2] = AllSelect.eq(i).attr('area-id');;
                }

            }
            else
            {
                var AllSelect = _this.provinceRightList.find(".cityName.AlreadySelect");
                for(var i = 0;i<AllSelect.length;i++){
                    occasionarray[i] = [];
                    occasionarray[i][0] = AllSelect.eq(i).parents('.provinceLi').attr('area-id');
                    occasionarray[i][1] = AllSelect.eq(i).attr('area-id');
                    occasionarray[i][2] = 0;
                }

            }


            _this.areaid = occasionarray;
            _this.setLeftHtml();
            _this.setRightHtml();
        },
        areaAllData:function(){
            var _this = this;
            if(_this.defaults.AreaFinal){
                return _this.defaults.AreaFinal[0].provinces
            }
            var t;
            $.ajax({
                url:SYS.CONFIG.static_url +'/../common/js/plugins/citypicker/area-data.json?t=2121212',
                async: false,
                dataType:"json",
                success:function(d){
                    _this.defaults.AreaFinal = d.concat([]);
                    _this.defaults.AreaFinal[0].provinces.push(
                        {
                            "id":2,
                            "name":"其他区域",
                            "citys":[
                                {
                                    "id":0,
                                    "name":"其他区域",
                                    "districts":[{"id":0,"name":"其他"}],
                                }
                            ]
                        });

                },
                error:function(){

                }
            });
            return _this.defaults.AreaFinal[0].provinces;
        }




        // ,{"id":710000,"name":"台湾省","citys":[{"id":710100,"name":"台湾","districts":[{"id":710101,"name":"台湾市区内"}]}]},{"id":810000,"name":"香港特别行政区","citys":[{"id":810100,"name":"香港","districts":[{"id":810101,"name":"香港市区内"}]}]},{"id":820000,"name":"澳门特别行政区","citys":[{"id":820100,"name":"澳门","districts":[{"id":820101,"name":"澳门市区内"}]}]},{"id":2,"name":"其他区域","citys":[{"id":0,"name":"其他区域","districts":[{"id":0,"name":"其他"}]}]}]},{"id":900000,"name":"其他区域","provinces":[{"id":910000,"name":"其他","citys":[{"id":910100,"name":"其他","districts":[{"id":910101,"name":"其他"}]}]}]}
        /*新增其他区域数据到省级，记得区分(省级的其他 不是最后那个其他区区域！)！！*/
    }
    // $.extend({AreaSelection:function(o){
    // 	return new AreaSelection(o);
    // }});
    $.fn.areaSelection=function(option){
        //console.log(option);
        option=option || {};
        //***tooplip同时多处显示的，要这样写，防止事件重复绑定冲突。本例可不用，直接new一个新对象即可***
        var oReturn =this.each(function(index){
            var me=$(this),key='areaSelection',data=me.data(key);
            //第一次data存储，第二次不用new 新建对象。
            if(!data){
                var d=new AreaSelection(me,option);	//传入$(this)和optiion设置
                me.data(key,d);						//将组件的方法data到按钮里
            }else{
                data.init(option);
            };
        });
        return oReturn;
    }
}(jQuery,window));

/*
$(function(){	//调用模板
	$('body').on('click','.test_area',function(){
		var obj = $(this);
		var areaid = [
			[110000,110100,0,],[130000,130100,0],[130000,130200,0]
		];
		var option = {
			areaid:areaid,
	        isScroll:true,					//是否阻止滚动
	        fnYesBack:function(data){
	        	console.log(data);
	        }			//回调函数
	    };
		obj.areaSelection(option);
	});
});
*/
