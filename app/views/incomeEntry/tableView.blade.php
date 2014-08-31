<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Incomes Entries</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Submit</button>
                <button type="button" class="btn btn-default btn-sm create-incomeE" title="New Income Entry">
                    <span class="glyphicon glyphicon-plus-sign"></span>
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
            <th>Type</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php $incomeE->each(function($incomeE){ ?>
            <tr class="active">
                <td><?php echo $incomeE->id; ?></td>
                <td><?php echo $incomeE->name; ?></td>
                <td><?php echo $incomeE->status; ?></td>
                <td>
<!--                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="--><?php //echo $incomeE->id; ?><!--" action="give-loan" title="Generate Report">-->
<!--                        <span class="glyphicon glyphicon-indent-left"></span>-->
<!--                    </button>-->
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