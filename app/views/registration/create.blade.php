
<form class="form-horizontal create-edit-form registration-form" role="form" action="<?php echo OSMS::$baseUrl;?>registration/save">
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>


    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Student ID</label>
        <div class="form-group col-sm-10">
            {{ Form::select("student_id", $students, null, array("class" => 'chosen form-control')) }}
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Year</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="year" placeholder="Year">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Readmission</label>
        <div class="col-sm-10">
            <select class="form-control" name="readmission">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Admission /Readmission fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="fee" placeholder="Admission/Readmission fee">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Recommended to Class</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="clazz" placeholder="Class">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Section</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="section" placeholder="Section">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Shift</label>
        <div class="col-sm-10">
            <select class="form-control" name="shift">
                <option value="Morning">Morning</option>
                <option value="Day">Day</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tuition Fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tuition" placeholder="Tuition Fee">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Has Relative Student</label>
        <div class="col-sm-10">
            <select class="form-control" name="has_relative">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Id</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student" placeholder="Relative SID">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Class</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student_class" placeholder="Relative Student Class">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Section</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student_section" placeholder="Relative Student Section">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Has Transport Service</label>
        <div class="col-sm-10">
            <select class="form-control" name="has_transport">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="area" placeholder="Area">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Transport Fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="transportfee" placeholder="Transport Fee">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
