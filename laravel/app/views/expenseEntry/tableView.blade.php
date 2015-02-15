<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Expense Entries</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Submit</button>
                <button type="button" class="btn btn-default btn-sm create-expenseE" title="New Expense Entry">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>
                <button type="button" class="btn btn-default btn-sm tool-icon generate-report" title="Generate Report">
                    <span class="glyphicon glyphicon-list-alt"></span>
                </button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 15%">
            <col style="width: 25%">
            <col style="width: 20%">
            <col style="width: 20%">
            <col style="width: 20%">
        </colgroup>
        <thead>
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Type</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php $expenseE->each(function($expenseE){ ?>
            <tr class="active">
                <td><?php echo $expenseE->id; ?></td>
                <td><?php echo date("d-m-Y", strtotime($expenseE->created_at)); ?></td>
                <td><?php echo $expenseE->expenseType->name ?></td>
                <td><?php echo $expenseE->amount; ?></td>
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