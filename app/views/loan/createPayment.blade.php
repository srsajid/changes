<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}loan/save-payment" method="post">
    <input type="hidden" name="id" value="{{$loan->id}}">
    <div class="form-group">
        <label class="col-sm-4">Loan Amount:</label>
        <div class="col-sm-7">
            <p class="form-control-static">{{$loan->amount}}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4">Already Payment taken:</label>
        <div class="col-sm-7">
            <p class="form-control-static">{{$loan->amount}}</p>
        </div>
    </div>
    @if ($loan->amount > $loan->paid)
        <div class="form-group">
            <label class="col-sm-4">Loan Payment Amount:</label>
            <div class="col-sm-7">
                <input class="form-control validate[required, custom[number], max[{{$loan->amount - $loan->paid}}]]" value="{{$loan->amount - $loan->paid}}" name="loan_payment">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-3">
                <button type="submit" class="form-control">Take</button>
            </div>
        </div>
    @endif
</form>