<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Salary({{$total}})</a>
        </div>
<!--        <div>-->
<!--            <div class="navbar-form navbar-right" role="search">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="--><?php //echo($searchText); ?><!--">-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-default search">Search</button>-->
<!--            </div>-->
<!--        </div>-->
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 20%"/>
            <col style="width: 10%"/>
            <col style="width: 10%"/>
            <col style="width: 20%"/>
            <col style="width: 20%"/>
            <col style="width: 20%"/>
        </colgroup>
        <thead>
        <tr>
            <th>Beneficiary</th>
            <th>Month</th>
            <th>Year</th>
            <th>Amount</th>
            <th>GivenBy</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $salaries->each(function($salary){ ?>
            <tr class="active">
                <td><?php echo $salary->beneficiary->name; ?></td>
                <td><?php echo $salary->month; ?></td>
                <td><?php echo $salary->year; ?></td>
                <td><?php echo $salary->amount; ?></td>
                <td><?php echo $salary->givenBy->getFullName(); ?></td>
                <td><?php echo $salary->created_at; ?></td>
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
