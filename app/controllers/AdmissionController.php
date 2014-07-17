<?php
Class AdmissionController extends BaseController{
    public function loadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $students = AdmissionService::getStudents();
        $total = AdmissionService::getCounts();
        return View::make("admission.tableView", array(
            'students' => $students,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function create()
    {
        return View::make("admission.create");
    }

    public function edit()
    {
        $id = Input::get("id");
        $student = null;
        if($id){
            $student = Student::find($id);
        }
        else{
            $student = new Student();
        }
        $absoulate_path = public_path();
        $student_img = null;
        $father_img = null;
        $mother_img = null;
        $guardian_img = null;
        $path = $absoulate_path .'\\Photos\\'. $student->sid .'\\*.*';
        $files = glob($path);
        $imagePath = OSMS::$baseUrl."/Photos/".$student->sid."/";
        foreach($files as $f){
            if(basename($f) == "father.jpg"){
                $father_img = $imagePath.$student->father_img;
            }
            else if(basename($f) == "mother.jpg"){
                $mother_img = $imagePath.$student->mother_img;
            }
            else if(basename($f) == "student.jpg"){
                $student_img = $imagePath.$student->student_img;
            }
            else if(basename($f) == "guardian.jpg"){
                $guardian_img = $imagePath.$student->guardian_img;
            }
        }
        return View::make("admission.edit", array(
            'student_img' => $student_img,
            'father_img' => $father_img,
            'mother_img'  => $mother_img,
            'guardian_img' => $guardian_img,
            'student' => $student,
        ));
    }

    public function save()
    {
        $student_img = Input::file("student_image");
        $father_img = Input::file("father_image");
        $mother_img = Input::file("mother_image");
        $guardian_img = Input::file("guardian_image");
        $id  = Input::get("id");
        $student_id = Input::get("student_ID");
        $name = Input::get("student_name");
        $father_name = Input::get("father_name");
        $mother_name = Input::get("mother_name");
        $guardian_name = Input::get("guardian_name");
        $birth = DateTime::createFromFormat('d-m-Y',Input::get("date_birth"));
        $gender = Input::get("gender");
        $nationality = Input::get("nationality");
        $religion = Input::get("religion");
        $address = Input::get("address");
        $contact_number = Input::get("contact_number");
        $email_address = Input::get("email");
        $transport = Input::get("transport");
        $clazz = Input::get("clazz");
        $section = Input::get("section");
        $shift = Input::get("shift");
        $rsidn = Input::get("rsidn");
        $rsidclass = Input::get("rsidclass");
        $rsidsection = Input::get("rsidsection");
        $transportfee = Input::get("transportfee");
        $readm = Input::get("readmission");
        $hasEntry = Student::find($student_id);
        if($hasEntry){
            return array('status' => 'error', 'message' => 'Student exists!');
        }
        $absoulate_path = public_path();
        $path = $absoulate_path .'/Photos/'. $student_id .'/';
        $filenameS = null;
        $temp_name = null;
        $extension = null;
        $full_nameS = null;
        $upload_success = null;
        if($student_img){
            $filenameS = $student_img->getClientOriginalName();
            $temp_name = 'student';
            $extension =$student_img->getClientOriginalExtension();
            $full_nameS = $temp_name. '.' .$extension;
            $upload_success = $student_img->move($path, $full_nameS);
        }
        $filenameF = null;
        $full_nameF = null;
        if($father_img){
            $filenameF = $father_img->getClientOriginalName();
            $temp_name = 'father';
            $extension =$father_img->getClientOriginalExtension();
            $full_nameF = $temp_name. '.' .$extension;
            $upload_success = $father_img->move($path, $full_nameF);
        }
        $filenameM = null;
        $full_nameM = null;
        if($mother_img){
            $filenameM = $mother_img->getClientOriginalName();
            $temp_name = 'mother';
            $extension =$mother_img->getClientOriginalExtension();
            $full_nameM = $temp_name. '.' .$extension;
            $upload_success = $mother_img->move($path, $full_nameM);
        }
        $filenameG = null;
        $full_nameG = null;
        if($guardian_img){
            $filenameG = $guardian_img->getClientOriginalName();
            $temp_name = 'guardian';
            $extension =$guardian_img->getClientOriginalExtension();
            $full_nameG = $temp_name. '.' .$extension;
            $upload_success = $guardian_img->move($path, $full_nameG);
        }
        $student = null;
        if($id){
            $student = Student::find($id);
        }
        else{
            $student = new Student();
            if($readm == 'Yes'){
                $readmission = new ReAdmission();
                $readmission->date_of_readmission = date("m/d/Y h:i:s a", time());
                $readmission->sid = $student_id;
                $readmission->save();
            }
            else{
                $admission = new Admission();
                $admission->date_of_admission = date("m/d/Y h:i:s a", time());
                $admission->sid = $student_id;
                $admission->save();
            }
        }
        $student->sid = $student_id;
        $student->name = $name;
        $student->father_name = $father_name;
        $student->mother_name = $mother_name;
        $student->guardian_name = $guardian_name;
        $student->date_of_birth = $birth;
        $student->gender = $gender;
        $student->nationality = $nationality;
        $student->religion = $religion;
        $student->address = $address;
        $student->contact_number = $contact_number;
        $student->email = $email_address;
        $student->student_img = $full_nameS;
        $student->father_img = $full_nameF;
        $student->mother_img = $full_nameM;
        $student->guardian_img = $full_nameG;
        if($transport == 'No'){
            $student->hasTransport = false;
        }
        else{
            $student->hasTransport = true;
        }
        $student->transport_cost = $transportfee;
        $student->clazz = $clazz;
        $student->shift = $shift;
        $student->section = $section;
        if($rsidn){
            $student->has_rid = true;
        }
        else{
            $student->has_rid = false;
        }
        $student->rid_class = Input::get("rsidclass");
        $student->rid_section = Input::get("rsidsection");
        $student->rid = $rsidn;
        $student->save();
        return array('status' => 'success', 'message' => 'Student has been saved successfully.');
    }
}