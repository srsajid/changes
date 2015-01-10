<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}loan/save" method="post">
    <input type="hidden" name="beneficiaryId" value="{{$beneficiaryId}}">
    <div class="form-group">
        <label class="col-sm-3 control-label">Amount:</label>
        <div class="col-sm-8">
            <input class="form-control validate[required, custom[number]]" name="amount" placeholder="Amount">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Give</button>
        </div>
    </div>
</form>