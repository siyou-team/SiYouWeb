if ('undefined' == typeof window.SS)
{
    window.SS = {};
}

var SiteUrl = "http://www.ceshi.com";
var ApiUrl = "http://www.ceshi.com";
var pagesize = 10;
var WapSiteUrl = "http://www.ceshi.com/wap";
var IOSSiteUrl = "https://itunes.apple.com/us/app/b2b2c/id879996267?l=zh&ls=1&mt=8";
var AndroidSiteUrl = "http://www.shopsuite.cn/download/app/AndroidShopSuiteMoblie.apk";

var WapStaticUrl = "http://www.ceshi.com/wap";

var SiteLogo = "http://www.siyoumarket.it/image.php/shop/data/upload/media/plantform/image/20180710/1531191970238314.png";
var WapSiteLogo = "http://www.siyoumarket.it/image.php/shop/data/upload/media/plantform/image/20180725/1532509717222103.png";
var WechatStatus = 0;
var WechatBindMobile = 0;

//扩展函数,需要放入lib



function sprintf () {
    var regex = /%%|%(\d+$)?([\-+'#0 ]*)(\*\d+$|\*|\d+)?(?:\.(\*\d+$|\*|\d+))?([scboxXuideEfFgG])/g
    var a = arguments
    var i = 0
    var format = a[i++]

    var _pad = function (str, len, chr, leftJustify) {
        if (!chr) {
            chr = ' '
        }
        var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0).join(chr)
        return leftJustify ? str + padding : padding + str
    }

    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = _pad(value, minWidth, customPadChar, leftJustify)
            } else {
                value = [
                    value.slice(0, prefix.length),
                    _pad('', diff, '0', true),
                    value.slice(prefix.length)
                ].join('')
            }
        }
        return value
    }

    var _formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0
        prefix = (prefix && number && {
                '2': '0b',
                '8': '0',
                '16': '0x'
            }[base]) || ''
        value = prefix + _pad(number.toString(base), precision || 0, '0', false)
        return justify(value, prefix, leftJustify, minWidth, zeroPad)
    }

    // _formatString()
    var _formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision !== null && precision !== undefined) {
            value = value.slice(0, precision)
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar)
    }

    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, precision, type) {
        var number, prefix, method, textTransform, value

        if (substring === '%%') {
            return '%'
        }

        // parse flags
        var leftJustify = false
        var positivePrefix = ''
        var zeroPad = false
        var prefixBaseX = false
        var customPadChar = ' '
        var flagsl = flags.length
        var j
        for (j = 0; j < flagsl; j++) {
            switch (flags.charAt(j)) {
                case ' ':
                    positivePrefix = ' '
                    break
                case '+':
                    positivePrefix = '+'
                    break
                case '-':
                    leftJustify = true
                    break
                case "'":
                    customPadChar = flags.charAt(j + 1)
                    break
                case '0':
                    zeroPad = true
                    customPadChar = '0'
                    break
                case '#':
                    prefixBaseX = true
                    break
            }
        }

        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0
        } else if (minWidth === '*') {
            minWidth = +a[i++]
        } else if (minWidth.charAt(0) === '*') {
            minWidth = +a[minWidth.slice(1, -1)]
        } else {
            minWidth = +minWidth
        }

        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth
            leftJustify = true
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite')
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined
        } else if (precision === '*') {
            precision = +a[i++]
        } else if (precision.charAt(0) === '*') {
            precision = +a[precision.slice(1, -1)]
        } else {
            precision = +precision
        }

        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++]

        switch (type) {
            case 's':
                return _formatString(value + '', leftJustify, minWidth, precision, zeroPad, customPadChar)
            case 'c':
                return _formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad)
            case 'b':
                return _formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'o':
                return _formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'x':
                return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'X':
                return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
                    .toUpperCase()
            case 'u':
                return _formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
            case 'i':
            case 'd':
                number = +value || 0
                // Plain Math.round doesn't just truncate
                number = Math.round(number - number % 1)
                prefix = number < 0 ? '-' : positivePrefix
                value = prefix + _pad(String(Math.abs(number)), precision, '0', false)
                return justify(value, prefix, leftJustify, minWidth, zeroPad)
            case 'e':
            case 'E':
            case 'f': // @todo: Should handle locales (as per setlocale)
            case 'F':
            case 'g':
            case 'G':
                number = +value
                prefix = number < 0 ? '-' : positivePrefix
                method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())]
                textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2]
                value = prefix + Math.abs(number)[method](precision)
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]()
            default:
                return substring
        }
    }

    return format.replace(regex, doFormat)
}

 function buildUlr(url, param) {

    var LG = (function(lg){
        var objURL=function(url){
            this.ourl=url||window.location.href;
            this.href="";//?前面部分
            this.params={};//url参数对象
            this.jing="";//#及后面部分
            this.init();
        }
        //分析url,得到?前面存入this.href,参数解析为this.params对象，#号及后面存入this.jing
        objURL.prototype.init=function(){
            var str=this.ourl;
            var index=str.indexOf("#");
            if(index>0){
                this.jing=str.substr(index);
                str=str.substring(0,index);
            }
            index=str.indexOf("?");
            if(index>0){
                this.href=str.substring(0,index);
                str=str.substr(index+1);
                var parts=str.split("&");
                for(var i=0;i<parts.length;i++){
                    var kv=parts[i].split("=");
                    this.params[kv[0]]=kv[1];
                }
            }
            else{
                this.href=this.ourl;
                this.params={};
            }
        }
        //只是修改this.params
        objURL.prototype.set=function(key,val){
            this.params[key]=val;
        }
        //只是设置this.params
        objURL.prototype.remove=function(key){
            this.params[key]=undefined;
        }
        //根据三部分组成操作后的url
        objURL.prototype.url=function(){
            var strurl=this.href;
            var objps=[];//这里用数组组织,再做join操作
            for(var k in this.params){
                if(this.params[k]){
                    objps.push(k+"="+this.params[k]);
                }
            }
            if(objps.length>0){
                strurl+="?"+objps.join("&");
            }
            if(this.jing.length>0){
                strurl+=this.jing;
            }
            return strurl;
        }
        //得到参数值
        objURL.prototype.get=function(key){
            return this.params[key];
        }
        lg.URL=objURL;
        return lg;
    }(LG||{}));

    var obj =  new LG.URL(url);

    for(var o in param){
        obj.set(o, param[o]);
    }

    return obj.url();
}

