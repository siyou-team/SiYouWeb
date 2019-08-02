<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="renderer" content="webkit" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<meta name="description" content="Qianyi Boostrap Admin Panel" />
	<meta name="author" content="" />

	<title><?=Base_ConfigModel::getConfig('account_site_name')?></title>


	<link rel="stylesheet" href="<?=$this->font('fontawesome/css/font-awesome.min', true)?>">
	<link rel="stylesheet" href="<?=$this->css('bootstrap', true)?>">
	<link rel="stylesheet" href="<?=$this->css('qianyi-core', true)?>">
	<link rel="stylesheet" href="<?=$this->css('qianyi-forms', true)?>">
	<link rel="stylesheet" href="<?=$this->css('qianyi-components', true)?>">
    <link rel="stylesheet" href="<?=$this->css('qianyi-skins', true)?>">

    <link rel="shortcut icon" href="<?=$this->img('favicon.ico')?>" type="image/x-icon" />

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <style>
        .external-login-small
        {
            margin-top: 15px;
            height:25px;
        }
        .external-login-small a{
            margin-left:15px;
            color: #020202;
            font-size:16px;
        }
        .external-login-small a i{
            width: 22px;
            height: 22px;
            display: inline-block;
        }
        .external-login-small i.weixin{background:url("../../../../account/static/src/default/images/connect_login_weixin.png");background-size: contain;
            background-repeat: no-repeat;
            background-position: 50% -50%;}
        .external-login-small i.qq{background:url("../../../../account/static/src/default/images/connect_login_qq.png"); background-size: contain;
            background-repeat: no-repeat;
            background-position: 50% -50%;}
        .external-login-small i.weibo{background:url("../../../../account/static/src/default/images/connect_login_weibo.png"); background-size: contain;
            background-repeat: no-repeat;
            background-position: 50% -50%;}
    </style>
    <script type="text/javascript">

        window.SYS = {};
        SYS.VER = '<?=VER?>';
        SYS.DEBUG = <?=intval(DEBUG)?>;
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            base_url: '<?=Zero_Registry::get('base_url')?>',
            index_url: "<?=Zero_Registry::get('url')?>",
            index_page: '<?=Zero_Registry::get('index_page')?>',
            static_url: '<?=Zero_Registry::get('static_url')?>'
        };
    </script>
</head>

<body class="page-body login-page login-light  skin-ss user-info-navbar-skin-ss horizontal-menu-skin-ss" style="background-color:#fff;padding-top:0px;" >

<!-- navbar-minimal -->
<nav class="navbar horizontal-menu" style="background: transparent;max-width: 960px;margin-left:20px;box-shadow:none;"><!-- set fixed position by adding class "navbar-fixed-top" -->
    <div class="navbar-inner" style="">
        <!-- Navbar Brand -->
        <div class="navbar-brand">
            <a href="<?=Zero_Registry::get('base_url')?>" class="logo">
                <img src="<?= Base_ConfigModel::getConfig('site_logo', $this->img('logo@2x.png'))?>" width="255" alt="" class="hidden-xs" />
                <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo@2x.png'))?>" width="80" alt="" class="visible-xs" />
            </a>
        </div>

        <!-- Mobile Toggles Links -->
        <div class="nav navbar-mobile">

            <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
            <div class="mobile-menu-toggle">
                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>

                <a href="#" data-toggle="user-info-menu-horizontal">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>

                <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
                <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
                <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
                <a href="#" data-toggle="mobile-menu-horizontal">
                    <i class="fa-bars"></i>
                </a>
            </div>

        </div>
        <div class="navbar-mobile-clear"></div>
    </div>
</nav>
<?php include $this->getView(); ?>
<!-- Main Footer -->
<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
<!-- Or class "fixed" to  always fix the footer to the end of page -->
<footer class="main-footer    footer-type-1" style="margin-top: 0px;margin-bottom: auto;margin-left:auto;margin-right: auto;background: transparent;">
    <div class="footer-inner">
        <!-- Add your copyright text here -->
        <div class="footer-text" style="float: none;">
            <p class="text-center" style="line-height: 25px;"><?=$layout_data['copyright']?>  <br/>  <a href="http://www.miitbeian.gov.cn" target="_blank"><?=$layout_data['icp_number']?></a></p>
        </div>
    </div>
</footer>



<script type="text/javascript" src="<?=$this->js('../../../../../shop/static/src/default/js/config')?>"></script>
<script src="<?=$this->js('default.min')?>"></script>
<?php foreach ($this->getLazyLoadJs() as $url):?>
    <script type="text/javascript" src="<?=$url?>"></script>
<?php endforeach;?>
<?php foreach ($this->getLazyLoadJsString() as $str):?>
    <script type="text/javascript">
        <?=$str?>
    </script>
<?php endforeach;?>

