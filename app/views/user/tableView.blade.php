<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Users({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-user" title="Create User">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>
            </div>
        </div>
    </nav>
</div>

<div class="body">
    <table class="table">
        <colgroup>
            <col style="width: 10%">
            <col style="width: 20%">
            <col style="width: 15%">
            <col style="width: 20%">
            <col style="width: 20%">
            <col style="width: 15%">
        </colgroup>
        <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>Full Name</th>
            <th>Role</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $users->each(function($user){ ?>
            <tr class="active">
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->getFullName(); ?></td>
                <td><?php echo OSMS::$USER_TYPE[$user->weight]; ?></td>
                <td><?php echo $user->created_at; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $user->id; ?>" action="edit" title="Edit User">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $user->id; ?>" action="view" title="View User">
                        <span class="glyphicon glyphicon-resize-full"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $user->id; ?>" action="inventory-update" title="Update Inventory">
                        <span class="glyphicon glyphicon-upload"></span>
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
