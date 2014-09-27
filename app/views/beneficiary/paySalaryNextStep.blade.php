<div class="form-group">
    <label class="col-sm-4 control-label">Salary:</label>
    <div class="col-sm-7">
        <span class="form-control">{{$salary}}</span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-4 control-label">Already Paid:</label>
    <div class="col-sm-7">
        <span class="form-control">{{$paid}}</span>
    </div>
</div>

@if ($amount > 0)
    <div class="form-group">
        <label class="col-sm-4 control-label">Amount:</label>
        <div class="col-sm-7">
            <input class="form-control validate[custom[number]max[{{$amount}}]]" name="amount" value="{{$amount}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Extra Payment:</label>
        <div class="col-sm-7">
            <input class="form-control validate[custom[number]min[0]]" name="extra" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Deduction:</label>
        <div class="col-sm-7">
            <input class="form-control validate[custom[number]min[0]]" name="deduction" value="0">
        </div>
    </div>

    @if ($loan > 0 )
        <div class="form-group">
            <label class="col-sm-4 control-label">Loan:</label>
            <div class="col-sm-7">
                <input class="form-control disabled" value="{{$loan}}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Loan Payment Amount:</label>
            <div class="col-sm-7">
                <input class="form-control validate[custom[number]max[{{$loan}}]]" name="loan_payment">
            </div>
        </div>
    @endif
    <div class="form-group">
        <label class="col-sm-4 control-label">Comment:</label>
        <div class="col-sm-7">
            <textarea class="form-control validate[maxSize[225]]" name="comment"></textarea>
        </div>
    </div>
@else
    <input type="hidden" name="hide" value="true">
@endif