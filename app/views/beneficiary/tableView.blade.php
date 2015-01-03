<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Beneficiaries({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-beneficiary" title="Create Beneficiary">
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
            <th>Id</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $beneficiaries->each(function($beneficiary){ ?>
            <tr class="active">
                <td><?php echo $beneficiary->id; ?></td>
                <td><?php echo $beneficiary->name; ?></td>
                <td><?php echo $beneficiary->designation; ?></td>
                <td><?php echo $beneficiary->phone; ?></td>
                <td><?php echo $beneficiary->email; ?></td>
                <td><?php echo $beneficiary->salary; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $beneficiary->id; ?>" action="edit" title="Edit Beneficiary">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $beneficiary->id; ?>" action="pay-salary" title="Pay Salary">
                        <span class="glyphicon glyphicon-usd"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $beneficiary->id; ?>" action="give-loan" title="Give Loan">
                        <span class="glyphicon glyphicon-indent-left"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $beneficiary->id; ?>" action="increment" title="Increment">
                        <span class="glyphicon glyphicon-upload"></span>
                    </button>
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
