<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        body
        {
            line-height: 1.6em;
        }
        .container {
            width: 70%;
            margin-top: 100px;
            margin-right: auto;
            margin-left: auto;
        }
        #hor-minimalist-a
        {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            background: #fff;
            border-collapse: collapse;
            text-align: center;
            width: 100%;
            clear: both;
        }
        #hor-minimalist-a th
        {
            font-size: 14px;
            font-weight: normal;
            color: #000;
            padding: 10px 8px;
            border-bottom: 2px solid #000;
        }
        #hor-minimalist-a td
        {
            color: #000;
            padding: 9px 8px 0px 8px;
        }
        #hor-minimalist-a tbody tr:hover td
        {
            color: #000;
        }
        #hor-minimalist-b th
        {
            font-size: 14px;
            font-weight: normal;
            color: #000;
            padding: 10px 8px;
            border-bottom: 2px solid #000;
        }
        #hor-minimalist-b td
        {
            border-bottom: 1px solid #000;
            color: #669;
            padding: 6px 8px;
        }
        #hor-minimalist-b tbody tr:hover td
        {
            color: #009;
        }
        .last {
            font-size: 14px;
            font-weight: normal;
            color: #000;
            border-top: 2px solid #000;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Expense Report - <?php echo("Date From: $from") ?></h2>
    <table id="hor-minimalist-a">
        <thead>
        <tr>
            <th>Type</th>
            <th>Comment</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $totals = 0.0; ?>
        <?php foreach($expenses as $expense) { ?>

        <?php
        $total = $expense->amount;
        $totals = $totals + $total;
        ?>
        <tr>
            <td><?php echo $expense->typeName; ?></td>
            <td><?php echo $expense->comment;?></td>
            <td><?php echo $expense->amount;?></td>
        </tr>
        <?php } ?>
        <tr>
            <td class="last"></td>
            <td class="last"></td>
            <td class="last"><b>Total:</b>    <?php echo $totals; ?></td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>