<script type="text/javascript">


    $(function () {

/*        if (window.parent!=window)
        {
            window.parent.location.reload();
        }*/

        if (false && !window.ActiveXObject && !!document.createElement("canvas").getContext) {
            $.getScript("<?=$this->js('cav', true)?>",
                function () {
                    var t = {
                        width: 1.5,
                        height: 1.5,
                        depth: 10,
                        segments: 12,
                        slices: 6,
                        xRange: 0.8,
                        yRange: 0.1,
                        zRange: 1,
                        ambient: "#525252",
                        diffuse: "#FFFFFF",
                        speed: 0.0002
                    };
                    var G = {
                        count: 2,
                        xyScalar: 1,
                        zOffset: 100,

                        //ambient: "#002c4a",
                        //diffuse: "#005584",
                        ambient: "#e65d00",
                        diffuse: "#ff6700",
                        speed: 0.001,
                        gravity: 1200,
                        dampening: 0.95,
                        minLimit: 10,
                        maxLimit: null,
                        minDistance: 20,
                        maxDistance: 400,
                        autopilot: false,
                        draw: false,
                        bounds: CAV.Vector3.create(),
                        step: CAV.Vector3.create(Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1))
                    };
                    var m = "canvas";
                    var E = "svg";
                    var x = {
                        renderer: m
                    };
                    var i, n = Date.now();
                    var L = CAV.Vector3.create();
                    var k = CAV.Vector3.create();
                    var z = document.getElementById("ani_container");
                    var w = document.getElementById("anit_out");
                    var D, I, h, q, y;
                    var g;
                    var r;

                    function C() {
                        F();
                        p();
                        s();
                        B();
                        v();
                        K(z.offsetWidth, z.offsetHeight);
                        o()
                    }

                    function F() {
                        g = new CAV.CanvasRenderer();
                        H(x.renderer)
                    }

                    function H(N) {
                        if (D) {
                            w.removeChild(D.element)
                        }
                        switch (N) {
                            case m:
                                D = g;
                                break
                        }
                        D.setSize(z.offsetWidth, z.offsetHeight);
                        w.appendChild(D.element)
                    }

                    function p() {
                        I = new CAV.Scene()
                    }

                    function s() {
                        I.remove(h);
                        D.clear();
                        q = new CAV.Plane(t.width * D.width, t.height * D.height, t.segments, t.slices);
                        y = new CAV.Material(t.ambient, t.diffuse);
                        h = new CAV.Mesh(q, y);
                        I.add(h);
                        var N, O;
                        for (N = q.vertices.length - 1; N >= 0; N--) {
                            O = q.vertices[N];
                            O.anchor = CAV.Vector3.clone(O.position);
                            O.step = CAV.Vector3.create(Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1), Math.randomInRange(0.2, 1));
                            O.time = Math.randomInRange(0, Math.PIM2)
                        }
                    }

                    function B() {
                        var O, N;
                        for (O = I.lights.length - 1; O >= 0; O--) {
                            N = I.lights[O];
                            I.remove(N)
                        }
                        D.clear();
                        for (O = 0; O < G.count; O++) {
                            N = new CAV.Light(G.ambient, G.diffuse);
                            N.ambientHex = N.ambient.format();
                            N.diffuseHex = N.diffuse.format();
                            I.add(N);
                            N.mass = Math.randomInRange(0.5, 1);
                            N.velocity = CAV.Vector3.create();
                            N.acceleration = CAV.Vector3.create();
                            N.force = CAV.Vector3.create()
                        }
                    }

                    function K(O, N) {
                        D.setSize(O, N);
                        CAV.Vector3.set(L, D.halfWidth, D.halfHeight);
                        s()
                    }

                    function o() {
                        i = Date.now() - n;
                        u();
                        M();
                        requestAnimationFrame(o)
                    }

                    function u() {
                        var Q, P, O, R, T, V, U, S = t.depth / 2;
                        CAV.Vector3.copy(G.bounds, L);
                        CAV.Vector3.multiplyScalar(G.bounds, G.xyScalar);
                        CAV.Vector3.setZ(k, G.zOffset);
                        for (R = I.lights.length - 1; R >= 0; R--) {
                            T = I.lights[R];
                            CAV.Vector3.setZ(T.position, G.zOffset);
                            var N = Math.clamp(CAV.Vector3.distanceSquared(T.position, k), G.minDistance, G.maxDistance);
                            var W = G.gravity * T.mass / N;
                            CAV.Vector3.subtractVectors(T.force, k, T.position);
                            CAV.Vector3.normalise(T.force);
                            CAV.Vector3.multiplyScalar(T.force, W);
                            CAV.Vector3.set(T.acceleration);
                            CAV.Vector3.add(T.acceleration, T.force);
                            CAV.Vector3.add(T.velocity, T.acceleration);
                            CAV.Vector3.multiplyScalar(T.velocity, G.dampening);
                            CAV.Vector3.limit(T.velocity, G.minLimit, G.maxLimit);
                            CAV.Vector3.add(T.position, T.velocity)
                        }
                        for (V = q.vertices.length - 1; V >= 0; V--) {
                            U = q.vertices[V];
                            Q = Math.sin(U.time + U.step[0] * i * t.speed);
                            P = Math.cos(U.time + U.step[1] * i * t.speed);
                            O = Math.sin(U.time + U.step[2] * i * t.speed);
                            CAV.Vector3.set(U.position, t.xRange * q.segmentWidth * Q, t.yRange * q.sliceHeight * P, t.zRange * S * O - S);
                            CAV.Vector3.add(U.position, U.anchor)
                        }
                        q.dirty = true
                    }

                    function M() {
                        D.render(I)
                    }

                    function J(O) {
                        var Q, N, S = O;
                        var P = function (T) {
                            for (Q = 0, l = I.lights.length; Q < l; Q++) {
                                N = I.lights[Q];
                                N.ambient.set(T);
                                N.ambientHex = N.ambient.format()
                            }
                        };
                        var R = function (T) {
                            for (Q = 0, l = I.lights.length; Q < l; Q++) {
                                N = I.lights[Q];
                                N.diffuse.set(T);
                                N.diffuseHex = N.diffuse.format()
                            }
                        };
                        return {
                            set: function () {
                                P(S[0]);
                                R(S[1])
                            }
                        }
                    }

                    function v() {
                        window.addEventListener("resize", j)
                    }

                    function A(N) {
                        CAV.Vector3.set(k, N.x, D.height - N.y);
                        CAV.Vector3.subtract(k, L)
                    }

                    function j(N) {
                        K(z.offsetWidth, z.offsetHeight);
                        M()
                    }

                    C();
                }, true)
        } else {
            //alert('调用cav.js失败');
        }
    });


</script>
</body>
</html>