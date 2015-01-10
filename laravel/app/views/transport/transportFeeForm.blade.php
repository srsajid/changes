<form class="form-horizontal create-edit-form" action="{{OSMS::$baseUrl}}transport/take-transport" method="post">
    <div class="step-1 form-field">
        <div class="form-group">
            <label class="col-sm-3 control-label">Student Id:</label>
            <div class="col-sm-8">
               <input name="studentId" class="form-control validate[required]" placeholder="Student Id">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Year:</label>
            <div class="col-sm-8">
                {{ Form::selectYear('year', 2014, 2016, null, array('class' => 'form-control')) }}
            </div>
        </div>
    </div>
    <div class="step-2 form-field">

    </div>
    <div class="form-group">
        <div class="step-1">
            <div class="col-sm-offset-8 col-sm-3" id="next">
                <button type="button" class="form-control">Next</button>
            </div>
        </div>
        <div class="step-2">
            <div class="col-sm-offset-5 col-sm-3" id="previous">
                <button type="button" class="form-control">Previous</button>
            </div>
            <div class="col-sm-3" style="">
                <button type="submit" class="form-control">Create</button>
            </div>
        </div>
    </div>
</form>