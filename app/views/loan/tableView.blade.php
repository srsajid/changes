<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Loans({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Beneficiary ID" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table table-hover">
        <colgroup>
            <col style="width: 20%"/>
            <col style="width: 15%"/>
            <col style="width: 15%"/>
            <col style="width: 20%"/>
            <col style="width: 20%"/>
            <col style="width: 10%"/>
        </colgroup>
        <thead>
        <tr>
            <th>Beneficiary</th>
            <th>Amount</th>
            <th>Given By</th>
            <th>Paid</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $loans->each(function($loan){ ?>
            <tr class="active">
                <td><?php echo $loan->givenTo->name; ?></td>
                <td><?php echo $loan->amount; ?></td>
                <td><?php echo $loan->givenBy->getFullName(); ?></td>
                <td><?php echo $loan->paid; ?></td>
                <td><?php echo $loan->created_at; ?></td>
                <td>

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
