<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">.b1 {
            text-align: center;
            white-space-collapsing: preserve;
        }

        .t1 {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .r1 {
            height: 37.5pt;
        }

        .r2 {
            height: 25.5pt;
        }

        .r3 {
            height: 40.5pt;
        }

        .c1 {
            white-space: pre-wrap;
            text-align: center;
            background-color: silver;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            font-weight: bold;
            color: black;
            font-size: 20pt;
        }

        .c2 {
            white-space: pre-wrap;
            text-align: center;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c3 {
            white-space: pre-wrap;
            text-align: center;
            background-color: silver;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 18pt;
        }

        .c4 {
            white-space: pre-wrap;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c5 {
            white-space: pre-wrap;
            text-align: left;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }
    </style>
</head>
<body class="b1">

<table class="t1">
    <colgroup>
        <col width="74">
        <col width="160">
        <col width="152">
        <col width="212">
        <col width="85">
        <col width="62">
        <col width="64">
        <col width="75">
        <col width="87">
        <col width="56">
    </colgroup>
    <tbody>
    <tr class="r1">
        <td class="c1" colspan="10">订 单</td>
    </tr>
    <tr class="r2">
        <td class="c2">订单编号</td>
        <td class="c2"><?= $data['order_id']?></td>
        <td class="c2">下单日期</td>
        <td class="c2"><?= $data['order_time']?></td>
        <td class="c2" colspan="2">预交货日期</td>
        <td class="c2" colspan="4"><?= $data['order_time']?></td>
    </tr>
    <tr class="r2">
        <td class="c2">公司名称</td>
        <td class="c2" colspan="3"><?= $data['delivery']['da_name']?></td>
        <td class="c2" colspan="2">联系人</td>
        <td class="c2" colspan="4"><?= $data['delivery']['da_name']?></td>
    </tr>
    <tr class="r2">
        <td class="c2">收货地址</td>
        <td class="c2" colspan="3"><?= $data['delivery']['da_province'] . '/' . $data['delivery']['da_city'] . '/' . $data['delivery']['da_county'] . ',' . $data['delivery']['da_address']?></td>
        <td class="c2" colspan="2">联系电话</td>
        <td class="c2" colspan="4"><?= $data['delivery']['da_mobile'] ?></td>
    </tr>
    <tr class="r3">
        <td class="c3" colspan="10">商 品 明 细</td>
    </tr>
    <tr class="r2">
        <td class="c2">序号</td>
        <td class="c2" colspan="4">商品名称</td>
        <td class="c2">单价(元)</td>
        <td class="c2">数量</td>
        <td class="c2">计量单位</td>
        <td class="c2">金额小计(元)</td>
        <td class="c2">备注</td>
    </tr>
    <?php foreach ($data['items'] as $key=>$item):?>
        <tr class="r2">
            <td class="c4"><?= $key+1 ?></td>
            <td class="c2" colspan="4"><?= $item['item_name']?></td>
            <td class="c4"><?= $item['order_item_unit_price']?></td>
            <td class="c4"><?= $item['order_item_quantity']?></td>
            <td class="c2"><?= $item['unit_name']?></td>
            <td class="c4"><?=  sprintf("%.2f", $item['order_item_quantity'] * $item['order_item_unit_price'])?></td>
            <td class="c2"><?= $item['order_item_note']?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
    <tr class="r2">
        <td class="c2">&nbsp;</td>
        <td class="c2" colspan="4">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c2">&nbsp;</td>
        <td class="c2" colspan="4">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c2">&nbsp;</td>
        <td class="c2" colspan="4">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c5" colspan="5">订单运费（元）：</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c4"><?=  sprintf("%.2f", $data['order_shipping_fee'])?></td>
        <td class="c4">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c5" colspan="5">优惠券抵扣（元）：</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c4">-<?= sprintf("%.2f", $data['voucher_price'])?></td>
        <td class="c4">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c5" colspan="5">合计：</td>
        <td class="c2">&nbsp;</td>
        <td class="c4"><?= array_sum(array_column($data['items'], 'order_item_quantity'))?></td>
        <td class="c4"></td>
        <td class="c4"><?=  sprintf("%.2f", $data['order_item_amount'] + $data['order_shipping_fee'] - $data['order_discount_amount'] - $data['order_points_fee']  - $data['order_adjust_fee'] - $data['voucher_price'])?></td>
        <td class="c2">&nbsp;</td>
    </tr>
    </tbody>
</table>


<script type="text/javascript">
    window.onload = function () {
        if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
            alert('您的浏览器需要您同时按下 CTRL + P 来打印');
        } else {
            window.print();
        }
    }
</script>

</body>
</html>