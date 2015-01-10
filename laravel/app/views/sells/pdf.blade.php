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
        .info-view {
            margin : 5px 0;
        }
        .info-view label {
            margin         : 0;
            padding        : 0;
            text-align     : left;
            display        : inline-block;
            *display       : inline;
            zoom           : 1;
            vertical-align : middle;
            width          : 150px;
            font-size      : 14px;
            color          : #000;
        }
        h1.heading {
            font-size: 36px; font-weight: bold;
            text-align: center;
        }
        h2.subheading {
            text-align: center;
            font-style: italic;
            margin-bottom: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="heading">Changes</h1>
    <h2 class="subheading">An English Medium School</h2>
    <div class="info-view">
        <label>Sells Id:</label>
        <span class="value">{{$sell->id}}</span>
    </div>
    <div class="info-view">
        <label>Date:</label>
        <span class="value">{{$sell->created_at}}</span>
    </div>
    <?php if($sell->student_id != null) { ?>
        <div class="info-view">
            <label>Student Id:</label>
            <span class="value">{{$sell->student_id}}</span>
        </div>
        <div class="info-view">
            <label>Mobile:</label>
            <span class="value">{{$sell->mobile}}</span>
        </div>
    <?php } ?>

    <h2>Sells Details:</h2>
    <table id="hor-minimalist-a" summary="Employee Pay Sheet">
        <thead>
        <tr>
            <th scope="col">SN</th>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach($sell->items as $item) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$item->productName</td>";
                echo "<td>$item->quantity</td>";
                echo "<td>$item->productPrice</td>";
                echo "<td>".($item->quantity * $item->productPrice)."</td>";
                echo "</tr>";
                $i++;
            }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="last">Total:</td>
            <td class="last">{{$sell->getTotal()}}</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>