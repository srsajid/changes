<div class="form-group">
    <label class="col-sm-3 control-label">Salary:</label>
    <div class="col-sm-8">
        <span class="form-control">{{$salary}}</span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Already Paid:</label>
    <div class="col-sm-8">
        <span class="form-control">{{$paid}}</span>
    </div>
</div>

@if ($amount > 0)
    <div class="form-group">
        <label class="col-sm-3 control-label">Amount:</label>
        <div class="col-sm-8">
            <input class="form-control validate[custom[number]max[{{$amount}}]]" name="amount" value="{{$amount}}">
        </div>
    </div>
@else
    <input type="hidden" name="hide" value="true">
@endif