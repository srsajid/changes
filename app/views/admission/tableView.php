<div class="head">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand">Admission</a>
        </div>
        <div>
            <div class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" name="searchText" class="form-control" placeholder="Search by ID" value="<?php echo($searchText); ?>">
                </div>
                <button type="submit" class="btn btn-default search">Submit</button>
                <button type="button" class="btn btn-default btn-sm create-admission" title="New Admission">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                </button>

                <button type="button" class="btn btn-default btn-sm tool-icon create-report" title="Print Report">
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
            <th>SID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $students->each(function($student){ ?>
            <tr class="active">
                <td><?php echo $student->id; ?></td>
                <td><?php echo $student->sid; ?></td>
                <td><?php echo $student->name; ?></td>
                <td><?php echo $student->clazz; ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $student->id; ?>" action="edit" title="Edit Student">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs action-menu" data-id="<?php echo $student->id; ?>" action="print" title="Print Student">
                        <span class="glyphicon glyphicon-book"></span>
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