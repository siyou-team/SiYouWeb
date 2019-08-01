<!-- saved from url=(0109)https://file.dinghuo123.com/corp/order/exporterInvoice?billNum=L-20170908-57675&isPrintView=true&templateId=0 -->
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
            border-top: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c4 {
            white-space: pre-wrap;
            text-align: center;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c5 {
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

        .c6 {
            white-space: pre-wrap;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c7 {
            white-space: pre-wrap;
            text-align: left;
            border-top: thin solid;
            border-right: thin solid;
            border-bottom: thin solid;
            border-left: thin solid;
            color: black;
            font-size: 11pt;
        }

        .c8 {
            white-space: pre-wrap;
            text-align: center;
            color: black;
            font-size: 11pt;
        }
    </style>
</head>
<body class="b1">
<table class="t1">
    <colgroup>
        <col width="79">
        <col width="160">
        <col width="148">
        <col width="209">
        <col width="83">
        <col width="67">
        <col width="68">
        <col width="87">
    </colgroup>
    <tbody>
    <tr class="r1">
        <td class="c1" colspan="8">发 货 单</td>
    </tr>
    <tr class="r2">
        <td class="c2">发货编号</td>
        <td class="c2"><?= current($data['logistics_row'])['order_logistics_id']?></td>
        <td class="c2">客户名称</td>
        <td class="c2"><?= $data['da_name']?></td>
        <td class="c3">发货仓库</td>
        <td class="c2"><?= $data['warehouse_name']?></td>
        <td class="c4">联系人</td>
        <td class="c2"><?= $data['da_name']?></td>
    </tr>
    <tr class="r2">
        <td class="c2">收货地址</td>
        <td class="c2" colspan="3"><?= $data['da_province'] . '/' . $data['da_city'] . '/' . $data['da_county'] . ',' . $data['da_address']?></td>
        <td class="c3" colspan="2">联系电话</td>
        <td class="c2" colspan="2"><?= $data['da_mobile']?></td>
    </tr>
    <tr class="r3">
        <td class="c5" colspan="8">商 品 明 细</td>
    </tr>
    <tr class="r2">
        <td class="c2">序号</td>
        <td class="c2" colspan="3">商品名称</td>
        <td class="c2">数量</td>
        <td class="c2">计量单位</td>
        <td class="c6">重量小计</td>
        <td class="c2">备注</td>
    </tr>
    <?php foreach ($data['items'] as $key=>$item):?>
        <tr class="r2">
            <td class="c6"><?= $key+1 ?></td>
            <td class="c2" colspan="3"><?= $item['item_name']?></td>
            <td class="c6"><?= (int)$item['bill_item_quantity']?></td>
            <td class="c2"><?= $item['unit_name']?></td>
            <td class="c6"><?= (int)$item['bill_item_quantity']?><?= $item['unit_name']?></td>
            <td class="c2">&nbsp;</td>
        </tr>
    <?php endforeach; ?>
    <tr class="r2">
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c6">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c7">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c2">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c6">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c7">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c6">&nbsp;</td>
        <td class="c6">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c7">&nbsp;</td>
        <td class="c6">&nbsp;</td>
        <td class="c6">&nbsp;</td>
        <td class="c2">&nbsp;</td>
        <td class="c7">&nbsp;</td>
    </tr>
    <tr class="r2">
        <td class="c8">送货人：</td>
        <td></td>
        <td class="c8">日期：</td>
        <td></td>
        <td class="c8">收货人：</td>
        <td class="c8">&nbsp;</td>
        <td class="c8">日期：</td>
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