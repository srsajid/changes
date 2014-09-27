<div class="form-group">
    <label class="col-sm-4 control-label">Per Month Transport Fee:</label>
    <div class="col-sm-7">
        <span class="form-control per-month-transport">{{$registration->transport_fee}}</span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-4 control-label">Already Paid for:</label>
    <div class="col-sm-7">
        <span class="form-control">{{$transportCount->month_count}} Month(s)</span>
    </div>
</div>

@if ($transportCount->month_count < 12)
    <div class="form-group">
        <label class="col-sm-4 control-label">No of Month:</label>
        <div class="col-sm-7">
            {{ Form::selectYear('monthCount', 1, 12 - $transportCount->month_count, null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Discount:</label>
        <div class="col-sm-7">
            <input class="form-control validate[custom[number]]" name="discount" value="0" placeholder="Discount">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Fine:</label>
        <div class="col-sm-7">
            <input class="form-control validate[custom[number]]" name="fine" value="0" placeholder="Discount">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4">Total:</label>
        <div class="col-sm-7">
            <span class="form-control total-transport"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Comment:</label>
        <div class="col-sm-7">
            <textarea class="form-control" name="comment"></textarea>
        </div>
    </div>

@else
    <input type="hidden" name="hide" value="true">
@endif