function get_ext(filename){
    var postf = '';
    if (filename)
    {
        var index1=filename.lastIndexOf(".");

        var index2=filename.length;
        var postf=filename.substring(index1,index2);//后缀名
    }
    else
    {

    }

    return postf;
}

function image_thumb(image_url, w, h) {
    if ('undefined' == typeof w) {
        w = 60;
    }

    if ('undefined' == typeof h) {
        h = w;
    }


    var ext = get_ext(image_url);
    image_url = sprintf('%s!%sx%s%s', image_url, w, h, ext);

    return image_url;
}

img = image_thumb;

//商品状态
var StateCode = {};

StateCode.DELIVERY_TIME_NO_LIMIT      = 1;    //不限送货时间：周一至周日
StateCode.DELIVERY_TIME_WORKING_DAY   = 2;    //工作日送货：周一至周五
StateCode.DELIVERY_TIME_WEEKEND       = 3;    //双休日、假日送货：周六至周日


StateCode.PRODUCT_STATE_ILLEGAL       = 1000; //违规下架禁售
StateCode.PRODUCT_STATE_NORMAL        = 1001; //正常
StateCode.PRODUCT_STATE_OFF_THE_SHELF = 1002; //下架


StateCode.ACTIVITY_TYPE_BARGAIN          = 1101; //加价购
StateCode.ACTIVITY_TYPE_GIFT             = 1102; //店铺满赠-小礼品
StateCode.ACTIVITY_TYPE_LIMITED_DISCOUNT = 1103; //限时折扣
StateCode.ACTIVITY_TYPE_DISCOUNT_PACKAGE = 1104; //优惠套装
StateCode.ACTIVITY_TYPE_VOUCHER          = 1105; //店铺优惠券  coupon 优惠券
StateCode.ACTIVITY_TYPE_DIY_PACKAGE      = 1106; //拼团
StateCode.ACTIVITY_TYPE_REDUCTION        = 1107; //满减

StateCode.ACTIVITY_TYPE_POINT_SHOPPING   = 1109; //积分换购

StateCode.ACTIVITY_TYPE_MARKETING    = 1131; //市场活动
StateCode.ACTIVITY_TYPE_LOTTERY      = 1121; //幸运大抽奖
StateCode.ACTIVITY_TYPE_FLASHSALE    = 1122; //秒杀
StateCode.ACTIVITY_TYPE_GROUPBOOKING = 1123; //团购
StateCode.ACTIVITY_TYPE_CUTPRICE     = 1124; //砍价
StateCode.ACTIVITY_TYPE_YIYUAN       = 1125; //一元购


StateCode.ACTIVITY_GROUPBOOKING_SALE_PRICE     = 1; //以固定折扣购买
StateCode.ACTIVITY_GROUPBOOKING_FIXED_AMOUNT   = 2; //以固定价格购买
StateCode.ACTIVITY_GROUPBOOKING_FIXED_DISCOUNT = 3; //优惠固定金额

StateCode.MARKRTING_ACTIVITY_JOIN           = 1;//参加活动
StateCode.MARKRTING_ACTIVITY_JOIN_BY_QRCODE = 2;//通过二维码参加


StateCode.VOUCHER_STATE_UNUSED  = 1501; //未用
StateCode.VOUCHER_STATE_USED    = 1502; //已用
StateCode.VOUCHER_STATE_TIMEOUT = 1503; //过期
StateCode.VOUCHER_STATE_DEL     = 1504; //收回
    
    //商品标签
StateCode.PRODUCT_TAG_NEW     = 1401; //新品上架
StateCode.PRODUCT_TAG_REC     = 1402; //热卖推荐
StateCode.PRODUCT_TAG_BARGAIN = 1403; //清仓优惠
StateCode.PRODUCT_TAG_BARGAIN1 = 1404; //清仓优惠
StateCode.PRODUCT_TAG_BARGAIN2 = 1405; //清仓优惠
    
    //商品种类
StateCode.PRODUCT_KIND_ENTITY  = 1201; //实体商品	实物商品 （物流发货）
StateCode.PRODUCT_KIND_FUWU = 1202; //虚拟商品	虚拟商品 （无需物流）
StateCode.PRODUCT_KIND_CARD    = 1203; //电子卡券	电子卡券 （无需物流）
StateCode.PRODUCT_KIND_WAIMAI    = 1203; //外卖订单	外卖订单 （物流发货）


StateCode.PRODUCT_VERIFY_REFUSED = 3000; //审核未通过
StateCode.PRODUCT_VERIFY_PASSED  = 3001; //审核通过
StateCode.PRODUCT_VERIFY_WAITING = 3002; //审核中

StateCode.ORDER_STATE_WAIT_PAY            = 2010; //待付款 - 虚拟映射
StateCode.ORDER_STATE_WAIT_PAID           = 2016; //已经付款 - 虚拟映射
StateCode.ORDER_STATE_WAIT_REVIEW         = 2011; //待订单审核
StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW = 2013; //待财务审核
StateCode.ORDER_STATE_PICKING             = 2020; //待配货
StateCode.ORDER_STATE_WAIT_SHIPPING       = 2030; //待发货
StateCode.ORDER_STATE_SHIPPED             = 2040; //已发货
StateCode.ORDER_STATE_RECEIVED            = 2050; //已签收
StateCode.ORDER_STATE_FINISH              = 2060; //已完成
StateCode.ORDER_STATE_CANCEL              = 2070; //已取消
StateCode.ORDER_STATE_SELF_PICKUP         = 2080; //自提     交易关闭	         交易关闭


StateCode.ORDER_PAID_STATE_NO             = 3010; //未付款
StateCode.ORDER_PAID_STATE_FINANCE_REVIEW = 3011; //待付款审核
StateCode.ORDER_PAID_STATE_PART           = 3012; //部分付款
StateCode.ORDER_PAID_STATE_YES            = 3013; //已付款

StateCode.ORDER_PICKING_STATE_NO             = 3020; //未出库
StateCode.ORDER_PICKING_STATE_PART           = 3021; //部分出库通过拆单解决这种问题
StateCode.ORDER_PICKING_STATE_YES            = 3022; //已出库

StateCode.ORDER_SHIPPED_STATE_NO             = 3030; //未发货
StateCode.ORDER_SHIPPED_STATE_PART           = 3031; //部分发货
StateCode.ORDER_SHIPPED_STATE_YES            = 3032; //已发货

