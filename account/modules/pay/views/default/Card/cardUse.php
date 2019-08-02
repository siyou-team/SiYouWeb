
<?php
//    echo '<pre>';
//    print_r($data);
?>
<div class="columns-container">
    <div class="container-bak" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb-env">

            <ol class="breadcrumb mb0">
                <li>
                    <a href="<?=url('Index')?>"><i class="fa-home"></i><?=__('首页')?></a>
                </li>
                <li class="active">
                    <a><?=__('支付中心')?></a>
                </li>
            </ol>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <?php $this->userLeftWidgets(); ?>
            <!-- ./left colunm -->

            <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">

                    <div class="uc-box uc-main-box">
                        <div class="uc-content-box coupon-box">
                            <div class="box-hd">
                                <h1 class="title"><?=__('充值卡')?></h1>
                                <div class="more clearfix">
                                    <ul id="J_couponType" class="filter-list tab-switch">
                                        <a  href="<?=urlh('index.php', 'User_Resource', 'cardHistory', '')?>" data-pjax="#page-container" ><li <?php if(@$_GET['met'] == 'cardHistory'){ ?>  class="active" <?php }?> ><?=__('我的充值卡')?></li></a>
                                        <a href="<?=urlh('index.php', 'User_Resource', 'cardUse', '')?>" data-pjax="#page-container" ><li <?php if(@$_GET['met'] == 'cardUse'){ ?>  class="active" <?php }?>><?=__('充值卡充值')?></li></a>
                                    </ul>
                                </div>
                            </div>


                            <ul class="row product-list list">
                                <li class="col-xs-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="right-block">
                                            <input type="text" id="card_code" placeholder="<?=__('请输入充值卡卡号')?>">
                                            <a class="button" href="#"  onclick="addCard()"><?=__('充值')?></a>
                                        </div>

                                    </div>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function addCard(){

//        alert(1);
       var card_code = $('#card_code').val();

        $.post('account.php?mdu=pay&ctl=Index&met=addCard&typ=json',{card_code:card_code},function(result){

            alert(result.msg);

        });

    }


</script>
