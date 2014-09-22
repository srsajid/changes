<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Transport Fees({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="year" class="form-control advance-search-field" placeholder="Year" value="{{$year}}">
                    <input type="text" name="searchText" class="form-control" placeholder="Student Id" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon take-fee" title="Take Transport Fee">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 5%"/>
            <col style="width: 20%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
        </colgroup>
        <thead>
        <tr>
            <th>Student Id</th>
            <th>Student Name</th>
            <th>No. of Month</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Fine</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $fees->each(function($fee){ ?>
            <tr class="active">
                <td><?php echo $fee->studentInformation->name; ?></td>
                <td><?php echo $fee->studentInformation->student_id; ?></td>
                <td><?php echo $fee->number_of_month; ?></td>
                <td><?php echo $fee->amount; ?></td>
                <td><?php echo $fee->discount; ?></td>
                <td><?php echo $fee->fine; ?></td>
                <td><?php echo $fee->getTotal(); ?></td>
            </tr>
        <?php }); ?>
        </tbody>
    </table>
</div>
<div class="footer">
    <?php
    echo CommonService::paginator($max, $offset, $total);
    echo CommonService::itemPerPage($max);
    ?>
</div>