StateCode.VIRTUAL_ORDER_USED    = 2101; //虚拟订单已使用
StateCode.VIRTUAL_ORDER_UNUSE   = 2100; //虚拟订单未使用
StateCode.VIRTUAL_ORDER_TIMEOUT = 2103; //虚拟订单过期

StateCode.ORDER_CANCEL_BY_BUYER  = 2201; //买家取消订单
StateCode.ORDER_CANCEL_BY_SELLER = 2202; //卖家取消订单
StateCode.ORDER_CANCEL_BY_ADMIN  = 2203; //平台取消
    
    
    //订单来源
StateCode.ORDER_FROM_PC     = 2301; //来源于pc端
StateCode.ORDER_FROM_WAP    = 2302; //来源于WAP手机端
StateCode.ORDER_FROM_WEBPOS = 2303; //来源于WEBPOS线下下单
    
    //状态
StateCode.SETTLEMENT_STATE_WAIT_OPERATE       = 2401; //已出账
StateCode.SETTLEMENT_STATE_SELLER_COMFIRMED   = 2402; //商家已确认
StateCode.SETTLEMENT_STATE_PLATFORM_COMFIRMED = 2403; //平台已审核
StateCode.SETTLEMENT_STATE_FINISH             = 2404; //结算完成

StateCode.ORDER_RETURN_NO  = 2500; //无退货
StateCode.ORDER_RETURN_ING = 2501; //退货中
StateCode.ORDER_RETURN_END = 2502; //退货完成

StateCode.ORDER_REFUND_STATE_NO  = 2600; //无退款
StateCode.ORDER_REFUND_STATE_ING = 2601; //退款中
StateCode.ORDER_REFUND_STATE_END = 2602; //退款完成


StateCode.ORDER_TYPE_DD = 3061; //订单类型
StateCode.ORDER_TYPE_FX = 3062; //分销订单
StateCode.ORDER_TYPE_TH = 3066; //分销订单


StateCode.ACTIVITY_STATE_WAITING  = 0; //活动状态:0-未开启
StateCode.ACTIVITY_STATE_NORMAL   = 1; //活动状态:1-正常
StateCode.ACTIVITY_STATE_FINISHED = 2; //活动状态:2-已结束
StateCode.ACTIVITY_STATE_CLOSED   = 3; //活动状态:3-管理员关闭

StateCode.GET_VOUCHER_FREE  = 1; //活动状态:1-免费参与;
StateCode.GET_VOUCHER_BY_POINT  = 2; //活动状态:2-积分参与;
StateCode.GET_VOUCHER_BY_PURCHASE = 3; //活动状态:3-购买参与


StateCode.CART_GET_TYPE_BUY     = 1; //购买
StateCode.CART_GET_TYPE_POINT   = 2; //积分兑换
StateCode.CART_GET_TYPE_GIFT    = 3; //赠品
StateCode.CART_GET_TYPE_BARGAIN = 4; //活动促销
    
    /*
StateCode.   BILL_TYPE_PO   = 4001;   //购货单
StateCode.   BILL_TYPE_PORO = 4002;   //销货退货单
StateCode.   BILL_TYPE_OI   = 4003;   //其他入库单
StateCode.   BILL_TYPE_SO   = 4031;   //销货单
StateCode.   BILL_TYPE_SORO = 4032;   //购货退货单
StateCode.   BILL_TYPE_OO   = 4033;   //其他出库单
    */
    
StateCode.   STOCK_IN_PURCHASE    = 2701;   //采购入库
StateCode.   STOCK_IN_RETURN      = 2702;   //退货入库
StateCode.   STOCK_IN_ALLOCATE    = 2703;   //调库入库
StateCode.   STOCK_IN_INVENTORY_P = 2704;   //盘盈入库
StateCode.   STOCK_IN_INIT        = 2705;   //期初入库
StateCode.   STOCK_IN_OTHER       = 2706;   //手工入库
StateCode.   STOCK_OUT_SALE       = 2751;   //销售出库
StateCode.   STOCK_OUT_DAMAGED    = 2752;   //损坏出库
StateCode.   STOCK_OUT_ALLOCATE   = 2753;   //调库出库
StateCode.   STOCK_OUT_LOSSES     = 2754;   //盘亏出库
StateCode.   STOCK_OUT_OTHER      = 2755;   //手工出库
StateCode.   STOCK_OUT_PO_RETURN  = 2756;   //损坏出库


StateCode.   STOCK_OUT_ALL = 2700;   //出库单
StateCode.   STOCK_IN_ALL  = 2750;   //入库单

StateCode.   BILL_TYPE_OUT = 2700;   //出库单
StateCode.   BILL_TYPE_IN  = 2750;   //入库单


StateCode.   BILL_TYPE_SO = 2800;   //销售订单
StateCode.   BILL_TYPE_PO = 2850;   //采购订单
    
    
    //修改掉，和订单状态对应。
StateCode.ORDER_PROCESS_SUBMIT         = 3070; //【客户】提交订单1OrderOrder

StateCode.ORDER_PROCESS_PAY            = 2010; //待支付Order
StateCode.ORDER_PROCESS_CHECK          = 2011; //订单审核1OrderOrder
StateCode.ORDER_PROCESS_FINANCE_REVIEW = 2013; //财务审核0OrderOrder
StateCode.ORDER_PROCESS_OUT            = 2020; //出库审核商品库存在“出库审核”节点完成后扣减，如需进行库存管理或核算销售成本毛利，需开启此节点。0OrderOrder
StateCode.ORDER_PROCESS_SHIPPED        = 2030; //发货确认如需跟踪订单物流信息，需开启此节点0OrderOrder
StateCode.ORDER_PROCESS_RECEIVED       = 2040; //【客户】收货确认0OrderOrder

StateCode.ORDER_PROCESS_FINISH         = 3098; //完成1OrderOrder

StateCode.RETURN_PROCESS_SUBMIT               = 3100; //【客户】提交退单1ReturnReturn
StateCode.RETURN_PROCESS_CHECK                = 3105; //退单审核1ReturnReturn
StateCode.RETURN_PROCESS_RECEIVED             = 3110; //收货确认0ReturnReturn
StateCode.RETURN_PROCESS_REFUND               = 3115; //退款确认0ReturnReturn
StateCode.RETURN_PROCESS_RECEIPT_CONFIRMATION = 3120; //客户】收款确认0ReturnReturn
StateCode.RETURN_PROCESS_FINISH               = 3125; //完成1ReturnReturn3130-商家拒绝退货
StateCode.RETURN_PROCESS_REFUSED              = 3130; //-商家拒绝退货
StateCode.RETURN_PROCESS_CANCEL               = 3135; //-买家取消


