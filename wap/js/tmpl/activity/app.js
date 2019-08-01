$(function () {
    if (getQueryString('ukey') != '') {
        var key = getQueryString('ukey');
        var username = getQueryString('username');
        setLocalStorage('ukey', key);
        setLocalStorage('username', username);
    } else {
        var key = getLocalStorage('ukey');
    }
    //qianyistore v5.2 第三方登录后返回上回访问页面
    var redirect_uri = getLocalStorage('redirect_uri');
    if(redirect_uri && getQueryString('info') == 'hao'){
        window.location.href = WapSiteUrl + redirect_uri;
    }
    getUserInfo = function () {
        var data = {};
        if (key) {
            $.request({
                type:'post',
                url: SYS.URL.user.overview,
                data:{},
                dataType:'json',
                //jsonp:'jsonp_callback',

                // 此处的参数会覆盖‘全局配置’中的设置
                ajaxCache: {
                    // 业务逻辑判断请求是否缓存， res为ajax返回结果, options 为 $.ajax 的参数
                    cacheValidate: function (res, options) {
                        return res.status === 200; // 满足某个条件才缓存
                    },
                    storageType: 'localStorage', //选填，‘localStorage’ or 'sessionStorage', 默认‘localStorage’
                    timeout: SYS.CACHE_EXPIRE/12, //选填， 单位秒。默认1小时,
                    forceRefresh: false //选填，默认false 是否强制刷新请求。本次请求不读取缓存，同时如果请求成功会更新缓存。应用场景如：下拉刷新
                },
                success:function(result){
                    data =  result.data.base;
                    data.user_avatar = result.data.member_info.user_avatar;
                }
            });
        }
        return data;
    }

    $(document).on('click', 'div[href]', function (ele) {
        console.info(ele)
        window.location.href = ele.currentTarget.attributes.href.value;
    });

    setData = function (obj, params) {
        for (let x in params) {
            obj.data[x] = params[x];
        }
    }

    isNull = function(arg1)
    {
        return !arg1 && arg1!==0 && typeof arg1!=="boolean"?true:false;
    }

    Formattime = function (n, clear) {
        var Time = {};
        if (n < 0) {
            clearInterval(clear);
            Time.hour = "00";
            Time.min  = "00";
            Time.sec  = "00";
        } else {
            Time.hour = doubleNum(Math.floor(n / 1e3 / 60 / 60));
            Time.min  = doubleNum(Math.floor(n / 1e3 / 60 % 60));
            Time.sec  = doubleNum(Math.floor(n / 1e3 % 60));
        }
        return Time;
    };

    function doubleNum(num, length =2) {
        return ('' + num).length < length ? ((new Array(length + 1)).join('0') + num).slice(-length) : '' + num;
    }


    navigateTo = function (obj) {
        console.info(obj)
        var href = obj.url;
        if (!isNull(params)) {
            for (let x in params) {
                href += "&" + x + "=" + params[x];
            }
        }
        window.location.href = href;
    };

    setNavigationBarTitle = function (obj) {
        $('title').html(obj.title)
    }

    getUrlParams = function () {
        var qs = location.search.substr(1), // 获取url中"?"符后的字串
            args = {}, // 保存参数数据的对象
            items = qs.length ? qs.split("&") : [], // 取得每一个参数项,
            item = null,
            len = items.length;

        for (var i = 0; i < len; i++) {
            item = items[i].split("=");
            var name = decodeURIComponent(item[0]),
                value = decodeURIComponent(item[1]);
            if (name) {
                args[name] = value;
            }
        }
        return args;
    }
});