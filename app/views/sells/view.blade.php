<div class="info-view">
    <label>Sells Id:</label>
    <span class="value">{{$sell->id}}</span>
</div>
<div class="info-view">
    <label>Date:</label>
    <span class="value">{{$sell->created_at}}</span>
</div>
<div class="info-view">
    <label>Sell By:</label>
    <span>{{$sell->user->username}}</span>
</div>
<?php if($sell->student_id != null) { ?>
    <div class="info-view">
        <label>Student Id:</label>
        <span class="value">{{$sell->student_id}}</span>
    </div>
    <div class="info-view">
        <label>Class:</label>
        <span class="value">{{$sell->clazz}}</span>
    </div>
    <div class="info-view">
        <label>Section:</label>
        <span class="value">{{$sell->section}}</span>
    </div>
<?php } ?>
<h2>Sells Details:</h2>
<table class="srui-table-a" summary="Employee Pay Sheet">
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