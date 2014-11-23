
<?php
Class AdmissionController extends BaseController {

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
            $student = StudentInformation::find($id);
        }
        else{
            $student = new StudentInformation();
        }
        $absoulate_path = public_path();
        $student_img = null;
        $father_img = null;
        $mother_img = null;
        $guardian_img = null;
        $path = $absoulate_path .'\\Photos\\'. $student->student_id .'\\*.*';
        $files = glob($path);
        $imagePath = OSMS::$baseUrl."/Photos/".$student->student_id."/";
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
        $id  = Input::get("id");
        $rules = null;
        if($id){
            $rules = array(
                'student_ID' => 'required|AlphaNum',
                'student_name' => 'required'
            );
        }
        else{
            $rules = array(
                'student_ID' => 'required|AlphaNum|unique:student_informations,student_id',
                'student_name' => 'required'
            );
        }
        $registration = null;

        $student = null;
        if($id){
            $student = StudentInformation::find($id);
        }
        else{
            $student = new StudentInformation();
        }
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $student_img = Input::file("student_image");
        $father_img = Input::file("father_image");
        $mother_img = Input::file("mother_image");
        $guardian_img = Input::file("guardian_image");
        $area = Input::get("area");
        $student_id = Input::get("student_ID");
        $name = Input::get("student_name");
        $father_name = Input::get("father_name");
        $tuition = Input::get("tuition");
        $mother_name = Input::get("mother_name");
        $guardian_name = Input::get("guardian_name");
        $birth = DateTime::createFromFormat('d-m-Y',Input::get("date_birth"));
        $gender = Input::get("gender");
        $nationality = Input::get("nationality");
        $religion = Input::get("religion");
        $address = Input::get("address");
        $contact_number = Input::get("contact_number");
        $email_address = Input::get("email");

        $absoulate_path = public_path();
        $path = $absoulate_path .'/Photos/'. $student_id .'/';
        $filenameS = null;
        $temp_name = null;
        $extension = null;
        $full_nameS = null;
        $upload_success = null;
        if($student_img){
            $student->student_img = $full_nameS;
            $filenameS = $student_img->getClientOriginalName();
            $temp_name = 'student';
            $extension =$student_img->getClientOriginalExtension();
            $full_nameS = $temp_name. '.' .$extension;
            $upload_success = $student_img->move($path, $full_nameS);
        }
        $filenameF = null;
        $full_nameF = null;
        if($father_img){
            $student->father_img = $full_nameF;
            $filenameF = $father_img->getClientOriginalName();
            $temp_name = 'father';
            $extension =$father_img->getClientOriginalExtension();
            $full_nameF = $temp_name. '.' .$extension;
            $upload_success = $father_img->move($path, $full_nameF);
        }
        $filenameM = null;
        $full_nameM = null;
        if($mother_img){
            $student->mother_img = $full_nameM;
            $filenameM = $mother_img->getClientOriginalName();
            $temp_name = 'mother';
            $extension =$mother_img->getClientOriginalExtension();
            $full_nameM = $temp_name. '.' .$extension;
            $upload_success = $mother_img->move($path, $full_nameM);
        }
        $filenameG = null;
        $full_nameG = null;
        if($guardian_img){
            $student->guardian_img = $full_nameG;
            $filenameG = $guardian_img->getClientOriginalName();
            $temp_name = 'guardian';
            $extension =$guardian_img->getClientOriginalExtension();
            $full_nameG = $temp_name. '.' .$extension;
            $upload_success = $guardian_img->move($path, $full_nameG);
        }
        $student->student_id = $student_id;
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
        $student->save();
        return array('status' => 'success', 'message' => 'Student has been saved successfully.');
    }
}