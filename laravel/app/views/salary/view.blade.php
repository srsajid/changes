<form class="form-horizontal" target="_blank" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->beneficiary->name; }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Month:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->month; }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Year:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->year; }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Amount:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->amount; }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Given By:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->givenBy->getFullName();}}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Extra Payment:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->extra_payment;}}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Deduction:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->deduction;}}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Comment:</label>
        <div class="col-sm-8">
            <span class="form-control">{{$salary->comment;}}</span>
        </div>
    </div>
</form>