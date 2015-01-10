<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}expense/saveEx" method="post">
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
    <div class="form-group">
        <label class="col-sm-2 control-label">Amount</label>
        <div class="col-sm-10">
            <input type="text" name="amount" class="form-control" placeholder="Amount"  value="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="datepicker" name="date_ex" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-9 col-sm-1">
            <button type="submit" class="btn btn-default">Add Expense</button>
        </div>
    </div>
</form>