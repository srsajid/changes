<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}incomeEntry/save" method="post">
    <div class="form-group">
        <div class="form-group col-sm-6">
            {{ Form::select("incomeType", $incomeTypes, null, array("class" => 'chosen')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">amount</label>
        <div class="col-sm-10">
            <input type="text" name="amount" class="form-control" placeholder="Amount"  value="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>