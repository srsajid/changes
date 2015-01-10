<form class="form-horizontal" action="<?php echo OSMS::$baseUrl;?>salary/report" target="_blank" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Month:</label>
        <div class="col-sm-8">
            {{Form::selectMonth("month", null, array('class' => 'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Year:</label>
        <div class="col-sm-8">
            {{ Form::selectYear('year', 2013, 2015, null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Generate</button>
        </div>
    </div>
</form>