<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Package Products</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-package" title="Create Package Product">
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
            <col style="width: 40%">
            <col style="width: 30%">
            <col style="width: 15%">
        </colgroup>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $packages->each(function($package){ ?>
            <tr class="active">
                <td><?php echo $package->id; ?></td>
                <td><?php echo $package->name; ?></td>
                <td><?php echo $package->created_at; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $package->id; ?>" action="edit" title="Edit Package">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $package->id; ?>" action="view" title="View Package">
                        <span class="glyphicon glyphicon-camera action-menu"></span>
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
