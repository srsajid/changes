<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Incomes</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Submit</button>
                <button type="button" class="btn btn-default btn-sm create-income" title="New Income Type">
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
            <th>Name</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php $income->each(function($income){ ?>
            <tr class="active">
                <td><?php echo $income->id; ?></td>
                <td><?php echo $income->name; ?></td>
                <td><?php echo $income->status; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $income->id; ?>" action="edit" title="Edit Income Type">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $income->id; ?>" action="pay-salary" title="Add Income">
                        <span class="glyphicon glyphicon-usd"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $income->id; ?>" action="give-loan" title="Generate Report">
                        <span class="glyphicon glyphicon-indent-left"></span>
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