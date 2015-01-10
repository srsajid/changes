<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}expense/save" method="post">
    <input name="id" type="hidden" value="{{$expense->id}}">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" placeholder="Expense Type Name"  value="<?php echo $expense->name;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea type="text" name="description" class="form-control"><?php echo $expense->description; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>