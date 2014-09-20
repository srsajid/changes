
<form class="form-horizontal create-edit-form admission-form" role="form" action="admission/save" method="post" enctype="multipart/form-data">
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>

    <div class="form-group">
        <div class="col-sm-3">
            <img src="<?php echo $student_img;?>" class="student_image thumbnail" alt="Student Image">
            <input type="file" name="student_image" title="Choose Student Image">
        </div>
        <div class="col-sm-3">
            <img src="<?php echo $father_img;?>" class="thumbnail father_image" alt="Father Image">
            <input type="file" name="father_image" title="Choose Father Image">
        </div>
        <div class="col-sm-3">
            <img src="<?php echo $mother_img;?>" class="thumbnail mother_image" alt="Mother Image">
            <input type="file" name="mother_image" title="Choose Mother Image">
        </div>
        <div class="col-sm-3">
            <img src="<?php echo $guardian_img;?>" class="thumbnail guardian_image" alt="Guardian Image">
            <input type="file" name="guardian_image" title="Choose Guardians Image">
        </div>

    </div>
    <input type="hidden" name="id" id="id" value="<?php echo $student->id;?>">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label" >Student ID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" style="text-transform: uppercase" name="student_ID" placeholder="Student ID" value="<?php echo $student->student_id;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Student Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="student_name" placeholder="Student Name" value="<?php echo $student->name;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Fathers Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="father_name" placeholder="Fathers Name" value="<?php echo $student->father_name;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Mothers Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="mother_name" placeholder="Mothers Name" value="<?php echo $student->mother_name;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Guardian Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="guardian_name" placeholder="Guardian Name" value="<?php echo $student->guardian_name;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Date of Birth</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="datepicker" name="date_birth" placeholder="" value="<?php echo $student->date_of_birth;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
        <div class="col-sm-10">
            <select class="form-control" name="gender" value="<?php echo $student->gender;?>">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nationality</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nationality" placeholder="Nationality" value="<?php echo $student->nationality;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Religion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="religion" placeholder="Religion" value="<?php echo $student->religion;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Correspondence Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $student->address;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Contact Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" value="<?php echo $student->contact_number;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $student->email;?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