StateCode.PLANTFORM_RETURN_STATE_WAITING               = 3180; //申请状态平台(ENUM):3180-处理中;
StateCode.PLANTFORM_RETURN_STATE_AGREE               = 3181; //为待管理员处理卖家同意或者收货后;
StateCode.PLANTFORM_RETURN_PROCESS_FINISH               = 3182; //-为已完成


StateCode.STORE_STATE_WAIT_PROFILE       = 3210; //待完善资料
StateCode.STORE_STATE_WAIT_VERIFY        = 3220; //等待审核
StateCode.STORE_STATE_NO                 = 3230; //审核资料没有通过
StateCode.STORE_STATE_YES                = 3240; //审核资料通过,待付款

StateCode.TRADE_TYPE_SHOPPING   = 1201;//购物
StateCode.TRADE_TYPE_TRANSFER   = 1202;//转账
StateCode.TRADE_TYPE_DEPOSIT    = 1203;//充值
StateCode.TRADE_TYPE_WITHDRAW   = 1204;//提现
StateCode.TRADE_TYPE_SALES      = 1205;//销售
StateCode.TRADE_TYPE_COMMISSION = 1206;//佣金
StateCode.TRADE_TYPE_REFUND_PAY = 1207;//退货付款
StateCode.TRADE_TYPE_REFUND_GATHERING = 1208;//退货收款
StateCode.TRADE_TYPE_TRANSFER_GATHERING = 1209;//转账收款
StateCode.TRADE_TYPE_COMMISSION_TRANSFER = 1210;//佣金付款
StateCode.TRADE_TYPE_BONUS = 1211;//退货收款


StateCode.PAYMENT_TYPE_DELIVER = 1301;//货到付款
StateCode.PAYMENT_TYPE_ONLINE  = 1302;//在线支付
    //StateCode.PAYMENT_TYPE_CREDIT  = 1303;//白条支付
    //StateCode.PAYMENT_TYPE_CASH    = 1304;//现金支付
StateCode.PAYMENT_TYPE_OFFLINE = 1305;//线下支付

StateCode.ORDER_ITEM_EVALUATION_NO      = 0;    //未评价
StateCode.ORDER_ITEM_EVALUATION_YES   = 1;    //已评价
StateCode.ORDER_ITEM_EVALUATION_TIMEOUT       = 2;    //失效评价

StateCode.ORDER_EVALUATION_NO      = 0;    //未评价
StateCode.ORDER_EVALUATION_YES   = 1;    //已评价
StateCode.ORDER_EVALUATION_TIMEOUT       = 2;    //失效评价

StateCode.ORDER_NOT_NEED_RETURN_GOODS       = 0;    //不用退货
StateCode.ORDER_NEED_RETURN_GOODS           = 1;    //需要退货

StateCode.ORDER_REFUND           = 1;    //1-退款申请; 2-退货申请; 3-虚拟退款
StateCode.ORDER_RETURN           = 2;    //需要退货
StateCode.ORDER_VIRTUAL_REFUND           = 3;    //需要退货

StateCode.TO_STORE_SERVICE           = 1001;    //到店取货
StateCode.DOOR_TO_DOOR_SERVICE          = 1002;    // 上门服务

StateCode.STORE_TYPE_GENERAL    = 1001;   //普通店铺
StateCode.STORE_TYPE_SUPPLIER   = 1002;   //供应商店铺

StateCode.PRODUCT_BEHALF_DELIVERY_TRUE  = 1001;//支持代发货
StateCode.PRODUCT_BEHALF_DELIVERY_FALSE = 1002;//不支持代发货


var User_BindConnectModel = {};

User_BindConnectModel.MOBILE     = 1;
User_BindConnectModel.EMAIL      = 2;

User_BindConnectModel.SINA_WEIBO = 11;
User_BindConnectModel.QQ         = 12;
User_BindConnectModel.WEIXIN     = 13;

