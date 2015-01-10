<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}income/save" method="post">
    <input name="id" type="hidden" value="{{$income->id}}">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="form-group">
            {{ Form::selectYear('year', $names, array('class' => 'form-control chosen')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Amount</label>
        <div class="col-sm-10">
            <textarea type="text" name="amount" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-10 col-sm-2">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>