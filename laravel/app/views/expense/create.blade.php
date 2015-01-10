<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}expense/save" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="Expense Type Name"  value="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Description:</label>
        <div class="col-sm-8">
            <textarea type="text" name="description" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Create</button>
        </div>
    </div>
</form>