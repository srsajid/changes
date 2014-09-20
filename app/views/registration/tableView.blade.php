<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Registrations({{$total}})</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Search</button>
                <button type="button" class="btn btn-default btn-sm tool-icon create-registration" title="Create Registration">
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
            <col style="width: 10%">
            <col style="width: 10%">
            <col style="width: 20%">
            <col style="width: 15%">
            <col style="width: 15%">
        </colgroup>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Year</th>
            <th>Class</th>
            <th>Section</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $registration->each(function($reg){ ?>
            <tr class="active">
                <td><?php echo $reg->id; ?></td>
                <td><?php echo $reg->name() ?></td>
                <td><?php echo $reg->year; ?></td>
                <td><?php echo $reg->clazz; ?></td>
                <td><?php echo $reg->section; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $reg->id; ?>" action="edit" title="Edit User">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $reg->id; ?>" action="view" title="View User">
                        <span class="glyphicon glyphicon-resize-full"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $reg->id; ?>" action="inventory-update" title="Update Inventory">
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
