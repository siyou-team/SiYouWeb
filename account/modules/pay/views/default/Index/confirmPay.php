<div class="columns-container">
    <div class="container-bak" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb-env">

            <ol class="breadcrumb mb0">
                <li>
                    <a href="<?=urlh('index.php', 'Index')?>"><i class="fa-home"></i><?=__('首页')?></a>
                </li>
                <li class="active">
                    <a><?=__('支付中心')?></a>
                </li>
            </ol>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <div class="uc-box uc-main-box">
                    <div class="uc-content-box">
                        <div class="box-hd">
                            <h1 class="title"><?=('账户余额')?></h1>
                            <div class="more" style=""></div>
                        </div>

                        <div class="box-bd" style="margin-top: 25px">
                            <div class="cash-overall clearfix">
                                <div class="balance"><span class="type"><?=__('可用余额：')?><b><?=format_money(@$data['user_money'])?></b><?=__('元')?></span><span class="type"><?=__('冻结余额：')?><b><?=format_money(@$data['user_money_frozen'])?></b><?=__('元')?></span></div>
                            </div>


                        </div>
            </div>
        </div>
    </div>
</div>

