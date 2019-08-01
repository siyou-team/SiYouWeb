// 显示顶部菜单操作表
function showTop(obj) {
    document.body.style.overflow = 'hidden';
    var e = document.getElementById(obj);
    e.classList.remove('hidden');
    e.classList.remove('down');
    e.classList.add('up');
    var emclose = e.getElementsByClassName('close');
    for (var i = 0; i < emclose.length; i++) {
        emclose[i].onclick = function () {
            hiddenTop(obj);
        }
    }
}

// 隐藏顶部菜单操作表
function hiddenTop(obj) {
    document.body.style.overflow = 'auto';
    var e = document.getElementById(obj);
    e.classList.remove('up');
    e.classList.add('down');
    setTimeout(function () {
        e.classList.add('hidden');
    }, 700);
}

// 显示底部菜单操作表
function showBottom(obj) {
    document.body.style.overflow = 'hidden';
    var e = document.getElementById(obj);
    e.classList.remove('hidden');
    e.classList.remove('down');
    e.classList.add('up');
    var emclose = e.getElementsByClassName('close');
    for (var i = 0; i < emclose.length; i++) {
        emclose[i].onclick = function () {
            hiddenBottom(obj);
        }
    }
}

// 隐藏底部菜单操作表
function hiddenBottom(obj) {
    document.body.style.overflow = 'auto';

    var e = document.getElementById(obj);
    console.log(e);
    e.classList.add('hidden');
    e.classList.remove('up');
    e.classList.add('down');
    setTimeout(function () {
        e.classList.add('hidden');
    }, 700);
}

// 显示中间弹窗
function showCenter(obj) {
    document.body.style.overflow = 'hidden';
    var e = document.getElementById(obj);
    e.classList.remove('hidden');
    var emclose = e.getElementsByClassName('close');
    for (var i = 0; i < emclose.length; i++) {
        emclose[i].onclick = function (n) {
            hiddenCenter(obj);
        }
    }
}

// 隐藏中间弹窗
function hiddenCenter(obj) {
    document.body.style.overflow = 'auto';
    var e = document.getElementById(obj);
    e.classList.add('hidden');
}

// active切换
function toggleActive(obj) {
    var _this = obj;
    if (obj.classList.contains('active')) {
        _this.classList.remove('active');
    } else {
        _this.classList.add('active');
    }
}

window.addEventListener("scroll", function (e) {
//变量t就是滚动条滚动时，到顶部的距离
    var t = document.documentElement.scrollTop || document.body.scrollTop;
    if (t <= 0) {

    }
});
