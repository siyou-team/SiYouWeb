$(function(){
	$("#iframe-right").height($(window).height() - 80);
})
$('#sidebar-menu a').click(function(){
	var url = $(this).attr('href');
	$("#iframe-right").attr("src", url);//设置iframe的src
});

function addStyle(input)
{
	$("a").removeClass("bgbj");
    $(input).children().addClass("bgbj");
    $(input).find("em").text("-");
    $(input).siblings().find("em").text("+");
}

function hideMenu() {
    if ($("#wrapper").is(".enlarged")) {
        $(".list-unstyled").hide();
    }
}
function showMenu(t) {
    if ($("#wrapper").is(".enlarged")) {
        $(t).find(".list-unstyled").show();
    }
}

if ($("#wrapper").is(".enlarged")) {
    $("#sidebar-menu > ul > li > a > em").remove();
}
$(".has_sub>a").click(function () {
    $(this).parent().siblings().find(".list-unstyled").slideUp();
    $(this).parent().find(".list-unstyled").slideToggle(function () {
        $(this).is(":visible") ? $(this).parent().find('em').text("-") : $(this).parent().find('em').text("+");
    });
});

function addClass(t) 
{
	$(t).siblings().removeClass("sactive");
	$(t).addClass("sactive");
}

var localdataState = isLocalStorageSupported(); //true 
function isLocalStorageSupported() {
    var testKey = 'test',
        storage = window.sessionStorage;
    try {
        storage.setItem(testKey, 'testValue');
        storage.removeItem(testKey);
        return true;
    } catch (error) {
        return false;
    }
}

//设置本地存储
function setLocalStorage(key, value, type) {
    if (key == null || key == "") {
        return;
    }
    if (!/^[0-9]+$/.test(value)) {
        value = BASE64.encoder(value);//返回编码后的字符
    }
    if (localdataState) {
        if (type == 0) {
            localStorage.setItem(key, value);
        } else {
            sessionStorage.setItem(key, value);
        }
    } else {
        $.cookie(key, value);
    }
}

//获取本地存储
function getLocalStorage(key, type) {
    if (key == null || key == "") {
        return "";
    }
    var base64Str;
    if (localdataState) {
        if (type == 0) {
            base64Str = localStorage.getItem(key);
        } else {
            base64Str = sessionStorage.getItem(key);
        }
        if (base64Str == null || base64Str == "") {
            base64Str = $.cookie(key);
        }
    } else {
        base64Str = $.cookie(key);
    }
    var value = '';
    if (!/^[0-9]+$/.test(base64Str)) {
        if (base64Str != null) {
            var unicode = BASE64.decoder(base64Str);//返回会解码后的unicode码数组。
            for (var i = 0, len = unicode.length ; i < len ; ++i) {
                value += String.fromCharCode(unicode[i]);
            }
        }
    } else {
        value = base64Str;
    }
    return value;
}

//删除本地缓存
function removeStorage(key, type) {
    try {
        if (localdataState) {
            if (type == 0) {
                localStorage.removeItem(key);
            } else {
                sessionStorage.removeItem(key);
            }
        } else {
            $.cookie(key, '', { expires: -1 });
        }
    } catch (error) {

    }
}

initIndex();
function initIndex(){
	//获取角色所对应的所有权限
    $.ajax({
        url: SYS.CONFIG.index_url+'?ctl=Index&met=auth&typ=json',
        type: 'get',
        data: {},
        dataType: "json",
        async: false,
        success: function (res) {
            var strlist = "";
			var data = res.data;
			console.log(data);
            for (var i = 0; i < data.length; i++) {
				if(data[i].rights_remark != ''){
					strlist = strlist + data[i].rights_remark + ",";
				}
            }
			
            strlist = strlist.substring(0, strlist.length - 1);
            setLocalStorage("roleAuth", strlist, 1);
        }
    });
}