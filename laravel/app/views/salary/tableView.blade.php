<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Salary({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
<!--                <div class="form-group">-->
<!--                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="--><?php //echo($searchText); ?><!--">-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-default search">Search</button>-->
                <button type="button" class="btn btn-default btn-sm generate-report" title="Generate Report">
                    <span class="glyphicon glyphicon-list-alt"></span>
                </button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 15%"/>
            <col style="width: 7%"/>
            <col style="width: 8%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 10%"/>
            <col style="width: 10%"/>
            <col style="width: 5%"/>
        </colgroup>
        <thead>
        <tr>
            <th>Beneficiary</th>
            <th>Month</th>
            <th>Year</th>
            <th>Amount</th>
            <th>GivenBy</th>
            <th>Date</th>
            <th>Extra</th>
            <th>Deduction</th>
            <th>Action</th>
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
                <td><?php echo $salary->extra_payment; ?></td>
                <td><?php echo $salary->deduction; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $salary->id; ?>" action="view" title="View">
                        <span class="glyphicon glyphicon-camera"></span>
                    </button>
                </td>
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
