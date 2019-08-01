
//添加到购物车
function addcart(ele){
    var user_key = getLocalStorage("ukey");
    var t =1;
    var a = 0;
    var new_i="";
    var r=ele.attributes["item_id"].nodeValue;
    if (null) {
        var o = decodeURIComponent(getLocalStorage("goods_cart"));
        if (r < 1) {
            show_tip_new(ele);
            return false
        }
        if (o=='null'||o=='') {
            o = r + "," + t;
            a = 1;
        } else {
            var old_insert=false;
            var i = o.split("|");
            for (var n = 0; n < i.length; n++) {
                var l = i[n].split(",");
                if (l[0]==r) {
                    old_insert=true;
                    var new_num=parseInt(parseInt(l[1])+1);
                    $('#amount_'+r).html(new_num);
                    $('#del_'+r).show();
                    $('#amount_'+r).show();
                    a=a+new_num;
                    new_i+=l[0]+','+new_num+'|';
                }else{
                    new_i+=i[n]+'|';
                    a+=parseInt(l[1]);
                }
            }
            o=new_i.substring(0,new_i.length-1);
            if(!old_insert){
                a+=1;
                o +='|'+r + "," + t;
            }
        }
        console.log('finish');
        console.log('a');
        console.log(typeof(a));
        console.log(a);
        console.log('new_i');
        console.log(typeof(new_i));
        console.log(new_i);
        console.log('o');
        console.log(typeof(o));
        console.log(o);
        addCookie("goods_cart", o);
        addCookie("cart_count", a);
        show_tip_new(ele);
        getCartCount(user_key,t, true);
        setTimeout(function (){
            $("#cart_count").html('<i class="zc zc-cart cart"></i><sup>' +a+ '</sup>');
        }, 800);
        return false
    }else{
        $.request({
            url: SYS.URL.cart.add,
            data: {
                item_id: r,
                quantity: t
            },
            type: "post",
            success: function(res) {
                if (200 == res.status) {
                    show_tip_new(ele);

                    delLocalStorage('cart_count');
                    delCookie("cart_count");
                    getCartCount(user_key, 60, true);
                    $("#cart_count").html('<i class="zc zc-cart cart"></i><sup>' +getLocalStorage("cart_count")+ '</sup>')
                } else {
                    $.sDialog({
                        skin: "red",
                        content: t.msg,
                        okBtn: false,
                        cancelBtn: false
                    })
                }
            }
        })
    }
}
function s(e, t) {
    var o = e.length;
    while (o--) {
        if (e[o] === t) {
            return true
        }
    }
    return false
}
function show_tip_new(ele) {
    var item_id=ele.attributes["item_id"].nodeValue;
    var str="#goods_pic"+item_id+" > img";
    var goods_pic=$("#goods_pic"+item_id+" > img").first();
    var e = goods_pic.clone().css({
        "z-index": "999",
        height: "3rem",
        width: "3rem"
    });
    e.fly({
        start: {
            left: goods_pic.offset().left,
            top: goods_pic.offset().top - $(window).scrollTop()
        },
        end: {
            left: $("#cart_count").offset().left + 40,
            top: $("#cart_count").offset().top - $(window).scrollTop(),
            width: 0,
            height: 0
        },
        onEnd: function() {
            e.remove()
        }
    })
}
