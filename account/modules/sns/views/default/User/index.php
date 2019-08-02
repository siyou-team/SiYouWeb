<style>

    .counter {
        text-align: center
    }

    .counter .counter-number-group,.counter>.counter-number {
        font-size: 20px;
        color: #37474f;
    }

    .counter-label {
        display: block
    }

    .counter-icon {
        font-size: 20px
    }

    .counter-lg .counter-number-group,.counter-lg>.counter-number {
        font-size: 40px
    }

    .counter-lg .counter-icon {
        font-size: 40px
    }

    .counter-md .counter-number-group,.counter-md>.counter-number {
        font-size: 30px
    }

    .counter-md .counter-icon {
        font-size: 30px
    }

    .counter-sm .counter-number-group,.counter-sm>.counter-number {
        font-size: 14px
    }

    .counter-sm .counter-icon {
        font-size: 14px
    }

    .counter-sm .counter-number+.counter-number-related,.counter-sm .counter-number-related+.counter-number {
        margin-left: 0
    }

    .counter-inverse {
        color: #fff
    }

    .counter-inverse .counter-number-group,.counter-inverse>.counter-number {
        color: #fff
    }

    .counter-inverse .counter-icon {
        color: #fff
    }




    .cover {
        overflow: hidden
    }

    .cover-background {
        height: 100%;
        background-repeat: no-repeat;
        background-position: center;
        -webkit-background-size: cover;
        background-size: cover
    }

    .cover-image {
        width: 100%
    }

    .cover-quote {
        position: relative;
        padding-left: 35px;
        margin-bottom: 0;
        border-left: none
    }

    .cover-quote:after,.cover-quote:before {
        position: absolute;
        top: -20px;
        font-size: 4em
    }

    .cover-quote:before {
        left: 0;
        content: open-quote
    }

    .cover-quote:after {
        right: 0;
        visibility: hidden;
        content: close-quote
    }

    .cover-quote.blockquote-reverse {
        padding-right: 35px;
        padding-left: 20px;
        border-right: none
    }

    .cover-quote.blockquote-reverse:before {
        right: 0;
        left: auto;
        content: close-quote
    }

    .cover-gallery .carousel-inner img {
        width: 100%
    }

    .cover-iframe {
        width: 100%;
        border: 0 none
    }


    .overlay {
        position: relative;
        display: inline-block;
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow: hidden;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0)
    }

    .overlay .overlay-figure,.overlay>:first-child {
        width: 100%;
        max-width: 100%;
        margin-bottom: 0
    }

    .overlay-panel {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 20px;
        color: #fff
    }

    .overlay-panel a:not([class]) {
        color: inherit;
        text-decoration: underline
    }

    .overlay-panel>:last-child {
        margin-bottom: 0
    }

    .overlay-panel h1,.overlay-panel h2,.overlay-panel h3,.overlay-panel h4,.overlay-panel h5,.overlay-panel h6 {
        color: inherit
    }

    .overlay-hover:not(:hover) .overlay-panel:not(.overlay-background-fixed) {
        opacity: 0
    }

    .overlay-background {
        background: rgba(0,0,0,.5)
    }

    .overlay-image {
        width: 100%;
        max-width: 100%;
        padding: 0
    }

    .overlay-shade {
        background: rgba(0,0,0,0) -webkit-gradient(linear,left top,left bottom,color-stop(50%,rgba(255,255,255,0)),color-stop(90%,rgba(255,255,255,.87)),to(#fff)) repeat scroll 0 0;
        background: rgba(0,0,0,0) -webkit-linear-gradient(top,rgba(255,255,255,0) 50%,rgba(255,255,255,.87) 90%,#fff 100%) repeat scroll 0 0;
        background: rgba(0,0,0,0) -o-linear-gradient(top,rgba(255,255,255,0) 50%,rgba(255,255,255,.87) 90%,#fff 100%) repeat scroll 0 0;
        background: rgba(0,0,0,0) linear-gradient(to bottom,rgba(255,255,255,0) 50%,rgba(255,255,255,.87) 90%,#fff 100%) repeat scroll 0 0
    }

    .overlay-top {
        bottom: auto
    }

    .overlay-bottom {
        top: auto
    }

    .overlay-left {
        right: auto
    }

    .overlay-right {
        left: auto
    }

    .overlay-icon {
        font-size: 0;
        text-align: center
    }

    .overlay-icon:before {
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        content: ""
    }

    .overlay-icon .icon {
        display: inline-block;
        width: 32px;
        height: 32px;
        margin-right: 10px;
        margin-left: 10px;
        font-size: 32px;
        line-height: 1;
        color: #fff;
        text-decoration: none
    }

    .overlay-anchor {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0
    }

    .overlay-blur,.overlay-fade,.overlay-grayscale,.overlay-scale,.overlay-spin,[class*=overlay-slide] {
        -webkit-transition-timing-function: ease-out;
        -o-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
        -webkit-transition-duration: .3s;
        -o-transition-duration: .3s;
        transition-duration: .3s;
        -webkit-transition-property: opacity;
        -o-transition-property: opacity;
        transition-property: opacity
    }

    .overlay-fade {
        opacity: .7
    }

    .overlay-hover:hover .overlay-fade {
        opacity: 1
    }

    .overlay-scale {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1)
    }

    .overlay-hover:hover .overlay-scale {
        -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -o-transform: scale(1.1);
        transform: scale(1.1)
    }

    .overlay-spin {
        -webkit-transform: scale(1) rotate(0);
        -ms-transform: scale(1) rotate(0);
        -o-transform: scale(1) rotate(0);
        transform: scale(1) rotate(0)
    }

    .overlay-hover:hover .overlay-spin {
        -webkit-transform: scale(1.1) rotate(3deg);
        -ms-transform: scale(1.1) rotate(3deg);
        -o-transform: scale(1.1) rotate(3deg);
        transform: scale(1.1) rotate(3deg)
    }

    .overlay-grayscale {
        filter: grayscale(100%);
        -webkit-filter: grayscale(100%)
    }

    .overlay-hover:hover .overlay-grayscale {
        filter: grayscale(0);
        -webkit-filter: grayscale(0)
    }

    [class*=overlay-slide] {
        opacity: 0
    }

    .overlay-slide-top {
        -webkit-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        -o-transform: translateY(-100%);
        transform: translateY(-100%)
    }

    .overlay-slide-bottom {
        -webkit-transform: translateY(100%);
        -ms-transform: translateY(100%);
        -o-transform: translateY(100%);
        transform: translateY(100%)
    }

    .overlay-slide-left {
        -webkit-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        -o-transform: translateX(-100%);
        transform: translateX(-100%)
    }

    .overlay-slide-right {
        -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
        -o-transform: translateX(100%);
        transform: translateX(100%)
    }

    .overlay-hover:hover [class*=overlay-slide] {
        opacity: 1;
        -webkit-transform: translateX(0) translateY(0);
        -ms-transform: translateX(0) translateY(0);
        -o-transform: translateX(0) translateY(0);
        transform: translateX(0) translateY(0)
    }

    .avatar {
        position: relative;
        display: inline-block;
        width: 40px;
        white-space: nowrap;
        vertical-align: bottom;
        border-radius: 1000px
    }

    .avatar i {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 10px;
        height: 10px;
        border: 2px solid #fff;
        border-radius: 100%
    }

    .avatar img {
        width: 100%;
        max-width: 100%;
        height: auto;
        border: 0 none;
        border-radius: 1000px
    }

    .avatar-online i {
        background-color: #46be8a
    }

    .avatar-off i {
        background-color: #526069
    }

    .avatar-busy i {
        background-color: #f2a654
    }

    .avatar-away i {
        background-color: #f96868
    }

    .avatar-100 {
        width: 100px
    }

    .avatar-100 i {
        width: 20px;
        height: 20px
    }

    .avatar-lg {
        width: 50px
    }

    .avatar-lg i {
        width: 12px;
        height: 12px
    }

    .avatar-sm {
        width: 30px
    }

    .avatar-sm i {
        width: 8px;
        height: 8px
    }

    .avatar-xs {
        width: 20px
    }

    .avatar-xs i {
        width: 7px;
        height: 7px
    }




    .font-weight-unset {
        font-weight: unset!important
    }

    .font-weight-100 {
        font-weight: 100!important
    }

    .font-weight-200 {
        font-weight: 200!important
    }

    .font-weight-300 {
        font-weight: 300!important
    }

    .font-weight-400 {
        font-weight: 400!important
    }

    .font-weight-500 {
        font-weight: 500!important
    }

    .font-weight-600 {
        font-weight: 600!important
    }

    .font-weight-700 {
        font-weight: 700!important
    }

    .font-weight-800 {
        font-weight: 800!important
    }

    .font-weight-900 {
        font-weight: 900!important
    }

    .font-weight-light {
        font-weight: 300!important
    }

    .font-weight-normal {
        font-weight: 400!important
    }

    .font-weight-medium {
        font-weight: 500!important
    }

    .font-weight-bold {
        font-weight: 700!important
    }

    .font-size-0 {
        font-size: 0!important
    }

    .font-size-10 {
        font-size: 10px!important
    }

    .font-size-12 {
        font-size: 12px!important
    }

    .font-size-14 {
        font-size: 14px!important
    }

    .font-size-16 {
        font-size: 16px!important
    }

    .font-size-18 {
        font-size: 18px!important
    }

    .font-size-20 {
        font-size: 20px!important
    }

    .font-size-24 {
        font-size: 24px!important
    }

    .font-size-26 {
        font-size: 26px!important
    }

    .font-size-30 {
        font-size: 30px!important
    }

    .font-size-40 {
        font-size: 40px!important
    }

    .font-size-50 {
        font-size: 50px!important
    }

    .font-size-60 {
        font-size: 60px!important
    }

    .font-size-70 {
        font-size: 70px!important
    }

    .font-size-80 {
        font-size: 80px!important
    }












    .width-50 {
        width: 50px
    }

    .width-100 {
        width: 100px
    }

    .width-150 {
        width: 150px
    }

    .width-200 {
        width: 200px
    }

    .width-250 {
        width: 250px
    }

    .width-300 {
        width: 300px
    }

    .width-350 {
        width: 350px
    }

    .width-400 {
        width: 400px
    }

    .width-450 {
        width: 450px
    }

    .width-500 {
        width: 500px
    }

    .width-full {
        width: 100%!important
    }

    @media (max-width: 767px) {
        .width-xs-50 {
            width:50px
        }

        .width-xs-100 {
            width: 100px
        }

        .width-xs-150 {
            width: 150px
        }

        .width-xs-200 {
            width: 200px
        }

        .width-xs-250 {
            width: 250px
        }

        .width-xs-300 {
            width: 300px
        }

        .width-xs-350 {
            width: 350px
        }

        .width-xs-400 {
            width: 400px
        }

        .width-xs-450 {
            width: 450px
        }

        .width-xs-500 {
            width: 500px
        }

        .width-xs-100pc {
            width: 100%
        }
    }

    @media (min-width: 768px) and (max-width:991px) {
        .width-sm-50 {
            width:50px
        }

        .width-sm-100 {
            width: 100px
        }

        .width-sm-150 {
            width: 150px
        }

        .width-sm-200 {
            width: 200px
        }

        .width-sm-250 {
            width: 250px
        }

        .width-sm-300 {
            width: 300px
        }

        .width-sm-350 {
            width: 350px
        }

        .width-sm-400 {
            width: 400px
        }

        .width-sm-450 {
            width: 450px
        }

        .width-sm-500 {
            width: 500px
        }

        .width-sm-100pc {
            width: 100%
        }
    }

    @media (min-width: 992px) and (max-width:1199px) {
        .width-md-50 {
            width:50px
        }

        .width-md-100 {
            width: 100px
        }

        .width-md-150 {
            width: 150px
        }

        .width-md-200 {
            width: 200px
        }

        .width-md-250 {
            width: 250px
        }

        .width-md-300 {
            width: 300px
        }

        .width-md-350 {
            width: 350px
        }

        .width-md-400 {
            width: 400px
        }

        .width-md-450 {
            width: 450px
        }

        .width-md-500 {
            width: 500px
        }
    }

    @media (min-width: 1200px) {
        .width-lg-50 {
            width:50px
        }

        .width-lg-100 {
            width: 100px
        }

        .width-lg-150 {
            width: 150px
        }

        .width-lg-200 {
            width: 200px
        }

        .width-lg-250 {
            width: 250px
        }

        .width-lg-300 {
            width: 300px
        }

        .width-lg-350 {
            width: 350px
        }

        .width-lg-400 {
            width: 400px
        }

        .width-lg-450 {
            width: 450px
        }

        .width-lg-500 {
            width: 500px
        }
    }

    .height-50 {
        height: 50px
    }

    .height-100 {
        height: 100px
    }

    .height-120 {
        height: 120px
    }

    .height-150 {
        height: 150px
    }

    .height-200 {
        height: 200px
    }

    .height-250 {
        height: 250px
    }

    .height-300 {
        height: 300px
    }

    .height-350 {
        height: 350px
    }

    .height-400 {
        height: 400px
    }

    .height-450 {
        height: 450px
    }

    .height-500 {
        height: 500px
    }

    .height-full {
        height: 100%!important
    }

    @media (max-width: 767px) {
        .height-xs-50 {
            height:50px
        }

        .height-xs-100 {
            height: 100px
        }

        .height-xs-120 {
            height: 120px
        }

        .height-xs-150 {
            height: 150px
        }

        .height-xs-200 {
            height: 200px
        }

        .height-xs-250 {
            height: 250px
        }

        .height-xs-300 {
            height: 300px
        }

        .height-xs-350 {
            height: 350px
        }

        .height-xs-400 {
            height: 400px
        }

        .height-xs-450 {
            height: 450px
        }

        .height-xs-500 {
            height: 500px
        }
    }

    @media (min-width: 768px) and (max-width:991px) {
        .height-sm-50 {
            height:50px
        }

        .height-sm-100 {
            height: 100px
        }

        .height-sm-120 {
            height: 120px
        }

        .height-sm-150 {
            height: 150px
        }

        .height-sm-200 {
            height: 200px
        }

        .height-sm-250 {
            height: 250px
        }

        .height-sm-300 {
            height: 300px
        }

        .height-sm-350 {
            height: 350px
        }

        .height-sm-400 {
            height: 400px
        }

        .height-sm-450 {
            height: 450px
        }

        .height-sm-500 {
            height: 500px
        }
    }

    @media (min-width: 992px) and (max-width:1199px) {
        .height-md-50 {
            height:50px
        }

        .height-md-100 {
            height: 100px
        }

        .height-md-120 {
            height: 120px
        }

        .height-md-150 {
            height: 150px
        }

        .height-md-200 {
            height: 200px
        }

        .height-md-250 {
            height: 250px
        }

        .height-md-300 {
            height: 300px
        }

        .height-md-350 {
            height: 350px
        }

        .height-md-400 {
            height: 400px
        }

        .height-md-450 {
            height: 450px
        }

        .height-md-500 {
            height: 500px
        }
    }

    @media (min-width: 1200px) {
        .height-lg-50 {
            height:50px
        }

        .height-lg-100 {
            height: 100px
        }

        .height-lg-120 {
            height: 120px
        }

        .height-lg-150 {
            height: 150px
        }

        .height-lg-200 {
            height: 200px
        }

        .height-lg-250 {
            height: 250px
        }

        .height-lg-300 {
            height: 300px
        }

        .height-lg-350 {
            height: 350px
        }

        .height-lg-400 {
            height: 400px
        }

        .height-lg-450 {
            height: 450px
        }

        .height-lg-500 {
            height: 500px
        }
    }

    .margin-0 {
        margin: 0!important
    }

    .margin-3 {
        margin: 3px!important
    }

    .margin-5 {
        margin: 5px!important
    }

    .margin-10 {
        margin: 10px!important
    }

    .margin-15 {
        margin: 15px!important
    }

    .margin-20 {
        margin: 20px!important
    }

    .margin-25 {
        margin: 25px!important
    }

    .margin-30 {
        margin: 30px!important
    }

    .margin-35 {
        margin: 35px!important
    }

    .margin-40 {
        margin: 40px!important
    }

    .margin-45 {
        margin: 45px!important
    }

    .margin-50 {
        margin: 50px!important
    }

    .margin-60 {
        margin: 60px!important
    }

    .margin-70 {
        margin: 70px!important
    }

    .margin-80 {
        margin: 80px!important
    }

    .margin-vertical-0 {
        margin-top: 0!important;
        margin-bottom: 0!important
    }

    .margin-vertical-3 {
        margin-top: 3px!important;
        margin-bottom: 3px!important
    }

    .margin-vertical-5 {
        margin-top: 5px!important;
        margin-bottom: 5px!important
    }

    .margin-vertical-10 {
        margin-top: 10px!important;
        margin-bottom: 10px!important
    }

    .margin-vertical-15 {
        margin-top: 15px!important;
        margin-bottom: 15px!important
    }

    .margin-vertical-20 {
        margin-top: 20px!important;
        margin-bottom: 20px!important
    }

    .margin-vertical-25 {
        margin-top: 25px!important;
        margin-bottom: 25px!important
    }

    .margin-vertical-30 {
        margin-top: 30px!important;
        margin-bottom: 30px!important
    }

    .margin-vertical-35 {
        margin-top: 35px!important;
        margin-bottom: 35px!important
    }

    .margin-vertical-40 {
        margin-top: 40px!important;
        margin-bottom: 40px!important
    }

    .margin-vertical-45 {
        margin-top: 45px!important;
        margin-bottom: 45px!important
    }

    .margin-vertical-50 {
        margin-top: 50px!important;
        margin-bottom: 50px!important
    }

    .margin-vertical-60 {
        margin-top: 60px!important;
        margin-bottom: 60px!important
    }

    .margin-vertical-70 {
        margin-top: 70px!important;
        margin-bottom: 70px!important
    }

    .margin-vertical-80 {
        margin-top: 80px!important;
        margin-bottom: 80px!important
    }

    .margin-horizontal-0 {
        margin-right: 0!important;
        margin-left: 0!important
    }

    .margin-horizontal-3 {
        margin-right: 3px!important;
        margin-left: 3px!important
    }

    .margin-horizontal-5 {
        margin-right: 5px!important;
        margin-left: 5px!important
    }

    .margin-horizontal-10 {
        margin-right: 10px!important;
        margin-left: 10px!important
    }

    .margin-horizontal-15 {
        margin-right: 15px!important;
        margin-left: 15px!important
    }

    .margin-horizontal-20 {
        margin-right: 20px!important;
        margin-left: 20px!important
    }

    .margin-horizontal-25 {
        margin-right: 25px!important;
        margin-left: 25px!important
    }

    .margin-horizontal-30 {
        margin-right: 30px!important;
        margin-left: 30px!important
    }

    .margin-horizontal-35 {
        margin-right: 35px!important;
        margin-left: 35px!important
    }

    .margin-horizontal-40 {
        margin-right: 40px!important;
        margin-left: 40px!important
    }

    .margin-horizontal-45 {
        margin-right: 45px!important;
        margin-left: 45px!important
    }

    .margin-horizontal-50 {
        margin-right: 50px!important;
        margin-left: 50px!important
    }

    .margin-horizontal-60 {
        margin-right: 60px!important;
        margin-left: 60px!important
    }

    .margin-horizontal-70 {
        margin-right: 70px!important;
        margin-left: 70px!important
    }

    .margin-horizontal-80 {
        margin-right: 80px!important;
        margin-left: 80px!important
    }

    .margin-top-0 {
        margin-top: 0!important
    }

    .margin-top-3 {
        margin-top: 3px!important
    }

    .margin-top-5 {
        margin-top: 5px!important
    }

    .margin-top-10 {
        margin-top: 10px!important
    }

    .margin-top-15 {
        margin-top: 15px!important
    }

    .margin-top-20 {
        margin-top: 20px!important
    }

    .margin-top-25 {
        margin-top: 25px!important
    }

    .margin-top-30 {
        margin-top: 30px!important
    }

    .margin-top-35 {
        margin-top: 35px!important
    }

    .margin-top-40 {
        margin-top: 40px!important
    }

    .margin-top-45 {
        margin-top: 45px!important
    }

    .margin-top-50 {
        margin-top: 50px!important
    }

    .margin-top-60 {
        margin-top: 60px!important
    }

    .margin-top-70 {
        margin-top: 70px!important
    }

    .margin-top-80 {
        margin-top: 80px!important
    }

    .margin-bottom-0 {
        margin-bottom: 0!important
    }

    .margin-bottom-3 {
        margin-bottom: 3px!important
    }

    .margin-bottom-5 {
        margin-bottom: 5px!important
    }

    .margin-bottom-10 {
        margin-bottom: 10px!important
    }

    .margin-bottom-15 {
        margin-bottom: 15px!important
    }

    .margin-bottom-20 {
        margin-bottom: 20px!important
    }

    .margin-bottom-25 {
        margin-bottom: 25px!important
    }

    .margin-bottom-30 {
        margin-bottom: 30px!important
    }

    .margin-bottom-35 {
        margin-bottom: 35px!important
    }

    .margin-bottom-40 {
        margin-bottom: 40px!important
    }

    .margin-bottom-45 {
        margin-bottom: 45px!important
    }

    .margin-bottom-50 {
        margin-bottom: 50px!important
    }

    .margin-bottom-60 {
        margin-bottom: 60px!important
    }

    .margin-bottom-70 {
        margin-bottom: 70px!important
    }

    .margin-bottom-80 {
        margin-bottom: 80px!important
    }

    .margin-left-0 {
        margin-left: 0!important
    }

    .margin-left-3 {
        margin-left: 3px!important
    }

    .margin-left-5 {
        margin-left: 5px!important
    }

    .margin-left-10 {
        margin-left: 10px!important
    }

    .margin-left-15 {
        margin-left: 15px!important
    }

    .margin-left-20 {
        margin-left: 20px!important
    }

    .margin-left-25 {
        margin-left: 25px!important
    }

    .margin-left-30 {
        margin-left: 30px!important
    }

    .margin-left-35 {
        margin-left: 35px!important
    }

    .margin-left-40 {
        margin-left: 40px!important
    }

    .margin-left-45 {
        margin-left: 45px!important
    }

    .margin-left-50 {
        margin-left: 50px!important
    }

    .margin-left-60 {
        margin-left: 60px!important
    }

    .margin-left-70 {
        margin-left: 70px!important
    }

    .margin-left-80 {
        margin-left: 80px!important
    }

    .margin-right-0 {
        margin-right: 0!important
    }

    .margin-right-3 {
        margin-right: 3px!important
    }

    .margin-right-5 {
        margin-right: 5px!important
    }

    .margin-right-10 {
        margin-right: 10px!important
    }

    .margin-right-15 {
        margin-right: 15px!important
    }

    .margin-right-20 {
        margin-right: 20px!important
    }

    .margin-right-25 {
        margin-right: 25px!important
    }

    .margin-right-30 {
        margin-right: 30px!important
    }

    .margin-right-35 {
        margin-right: 35px!important
    }

    .margin-right-40 {
        margin-right: 40px!important
    }

    .margin-right-45 {
        margin-right: 45px!important
    }

    .margin-right-50 {
        margin-right: 50px!important
    }

    .margin-right-60 {
        margin-right: 60px!important
    }

    .margin-right-70 {
        margin-right: 70px!important
    }

    .margin-right-80 {
        margin-right: 80px!important
    }

    @media (max-width: 767px) {
        .margin-xs-0 {
            margin:0!important
        }
    }

    @media (min-width: 768px) {
        .margin-sm-0 {
            margin:0!important
        }
    }

    @media (min-width: 992px) {
        .margin-md-0 {
            margin:0!important
        }
    }

    @media (min-width: 1200px) {
        .margin-lg-0 {
            margin:0!important
        }
    }

    .padding-0 {
        padding: 0!important
    }

    .padding-3 {
        padding: 3px!important
    }

    .padding-5 {
        padding: 5px!important
    }

    .padding-10 {
        padding: 10px!important
    }

    .padding-15 {
        padding: 15px!important
    }

    .padding-20 {
        padding: 20px!important
    }

    .padding-25 {
        padding: 25px!important
    }

    .padding-30 {
        padding: 30px!important
    }

    .padding-35 {
        padding: 35px!important
    }

    .padding-40 {
        padding: 40px!important
    }

    .padding-45 {
        padding: 45px!important
    }

    .padding-50 {
        padding: 50px!important
    }

    .padding-60 {
        padding: 60px!important
    }

    .padding-70 {
        padding: 70px!important
    }

    .padding-80 {
        padding: 80px!important
    }

    .padding-vertical-0 {
        padding-top: 0!important;
        padding-bottom: 0!important
    }

    .padding-vertical-3 {
        padding-top: 3px!important;
        padding-bottom: 3px!important
    }

    .padding-vertical-5 {
        padding-top: 5px!important;
        padding-bottom: 5px!important
    }

    .padding-vertical-10 {
        padding-top: 10px!important;
        padding-bottom: 10px!important
    }

    .padding-vertical-15 {
        padding-top: 15px!important;
        padding-bottom: 15px!important
    }

    .padding-vertical-20 {
        padding-top: 20px!important;
        padding-bottom: 20px!important
    }

    .padding-vertical-25 {
        padding-top: 25px!important;
        padding-bottom: 25px!important
    }

    .padding-vertical-30 {
        padding-top: 30px!important;
        padding-bottom: 30px!important
    }

    .padding-vertical-35 {
        padding-top: 35px!important;
        padding-bottom: 35px!important
    }

    .padding-vertical-40 {
        padding-top: 40px!important;
        padding-bottom: 40px!important
    }

    .padding-vertical-45 {
        padding-top: 45px!important;
        padding-bottom: 45px!important
    }

    .padding-vertical-50 {
        padding-top: 50px!important;
        padding-bottom: 50px!important
    }

    .padding-vertical-60 {
        padding-top: 60px!important;
        padding-bottom: 60px!important
    }

    .padding-vertical-70 {
        padding-top: 70px!important;
        padding-bottom: 70px!important
    }

    .padding-vertical-80 {
        padding-top: 80px!important;
        padding-bottom: 80px!important
    }

    .padding-horizontal-0 {
        padding-right: 0!important;
        padding-left: 0!important
    }

    .padding-horizontal-3 {
        padding-right: 3px!important;
        padding-left: 3px!important
    }

    .padding-horizontal-5 {
        padding-right: 5px!important;
        padding-left: 5px!important
    }

    .padding-horizontal-10 {
        padding-right: 10px!important;
        padding-left: 10px!important
    }

    .padding-horizontal-15 {
        padding-right: 15px!important;
        padding-left: 15px!important
    }

    .padding-horizontal-20 {
        padding-right: 20px!important;
        padding-left: 20px!important
    }

    .padding-horizontal-25 {
        padding-right: 25px!important;
        padding-left: 25px!important
    }

    .padding-horizontal-30 {
        padding-right: 30px!important;
        padding-left: 30px!important
    }

    .padding-horizontal-35 {
        padding-right: 35px!important;
        padding-left: 35px!important
    }

    .padding-horizontal-40 {
        padding-right: 40px!important;
        padding-left: 40px!important
    }

    .padding-horizontal-45 {
        padding-right: 45px!important;
        padding-left: 45px!important
    }

    .padding-horizontal-50 {
        padding-right: 50px!important;
        padding-left: 50px!important
    }

    .padding-horizontal-60 {
        padding-right: 60px!important;
        padding-left: 60px!important
    }

    .padding-horizontal-70 {
        padding-right: 70px!important;
        padding-left: 70px!important
    }

    .padding-horizontal-80 {
        padding-right: 80px!important;
        padding-left: 80px!important
    }

    .padding-top-0 {
        padding-top: 0!important
    }

    .padding-top-3 {
        padding-top: 3px!important
    }

    .padding-top-5 {
        padding-top: 5px!important
    }

    .padding-top-10 {
        padding-top: 10px!important
    }

    .padding-top-15 {
        padding-top: 15px!important
    }

    .padding-top-20 {
        padding-top: 20px!important
    }

    .padding-top-25 {
        padding-top: 25px!important
    }

    .padding-top-30 {
        padding-top: 30px!important
    }

    .padding-top-35 {
        padding-top: 35px!important
    }

    .padding-top-40 {
        padding-top: 40px!important
    }

    .padding-top-45 {
        padding-top: 45px!important
    }

    .padding-top-50 {
        padding-top: 50px!important
    }

    .padding-top-60 {
        padding-top: 60px!important
    }

    .padding-top-70 {
        padding-top: 70px!important
    }

    .padding-top-80 {
        padding-top: 80px!important
    }

    .padding-bottom-0 {
        padding-bottom: 0!important
    }

    .padding-bottom-3 {
        padding-bottom: 3px!important
    }

    .padding-bottom-5 {
        padding-bottom: 5px!important
    }

    .padding-bottom-10 {
        padding-bottom: 10px!important
    }

    .padding-bottom-15 {
        padding-bottom: 15px!important
    }

    .padding-bottom-20 {
        padding-bottom: 20px!important
    }

    .padding-bottom-25 {
        padding-bottom: 25px!important
    }

    .padding-bottom-30 {
        padding-bottom: 30px!important
    }

    .padding-bottom-35 {
        padding-bottom: 35px!important
    }

    .padding-bottom-40 {
        padding-bottom: 40px!important
    }

    .padding-bottom-45 {
        padding-bottom: 45px!important
    }

    .padding-bottom-50 {
        padding-bottom: 50px!important
    }

    .padding-bottom-60 {
        padding-bottom: 60px!important
    }

    .padding-bottom-70 {
        padding-bottom: 70px!important
    }

    .padding-bottom-80 {
        padding-bottom: 80px!important
    }

    .padding-left-0 {
        padding-left: 0!important
    }

    .padding-left-3 {
        padding-left: 3px!important
    }

    .padding-left-5 {
        padding-left: 5px!important
    }

    .padding-left-10 {
        padding-left: 10px!important
    }

    .padding-left-15 {
        padding-left: 15px!important
    }

    .padding-left-20 {
        padding-left: 20px!important
    }

    .padding-left-25 {
        padding-left: 25px!important
    }

    .padding-left-30 {
        padding-left: 30px!important
    }

    .padding-left-35 {
        padding-left: 35px!important
    }

    .padding-left-40 {
        padding-left: 40px!important
    }

    .padding-left-45 {
        padding-left: 45px!important
    }

    .padding-left-50 {
        padding-left: 50px!important
    }

    .padding-left-60 {
        padding-left: 60px!important
    }

    .padding-left-70 {
        padding-left: 70px!important
    }

    .padding-left-80 {
        padding-left: 80px!important
    }

    .padding-right-0 {
        padding-right: 0!important
    }

    .padding-right-3 {
        padding-right: 3px!important
    }

    .padding-right-5 {
        padding-right: 5px!important
    }

    .padding-right-10 {
        padding-right: 10px!important
    }

    .padding-right-15 {
        padding-right: 15px!important
    }

    .padding-right-20 {
        padding-right: 20px!important
    }

    .padding-right-25 {
        padding-right: 25px!important
    }

    .padding-right-30 {
        padding-right: 30px!important
    }

    .padding-right-35 {
        padding-right: 35px!important
    }

    .padding-right-40 {
        padding-right: 40px!important
    }

    .padding-right-45 {
        padding-right: 45px!important
    }

    .padding-right-50 {
        padding-right: 50px!important
    }

    .padding-right-60 {
        padding-right: 60px!important
    }

    .padding-right-70 {
        padding-right: 70px!important
    }

    .padding-right-80 {
        padding-right: 80px!important
    }

    @media (max-width: 767px) {
        .padding-xs-0 {
            padding:0!important
        }
    }

    @media (min-width: 768px) {
        .padding-sm-0 {
            padding:0!important
        }
    }

    @media (min-width: 992px) {
        .padding-md-0 {
            padding:0!important
        }
    }

    @media (min-width: 1200px) {
        .padding-lg-0 {
            padding:0!important
        }
    }
</style>


<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12 col-xs-12 masonry-item">
        <div class="widget widget-shadow background-bottom">
            <div class="widget-header cover overlay">
                <div class="cover-background " style="height:360px;background-image: url(<?=  $this->img( 's-bg' . rand(1, 5) . '.jpg', true)?>)"></div>
                <div class="overlay-panel overlay-background overlay-bottom">
                    <div class="row no-space">
                        <div class="col-xs-6">
                            <a class="avatar avatar-lg bg-white pull-left margin-right-20 img-bordered" href="javascript:;">
                                <img src="<?=img(@$layout_data['user_row']['user_avatar'], 160)?>" alt="">
                            </a>
                            <div>
                                <div class="font-size-20"><?=$layout_data['user_row']['user_nickname']?></div>
                                <div class="font-size-14"><span class="badge badge-info"><?= @$layout_data['user_row']['user_level_name'] ?></span></div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row no-space text-center">
                                <div class="col-xs-3">
                                    <div class="counter counter-inverse">
                                        <div class="counter-label"><?=__('商品')?></div>
                                        <span class="counter-number"><?=$layout_data['user_row']['favorites_goods']?></span>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="counter counter-inverse">
                                        <div class="counter-label"><?=__('店铺')?></div>
                                        <span class="counter-number"><?=$layout_data['user_row']['favorites_store']?></span>
                                    </div>
                                </div>
                                <?php if (Base_ConfigModel::ifSns()):?>
                                    <div class="col-xs-3">
                                        <div class="counter counter-inverse">
                                            <div class="counter-label"><?=__('粉丝')?></div>
                                            <span class="counter-number"><?=intval(@$layout_data['user_row']['user_fans'])?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="counter counter-inverse">
                                            <div class="counter-label"><?=__('关注')?></div>
                                            <span class="counter-number"><?=intval(@$layout_data['user_row']['user_friend'])?></span>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="columns-container">
    <div class="container-bak" id="columns">
        <div class="page animation-fade page-account">
            <div class="page-content profile-env">
                <div class="row">
                    <div class="col-md-3">

                        <!-- User Info Sidebar -->
                        <div class="user-info-sidebar" style="background-color: #fff;padding-top: 20px;">

                            <a href="<?=urlh('account.php', 'User_Account', 'index', '', '', array(), 'default', 'e', true)?>" data-pjax="#account_content" class="user-img">
                                <img src="<?=img(@$layout_data['user_row']['user_avatar'], 160)?>" alt="user-img" class="img-cirlce img-responsive img-thumbnail" />
                            </a>

                            <span class="user-name">
                                        <?=$layout_data['user_row']['user_nickname']?>
                                <span class="user-status is-online"></span>
                                        <span class="badge badge-info"><?= @$layout_data['user_row']['user_level_name'] ?></span>
                                    </span>

                            <!--
                                    <span class="user-title">
									上次登录 <strong><?= @$layout_data['user_row']['user_level_name'] ?></strong>
								    </span>
                                    <span class="user-title">
									CEO at <strong>Google</strong>
								    </span>

                                    <hr />

                                    <ul class="list-unstyled user-info-list">
                                        <li>
                                            <i class="fa-home"></i>
                                            Prishtina, Kosovo
                                        </li>
                                        <li>
                                            <i class="fa-briefcase"></i>
                                            <a href="#">Laborator</a>
                                        </li>
                                        <li>
                                            <i class="fa-graduation-cap"></i>
                                            University of Bologna
                                        </li>
                                    </ul>
                                    -->
                            <hr />

                            <ul class="list-unstyled user-friends-count text-center">
                                <li>
                                    <a href="<?=urlh('index.php', 'User_Favorites', 'item', null, '', array(), 'default', 'e')?>"><span><?=$layout_data['user_row']['favorites_goods']?></span>
                                        <?=__('商品')?></a>
                                </li>
                                <li>
                                    <a href="<?=urlh('index.php', 'User_Favorites', 'store', null, '', array(), 'default', 'e')?>"><span><?=$layout_data['user_row']['favorites_store']?></span>
                                        <?=__('店铺')?></a>
                                </li>
                                <?php if (Base_ConfigModel::ifSns()):?>
                                    <li>
                                        <a href="<?=urlh('account.php', 'User_Friend', 'fans', 'sns', '', array())?>"><span><?=intval(@$layout_data['user_row']['user_fans'])?></span>
                                            <?=__('粉丝')?></a>
                                    </li>
                                    <li>
                                        <a href="<?=urlh('account.php', 'User_Friend', 'index', 'sns', '', array())?>"><span><?=intval(@$layout_data['user_row']['user_friend'])?></span>
                                            <?=__('关注')?></a>
                                    </li>
                                <?php endif;?>
                            </ul>
                            <div style="height: 5px;">
                            </div>
                            <!--<button type="button" class="btn btn-success btn-block text-left">
                                 Following
                                 <i class="fa-check pull-right"></i>
                             </button>-->
                        </div>
                    </div>
                    <div class="col-sm-9">


                        <!-- User timeline stories -->
                        <section class="user-timeline-stories">

                            <!-- Timeline Story Type: Status -->
                            <article class="timeline-story">

                                <i class="fa-paper-plane-empty block-icon"></i>

                                <!-- User info -->
                                <header>

                                    <a href="#" class="user-img">
                                        <img src="<?=$this->img('user-4.png')?>" alt="user-img" class="img-responsive img-circle" />
                                    </a>

                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> posted a status <a href="#">update</a>.
                                        <time>12 hours ago</time>
                                    </div>

                                </header>

                                <div class="story-content">
                                    <!-- Story Content Wrapped inside Paragraph -->
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>

                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#">
                                            <i class="linecons-heart"></i>
                                            Like
                                            <span>(3)</span>
                                        </a>

                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments
                                            <span>(5)</span>
                                        </a>
                                    </div>


                                    <!-- Story Comments -->
                                    <ul class="list-unstyled story-comments">
                                        <li>

                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    <img src="<?=$this->img('user-2.png')?>" alt="user-img" class="img-circle img-responsive" />
                                                </a>

                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Arlind Nushi
                                                        <time>01 December 2014 - 17:54</time>
                                                    </a>

                                                    <p>Him these are visit front end for seven walls. Money eat scale now ask law learn.</p>
                                                </div>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    <img src="<?=$this->img('user-3.png')?>" alt="user-img" class="img-circle img-responsive" />
                                                </a>

                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Eroll Maxhuni
                                                        <time>04 November 2014 - 17:54</time>
                                                    </a>

                                                    <p>Taken no great widow spoke of it small. Genius use except son esteem merely her limits.</p>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>
                                </div>

                            </article>

                            <!-- Timeline Story Type: Audio -->
                            <article class="timeline-story">

                                <i class="fa-music block-icon"></i>

                                <!-- User info -->
                                <header>

                                    <a href="#" class="user-img">
                                        <img src="<?=$this->img('user-4.png')?>" alt="user-img" class="img-responsive img-circle" />
                                    </a>

                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> posted an audio <a href="#">track</a>.
                                        <time>22 hours ago</time>
                                    </div>

                                </header>

                                <!-- Audio Track -->
                                <div class="story-audio-item">
                                    <div class="story-content">

                                        <div class="audio-track-info">
                                            <div class="artist-info">MC Kresha - Emceeclopedy</div>
                                            <div class="track-length">2:14 - 4:31</div>
                                        </div>

                                        <div class="audio-track-timeline">
                                            <div class="play-pause">
                                                <a href="#">
                                                    <i class="fa-to-start"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-pause"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-to-end"></i>
                                                </a>
                                            </div>

                                            <div class="track-timeline">
                                                <div class="track-timeline-empty">
                                                    <div class="track-fill" style="width:49.4%"></div>
                                                </div>
                                            </div>

                                            <div class="track-volume">
                                                <a href="#">
                                                    <i class="fa-volume-up"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="story-content">

                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#" class="liked">
                                            <i class="linecons-heart"></i>
                                            Like
                                            <span>(10)</span>
                                        </a>

                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments
                                            <span>(0)</span>
                                        </a>
                                    </div>

                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>

                                </div>

                            </article>

                            <!-- Timeline Story Type: Check-in -->
                            <article class="timeline-story">

                                <i class="fa-pin block-icon"></i>

                                <!-- User info -->
                                <header>

                                    <a href="#" class="user-img">
                                        <img src="<?=$this->img('user-4.png')?>" alt="user-img" class="img-responsive img-circle" />
                                    </a>

                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> checked in at <a href="#">Laborator</a>.
                                        <time>1 day ago</time>
                                    </div>

                                </header>


                                <div class="story-content">

                                    <div class="story-checkin">
                                        <div id="sample-checkin" class="map-checkin" style="height: 180px; width: 100%;"></div>
                                    </div>

                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#">
                                            <i class="linecons-heart"></i>
                                            Like
                                            <span>(4)</span>
                                        </a>

                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comment
                                            <span>(1)</span>
                                        </a>
                                    </div>


                                    <!-- Story Comments -->
                                    <ul class="list-unstyled story-comments">
                                        <li>

                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    <img src="<?=img(@$layout_data['user_row']['user_avatar'], 160)?>" alt="user-img" class="img-circle img-responsive" />
                                                </a>

                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Ylli Pylla
                                                        <time>22 October 2014 - 17:54</time>
                                                    </a>

                                                    <p>Appear an manner as no limits either praise in. In in written on charmed justice is amiable farther besides.</p>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>

                                </div>

                            </article>

                            <!-- Timeline Story Type: Photos -->
                            <article class="timeline-story">

                                <i class="fa-camera-retro block-icon"></i>

                                <!-- User info -->
                                <header>

                                    <a href="#" class="user-img">
                                        <img src="<?=$this->img('user-4.png')?>" alt="user-img" class="img-responsive img-circle" />
                                    </a>

                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> added <strong>3</strong> photos to <a href="#">Holiday Trip</a> album.
                                        <time>a week ago</time>
                                    </div>

                                </header>

                                <div class="story-content">

                                    <div class="story-album">
                                        <div class="col-1">
                                            <a href="#">
                                                <img src="<?=$this->img('image-1.jpg')?>" alt="album-image" class="img-responsive" />
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <a href="#" class="base-padding">
                                                <img src="<?=$this->img('image-2.jpg')?>" alt="album-image" class="img-responsive" />
                                            </a>
                                            <div class="vspacer v2"></div>
                                            <a href="#">
                                                <img src="<?=$this->img('image-3.jpg')?>" alt="album-image" class="img-responsive" />
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#" class="liked">
                                            <i class="linecons-heart"></i>
                                            Like
                                            <span>(2)</span>
                                        </a>

                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments
                                            <span>(0)</span>
                                        </a>
                                    </div>

                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>

                                </div>

                            </article>

                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