;(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD模式
        define(factory);
    } else {
        // 全局模式
        factory();
    }
}(function () {
    if ('undefined' == typeof window.SYS)
    {
        window.SYS = {};

        SYS.VER   = '1.0.1';
        SYS.VER_SHOP   = '1.0.1';
        SYS.VER_WAP   = '1.0.1';
        SYS.VER_ADMIN   = '1.0.1';
        SYS.DEBUG = 0;
        SYS.HTTPS = 0;

        
        if (window.localStorage) {
            var version = localStorage.getItem("version");
            
            if (version)
            {
                SYS.VER   = version;
            }
        } else {
        }
    }

    SYS.CACHE = true;
    SYS.CACHE_EXPIRE = 3600 * 1;
    
    if ('undefined' == typeof SYS.CONFIG)
    {
        SYS.CONFIG = {
            base_url : "http://www.ceshi.com",
            index_url : "http://www.ceshi.com/index.php",
            admin_url : "http://www.ceshi.com/admin.php",
            account_url : "http://www.ceshi.com/account.php",
            index_page : "index.php",
            static_url : "//www.ceshi.com/shop/static/src/default",
            static_lib_url : "//www.ceshi.com/shop/static/src/common",
            wap_url : "http://www.ceshi.com/wap",
        };
    }
    
    SYS.STATIC_IMAGE_PATH = 'https://static.shopsuite.cn/xcxfile/appicon/';
    SYS.SYS_TYPE = 'multi';
    SYS.MULTISHOP_ENABLE = 1;
    SYS.STORE_ID = 1;

    SYS.EVALUATION_ENABLE = 1;
    SYS.SAAS_STATUS = 0;
    SYS.VIRTUAL_ENABLE = 1;
    SYS.O2O_ENABLE = 1;
    SYS.PLANTFORM_FX_ENABLE = 1;
    SYS.STORE_FX_ENABLE = 1;
    SYS.PLANTFORM_SP_PRIZE_ENABLE = 1;

    SYS.REDPACKET_ENABLE = 0;
    SYS.CREDIT_ENABLE = 0;
    SYS.POINT_ENABLE = 1;
    
    SYS.SNS_ENABLE = 0;
    SYS.IM_ENABLE = 1;
    
    
    SYS.AK_BROWSER = "";
    SYS.AK_MINIAPP = "";

    SYS.URL = {"index":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=mobile&typ=json","index_mobile":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=mobile&typ=json","index_app":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=app&typ=json","center_menu":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=userCenterMenu&typ=json","upload":"http:\/\/www.ceshi.com\/index.php?ctl=Media&met=uploadImage&typ=json","upload_config":"http:\/\/www.ceshi.com\/index.php?ctl=Media&met=config&typ=json","info":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=info&typ=json","page":"http:\/\/www.ceshi.com\/index.php?ctl=Page&met=get&typ=json","minipage":"http:\/\/www.ceshi.com\/index.php?ctl=Page&met=getMiniPage&typ=json","survey":"http:\/\/www.ceshi.com\/index.php?ctl=Page&met=doSurvey&typ=json","product":{"item":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=item&typ=json","quick":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=quick&typ=json","info":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=info&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=lists&typ=json","auto_complete":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=listName&typ=json","shipping_district":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=shippingDistrict&typ=json","category":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=category&typ=json","brand":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=brand&typ=json","product_comment":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=comment&typ=json","add_comment_reply":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=addCommentReply&typ=json","comment_helpful":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=commentHelpful&typ=json","faq":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=faq&typ=json","popular":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=productPopular&typ=json","spec":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=getSpec&typ=json"},"loginInfo":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=getLoginInfo&typ=json","search_filter":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=getSearchFilter&typ=json","district":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=district&typ=json","district_all":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=getAllDistrict&typ=json","district_id":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=getDistrictByName&typ=json","search_hot_info":"http:\/\/www.ceshi.com\/index.php?ctl=Index&met=getSearchInfo&typ=json","connect":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=getConnectInfo&typ=json","login_box":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=index&typ=e&login_box=1","set_pwd":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=setNewPassword&typ=json","login":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=doLogin&typ=json","register":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=doRegister&typ=json","logout":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=logout&typ=json","check_mobile_or_email":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=checkMobileOrEmail&typ=json","register_wechat_account":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=doRegisterWechatAccount&typ=json","find_pwd_s2":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=findpwdStepTwo&typ=e&step=2","find_pwd_s3":"http:\/\/www.ceshi.com\/account.php?ctl=Login&met=findpwdStepThree&typ=e&step=3","delivery_info":"http:\/\/www.ceshi.com\/shop\/api\/delivery.php","account":{"certificate":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=certification&typ=e","get_mobile_info":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=index&typ=json","check_mobile_code":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=checkMobile&typ=json","get_mobile_checkcode":"http:\/\/www.ceshi.com\/account.php?ctl=VerifyCode&met=mobile&typ=json","get_email_checkcode":"http:\/\/www.ceshi.com\/account.php?ctl=VerifyCode&met=email&typ=json","check_security_change":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=checkSecurityChange&typ=json","reset_password":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=resetPassword&typ=json","bind_mobile":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=bindMobile&typ=json","commit_certificate":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=saveCertificate&typ=json","change_password":"http:\/\/www.ceshi.com\/account.php?ctl=User_Security&met=changePassword&typ=json","edit_user_info":"http:\/\/www.ceshi.com\/account.php?ctl=User_Account&met=edit&typ=json"},"wx":{"share":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=share&typ=e","config":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=wxConfig&typ=e&body_class_none=1","pay_config":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=wxPayConfig&typ=json","mplogin":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=login&typ=e&flag=mp","openlogin":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=login&typ=e&flag=open","applogin":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=jscode2session&typ=json&flag=app","getQRCode":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=getQRCode&typ=json&flag=app","getMiniAppQRCode":"http:\/\/www.ceshi.com\/account.php?ctl=Connect_Weixin&met=getMiniAppQRCode&typ=json&flag=app","pay":"http:\/\/www.ceshi.com\/account\/modules\/pay\/api\/payment\/wx\/pay.php"},"store":{"get":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=get&typ=json","add":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=add&typ=json","credit":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=credit&typ=json","info":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=info&typ=json","contents":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=contents&typ=json","index_diy":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=indexDiy&typ=json","profile":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=profile&typ=json","menu":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=menu&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=lists&typ=json","listsChain":"http:\/\/www.ceshi.com\/index.php?ctl=Chain&met=lists&typ=json","getChain":"http:\/\/www.ceshi.com\/index.php?ctl=Chain&met=getChainInfo&typ=json","listsChainItems":"http:\/\/www.ceshi.com\/index.php?ctl=Chain&met=listsChainItems&typ=json","listChainByItem":"http:\/\/www.ceshi.com\/index.php?ctl=Chain&met=listChainByItem&typ=json","getNearChain":"http:\/\/www.ceshi.com\/index.php?ctl=Chain&met=getNearChain&typ=json","near":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=lists&typ=json","category":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=category&typ=json","activity":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=activity&typ=json","product":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=lists&typ=json","item":"http:\/\/www.ceshi.com\/index.php?ctl=Product&met=lists&typ=json","product_category":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=productCategory&typ=json","product_popular":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=productPopular&typ=json","lists_store_grade":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=listsStoreGrade&typ=json","lists_store_category":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=listsStoreCategory&typ=json","commit_payment_voucher":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=paymentVoucher&typ=json","survey":"http:\/\/www.ceshi.com\/index.php?ctl=Store&met=doSurvey&typ=json"},"supplier":{"joinIn":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Join&met=step&typ=e","add":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Join&met=step&typ=e","item":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Product&met=item&typ=json","product":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Product&met=lists&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Base&met=lists&typ=json","level":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Base&met=level&typ=json","remove":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Base&met=remove&typ=json","verify":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Base&met=distributorVerify&typ=json","distributor":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Distributor&met=lists&typ=json","store":"http:\/\/www.ceshi.com\/index.php?&mdu=supplier&ctl=Store&met=lists&typ=json"},"distribution":{"applyDistritor":"http:\/\/www.ceshi.com\/index.php?mdu=supplier&ctl=Store&met=applyDistritor&typ=json","uploadDisProduct":"http:\/\/www.ceshi.com\/index.php?mdu=supplier&ctl=Product&met=addDistributionProduct&typ=json","checkSpec":"http:\/\/www.ceshi.com\/index.php?mdu=supplier&ctl=Product&met=checkSpec&typ=json"},"point":{"voucher":"http:\/\/www.ceshi.com\/index.php?ctl=Point&met=voucher&typ=json","index":"http:\/\/www.ceshi.com\/index.php?ctl=Point&met=index&typ=json","product_detail":"http:\/\/www.ceshi.com\/index.php?ctl=Point&met=productDetail&typ=json","product":"http:\/\/www.ceshi.com\/index.php?ctl=Point&met=product&typ=json"},"verify":{"image":"http:\/\/www.ceshi.com\/account.php?ctl=VerifyCode&met=image&typ=json","mobile":"http:\/\/www.ceshi.com\/account.php?ctl=VerifyCode&met=mobile&typ=json","email":"http:\/\/www.ceshi.com\/account.php?ctl=VerifyCode&met=email&typ=json"},"cart":{"add":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=add&typ=json","remove":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=remove&typ=json","edit":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=edit&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=lists&typ=json","listsMini":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=listsMini&typ=json","quantity":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=editQuantity&typ=json","cookie":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=getCookieCart&typ=json","index":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=index&typ=json","sel":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=sel&typ=json","checkout":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=checkout&typ=json","checkDelivery":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=checkDelivery&typ=json","order":"http:\/\/www.ceshi.com\/index.php?ctl=Cart&met=order&typ=e"},"cms":{"lists":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=lists&typ=json","category":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=category&typ=json","get":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=get&typ=json","add_article_comment":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=addComment&typ=json","add_article_comment_reply":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=addCommentReply&typ=json","get_related_article":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=getRelatedArticle&typ=json","comment_helpful":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=commentHelpful&typ=json","remove_comment_helpful":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=removeCommentHelpful&typ=json","comment_reply_helpful":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=commentReplyHelpful&typ=json","remove_comment_reply_helpful":"http:\/\/www.ceshi.com\/index.php?mdu=cms&ctl=Article&met=removeCommentReplyHelpful&typ=json"},"user":{"overview":"http:\/\/www.ceshi.com\/index.php?ctl=User_Account&met=overview&typ=json","cart_count":"http:\/\/www.ceshi.com\/index.php?ctl=User_Account&met=getCartNum&typ=json","msg_count":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=getMsgCount&typ=json","msg_config":"http:\/\/www.ceshi.com\/account.php?ctl=Index&met=getConfig&typ=json","msg_lists":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=lists&typ=json","zonemsg_lists":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_ZoneMessage&met=lists&typ=json","msg_user_lists":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=getMsgUser&typ=json","msg_add":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=add&typ=json","msg_remove":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=remove&typ=json","msg_remove_user":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=removeUserMsg&typ=json","msg_notice_lists":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Message&met=listNotice&typ=json","lists_base_level":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=Index&met=listBaseUserLevel&typ=json","friend_info_lists":"http:\/\/www.ceshi.com\/account.php?mdu=sns&ctl=User_Friend&met=getFriendsInfo&typ=json","more_comment":"http:\/\/www.ceshi.com\/index.php?ctl=User_Comment&met=loadMoreComment&typ=json","add_product_comment":"http:\/\/www.ceshi.com\/index.php?ctl=User_Comment&met=add&typ=json","add_order_comment":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=addOrderComment&typ=json","ask_helpful":"http:\/\/www.ceshi.com\/index.php?ctl=User_Ask&met=hasHelpful&typ=json","ask_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Ask&met=add&typ=json","edit":"http:\/\/www.ceshi.com\/index.php?ctl=User_Account&met=edit&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Account&met=lists&typ=json","points":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=pointsHistory&typ=json","listsExp":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=listsExp&typ=json","listsExpRule":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=listsExpRule&typ=json","signState":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=signState&typ=json","resource":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=resource&typ=json","signIn":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=signIn&typ=json","lists_chain_code":"http:\/\/www.ceshi.com\/index.php?ctl=User_Resource&met=listsChainCode&typ=json","lists_voucher_product":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=listsVoucherProduct&typ=json","voucherList":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=lists&typ=json","voucherNum":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=getVoucherNum&typ=json","eachVoucherNum":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=getEachVoucherNum&typ=json","voucher_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=add&typ=json","voucher_used":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=checkVoucher&typ=json","voucher_offline":"http:\/\/www.ceshi.com\/index.php?ctl=User_Voucher&met=addOffline&typ=json","return_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=lists&typ=json","return_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=add&typ=json","return_add_one":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=addItem&typ=json","return_item":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=returnItem&typ=json","return_cancel":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=cancel&typ=json","return_confirm_refund":"http:\/\/www.ceshi.com\/index.php?ctl=User_Return&met=confirmRefund&typ=json","invoice_type":"http:\/\/www.ceshi.com\/index.php?ctl=User_Invoice&met=type&typ=json","invoice_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Invoice&met=lists&typ=json","invoice_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Invoice&met=add&typ=json","invoice_get":"http:\/\/www.ceshi.com\/index.php?ctl=User_Invoice&met=get&typ=json","invoice_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Invoice&met=remove&typ=json","add_point_shopping_order":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=addPointShoppingOrder&typ=json","order_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=add&typ=json","order_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=lists&typ=json","order_cancel":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=cancel&typ=json","order_receive":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=receive&typ=json","order_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=remove&typ=json","order_detail":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=detail&typ=json","order_delivery":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=delivery&typ=json","order_index":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=index&typ=e","order_comment_manage":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=storeCommentManage&typ=json","order_comment_with_content":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=storeEvaluationWithContent&typ=json","order_comment_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Order&met=addOrderComment&typ=json","wish_store_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=lists&typ=json&action=store","wish_item_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=lists&typ=json&action=item","wish_brand_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=lists&typ=json&action=brand","wish_store_get":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=get&typ=json&action=store","wish_item_get":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=get&typ=json&action=item","wish_brand_get":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=get&typ=json&action=brand","wish_store_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=remove&typ=json&action=store","wish_item_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=remove&typ=json&action=item","wish_brand_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=remove&typ=json&action=brand","wish_store_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=add&typ=json&action=store","wish_item_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=add&typ=json&action=item","wish_brand_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=add&typ=json&action=brand","browser_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=browser&typ=json&action=item","browser_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_Favorites&met=removeBrowser&typ=json&action=item","feedback_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_Feedback&met=add&typ=json","check_wechat_address":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=checkWeChatAddress&typ=json","address_add":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=save&typ=json","address_get":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=get&typ=json","address_edit":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=save&typ=json","address_lists":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=lists&typ=json","address_remove":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=remove&typ=json","address_manage":"http:\/\/www.ceshi.com\/index.php?ctl=User_DeliveryAddress&met=manage&typ=e","joinIn":"http:\/\/www.ceshi.com\/index.php?ctl=Join&met=step&typ=e","listsLottery":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=getLottery&typ=json","doLottery":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=doLottery&typ=json","listsLotteryHistory":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=listsLotteryHistory&typ=json","getLotteryHistory":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=getLotteryHistory&typ=json","updateLotteryAddress":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=updateLotteryAddress&typ=json","listsMarketing":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=listsMarketing&typ=json","listsUserMarketing":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=listsUserMarketing&typ=json","getMarketing":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=getMarketing&typ=json","doMarketing":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=doMarketing&typ=json","doCutPrice":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=doCutPrice&typ=json","listsUserCutPriceHistory":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=listsUserCutPriceHistory&typ=json","listsCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=listsCutPriceActivity&typ=json","pageCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=pageCutPriceActivity&typ=json","getCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=getCutPriceActivity&typ=json","addUserCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=addUserCutPriceActivity&typ=json","getCutPriceActivityDetail":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=getCutPriceActivityDetail&typ=json","helpUserCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=helpUserCutPriceActivity&typ=json","addCutPriceActivityOrder":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=addCutPriceActivityOrder&typ=json","listsCutPriceHistory":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=listsCutPriceHistory&typ=json","homeCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=homeCutPriceActivity&typ=json","editUserCutPriceActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=editUserCutPriceActivity&typ=json","editCutPriceActivityAddress":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=editCutPriceActivityAddress&typ=json","listsGroupbookingActivity":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=listsGroupbookingActivity&typ=json","listsGroupbooking":"http:\/\/www.ceshi.com\/index.php?ctl=Activity&met=listsGroupbooking&typ=json","listsUserGroupbooking":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=listsUserGroupbooking&typ=json","getUserGroupbooking":"http:\/\/www.ceshi.com\/index.php?ctl=User_Activity&met=getUserGroupbooking&typ=json"},"pay":{"type":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=payType&typ=json","lists":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=payLists&typ=json","recharge":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=recharge&typ=json","recharge_level":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=rechargeByLevel&typ=json","recharge_list":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=listRechargeLevel&typ=json","favorable":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=favorable&typ=json","other":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=other&typ=json","pay":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=pay&typ=e","payed":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=payed&typ=e","check_pay_passwd":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=checkPayPasswd&typ=json","get_pay_passwd":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=getPayPasswd&typ=json","asset":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=resourceIndex&typ=json","consume_record":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=consumeRecord&typ=json","get_consume_record":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=getConsumeRecord&typ=json","consume_deposit":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=consumeDeposit&typ=json","consume_trade":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=consumeTrade&typ=json","consume_withdraw":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=consumeWithdraw&typ=json","consume_withdraw_info":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=withdrawInfo&typ=json","consume_withdraw_add":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=addWithdraw&typ=json","addCard":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Card&met=addCard&typ=json","cardHistory":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Card&met=cardHistory&typ=json","reset_paypasswd":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=resetPayPassword&typ=json","change_paypasswd":"http:\/\/www.ceshi.com\/account.php?mdu=pay&ctl=Index&met=changePayPassword&typ=json"},"exchange":{"sp_exchange":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=exchange&typ=json","sp_transfer":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=transfer&typ=json","point_transfer":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=transferPoint&typ=json","sp_sale":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=sale&typ=json","sp_buy":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=buy&typ=json","bp_exchange":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Bp&met=exchange&typ=json","bp_market":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Bp&met=market&typ=json","sp_history":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=listSpHistory&typ=json","sp_trade":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=listSpMarket&typ=json","sp_trade_cancel":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=cancelSpMarket&typ=json","sp_trade_buy":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=buySpMarket&typ=json","do_sp_exchange":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=doSpExchange&typ=json","do_sp_transfer":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=doSpTransfer&typ=json","do_point_transfer":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=doPointTransfer&typ=json","do_sp_sale":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Sp&met=doSpSale&typ=json","bp_history":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Bp&met=listBpHistory&typ=json","do_bp_exchange":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Bp&met=doBpExchange&typ=json","do_bp_market":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Bp&met=doBpMarket&typ=json","funds_lists":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Funds&met=listFunds&typ=json","funds_profit_lists":"http:\/\/www.ceshi.com\/account.php?mdu=exchange&ctl=Funds&met=listFundsProfit&typ=json"},"fx":{"invite":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=invite&typ=json","withdraw":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=withdraw&typ=json","doWithdraw":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=doWithdraw&typ=json","lists":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=lists&typ=json","lists_commission":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=listsCommission&typ=json","lists_order":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=listsOrder&typ=json","index":"http:\/\/www.ceshi.com\/index.php?ctl=Distribution_User&met=index&typ=json"},"admin":{"pay":{"orderRecord":"http:\/\/www.ceshi.com\/admin.php?mdu=pay&ctl=Consume_Record&met=orderRecord&typ=json","offline":"http:\/\/www.ceshi.com\/admin.php?mdu=pay&ctl=Consume_Trade&met=offline&typ=json"},"lists":{"payment_channel":"http:\/\/www.ceshi.com\/admin.php?ctl=Category&met=lists&typ=json&isDelete=2&type_number=payment_channel_id","express":"http:\/\/www.ceshi.com\/admin.php?ctl=Category&met=lists&typ=json&isDelete=2&type_number=express_id"}},"seller":{"store":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_Base&met=get&typ=json","product":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Product&met=lists&typ=json","product_add":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Product&met=add&typ=json","get_store_info":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_Base&met=get&typ=json","edit_store_info":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_Base&met=edit&typ=json","lists_product":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Product_Base&met=lists&typ=json","edit_state":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Product_Base&met=editState&typ=json","remove_product":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Product_Base&met=remove&typ=json","dashboard":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Index&met=dashboard&typ=json","order_lists":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=listsOrderAndsProduct&typ=json","edit_fee":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=editFee&typ=json","review":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=review&typ=json","review_finance":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=reviewFinance&typ=json","review_picking":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=reviewPicking&typ=json","cancel_order":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=cancel&typ=json","getOrderStock":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=getOrderStock&typ=json","saveOrderLogistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=saveOrderLogistics&typ=json","lists_shipping_address":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=lists&typ=json","del_shipping_address":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=remove&typ=json","add_shipping_address":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=add&typ=json","edit_shipping_address":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=edit&typ=json","get_shipping_address":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=get&typ=json","get_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=get&typ=json","select_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=selectDefault&typ=json","enabled_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=selectEnabled&typ=json","lists_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=lists&typ=json","del_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=remove&typ=json","add_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=add&typ=json","edit_express_logistics":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=edit&typ=json","order_cancel":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=cancel&typ=json","order_receive":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=receive&typ=json","order_remove":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=remove&typ=json","order_detail":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=detail&typ=json","order_get_by_pickupcode":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=getOrderByPickUpCode&typ=json","do_pickup":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=doPickUp&typ=json","order_delivery":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Order_Base&met=delivery&typ=json","waybill_tpl_lists":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_WaybillTpl&met=lists&typ=json","waybill_tpl_add":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_WaybillTpl&met=add&typ=json","express_logistics_lists":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=lists&typ=json","express_logistics_add":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ExpressLogistics&met=add&typ=json","shipping_address_lists":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=lists&typ=json","shipping_address_add":"http:\/\/www.ceshi.com\/admin.php?mdu=seller&ctl=Store_ShippingAddress&met=add&typ=json"}}

    SYS.CONFIG.URL = SYS.URL;

    return SYS.CONFIG;
}));


