
<form class="form-horizontal create-edit-form registration-form" role="form" action="<?php echo OSMS::$baseUrl;?>registration/save" method="post">
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
    <input type="hidden" name="id" id="id" value="<?php echo $registration->id;?>">

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Student ID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="student_id" placeholder="Student ID" value="<?php echo $student->student_id;?>">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Year</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="year" placeholder="Year" value="<?php echo $registration->year;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Readmission</label>
        <div class="col-sm-10">
            <select class="form-control" name="readmission">
                @if($registration->is_readmission == 1)
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                @else
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Admission /Readmission fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="fee" placeholder="Admission/Readmission fee" value="<?php echo $registration->fee;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Recommended to Class</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="clazz" placeholder="Class" value="<?php echo $registration->clazz;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Section</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="section" placeholder="Section" value="<?php echo $registration->section;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Shift</label>
        <div class="col-sm-10">
            <select class="form-control" name="shift">
                @if($registration->shift == "Morning")
                    <option value="Morning">Morning</option>
                    <option value="Day">Day</option>
                @elseif($registration->shift == "Day")
                    <option value="Day">Day</option>
                    <option value="Morning">Morning</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tuition Fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tuition" placeholder="Tuition Fee" value="<?php echo $registration->tuition_fee;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Has Relative Student</label>
        <div class="col-sm-10">
            <select class="form-control" name="has_relative">
                @if($registration->has_relative == 1)
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                @elseif($registration->has_relative == 0)
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                @endif

            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Id</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student" placeholder="Relative SID" value="<?php echo $registration->relative_id;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Class</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student_class" placeholder="Relative Student Class" value="<?php echo $registration->relative_class;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Relative Student Section</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="relative_student_section" placeholder="Relative Student Section" value="<?php echo $registration->relative_section;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Has Transport Service</label>
        <div class="col-sm-10">
            <select class="form-control" name="has_transport">
                @if($registration->has_transport == 1)
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                @else
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="area" placeholder="Area" value="<?php echo $registration->area;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Transport Fee</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="transportfee" placeholder="Transport Fee" value="<?php echo $registration->transport_fee;?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