// utils.js
if ('undefined' == typeof window.verifyUtils)
{
    window.verifyUtils = {};
}

window.verifyUtils = {
    smsTimer: function (that)
    {
        var self = this;

        var wait = $(that).data('wait');

        if (wait == 0)
        {
            $(that).removeAttr("disabled").val('重新获取验证码');
            $(that).removeClass("disabled");

            $(that).data('status', true);
            $(that).data('wait', $(that).data('times'));
        }
        else
        {
            $(that).attr("disabled", true).val(wait + '秒后点此重发');
            $(that).addClass("disabled");

            $(that).data('wait', --wait);

            setTimeout(function ()
            {
                self.smsTimer(that);
            }, 1000)
        }
    },

    countDown:function (that, times)
    {
        var self = this;

        $(that).data('times', times);
        $(that).data('wait', times);

        if (typeof($(that).data('status')) === 'undefined' || $(that).data('status'))
        {
            $(that).data('status', false);
            self.smsTimer(that);
        }
    },



    imageVerifyCode : function (verify_code, key_obj)
    {
        $(verify_code).on('click', function()
        {
            var rand_key = Math.random();
            var url = itemUtil.getUrl(SYS.URL.verify.image, {rand_key: rand_key});

            $(verify_code).css("backgroundImage","url(" + url + ")");
            $(key_obj).val(rand_key);
        });

        //$(this).css("backgroundImage","url(" + url + ")");
        var rand_key = Math.random();
        var url = itemUtil.getUrl(SYS.URL.verify.image, {rand_key: rand_key});

        $(verify_code).css("background","url(" + url + ") no-repeat center");
        $(verify_code).css("cursor", "pointer");
        $(verify_code).css("backgroundSize", "cover");
        $(key_obj).val(rand_key);
    },


    emailVerifyCode : function (email, that, captcha)
    {
        var self = this;
        $(that).on('click', function()
        {
            var url = itemUtil.getUrl(SYS.URL.verify.email, {rand_key: email})

            if (typeof(captcha) !== 'undefined')
            {
                url = url + '&captcha=' + captcha;
            }

            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: "jsonp",
                jsonp: "jsonp_callback",
                success: function(res){

                    if (200 == res.status)
                    {
                        //服务端返回times
                        var times = 60;
                        self.countDown(that, times);
                    }
                    else
                    {
                        pub.msg(res.msg);
                    }
                }
            });

        });
    },


    smsVerifyCode : function (mobile, that, captcha)
    {
        var self = this;
        $(that).on('click', function()
        {
            var url = itemUtil.getUrl(SYS.URL.verify.mobile, {rand_key: mobile});

            if (typeof(captcha) !== 'undefined')
            {
                url = url + '&captcha=' + captcha;
            }

            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: "jsonp",
                jsonp: "jsonp_callback",
                success: function(res){

                    if (200 == res.status)
                    {
                        //服务端返回times
                        var times = 60;
                        self.countDown(that, times);
                    }
                    else
                    {
                        pub.msg(res.msg);
                    }
                }
            });

        });
    },
        
    smsVerifyCodeNew : function (mobile, that, captcha)
    {
        var self = this;
        $(that).on('click', function()
        {
            var mobile = $("#user_phone").val();
            var verify_code = $("#verify_code").val();
            var rand_key = $("#rand_key").val();
            
            console.log(mobile);
            if(!mobile)
            {
                alert('请输入手机号');
                return false;
            }
            
            var reg=/^3[\d]{9}/;
            if(!reg.test(mobile)){
                alert('手机号格式不正确');
                return false;
            }
            
            var url = itemUtil.getUrl(SYS.URL.verify.mobile, {rand_key: rand_key,mobile:mobile,verify_code:verify_code});
            if (typeof(captcha) !== 'undefined')
            {
                url = url + '&captcha=' + captcha;
            }

            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: "jsonp",
                jsonp: "jsonp_callback",
                success: function(res){

                    if (200 == res.status)
                    {
                        //服务端返回times
                        var times = 60;
                        self.countDown(that, times);
                    }
                    else
                    {
                        pub.msg(res.msg);
                    }
                }
            });

        });
    }
};



function changeURLArg(url,arg,arg_val){ 
    var pattern=arg+'=([^&]*)'; 
    var replaceText=arg+'='+arg_val; 
    if(url.match(pattern)){ 
        var tmp='/('+ arg+'=)([^&]*)/gi'; 
        tmp=url.replace(eval(tmp),replaceText); 
        return tmp; 
    }else{ 
        if(url.match('[\?]')){ 
            return url+'&'+replaceText; 
        }else{ 
            return url+'?'+replaceText; 
        } 
    } 
    return url+'\n'+arg+'\n'+arg_val; 
} 

function formatMoney(value, prefix, endfix) {
    var num = new Number(value);
    
    if(typeof prefix != 'undefined')
    {
    }
    else
    {
        prefix = "￥"
    }
    
    if(typeof endfix != 'undefined')
    {
    }
    else
    {
        endfix = ""
    }
    
    return prefix + num.toFixed(2) +  endfix
}


function payment_met_id(val, opt, row) {
    var r = {
    "1": "余额支付",
    "2": "充值卡支付",
    "3": "积分支付",
    "4": "信用支付",
    "5": "红包支付"
    };
    return r[val];
}

function trade_type_id(val, opt, row) {
    var r = {
    "1201": "购物",
    "1202": "转账",
    "1203": "充值",
    "1204": "提现",
    "1205": "销售",
    "1206": "佣金"
    };
    return r[val];
}


function payment_type_id(val, opt, row) {
    var r = {
    "1301": "货到付款",
    "1302": "在线支付",
    "1303": "白条支付",
    "1304": "现金支付",
    "1305": "线下支付",
    "": null
    };
    return r[val];
}


