<?php
/**
 * Created by PhpStorm.
 * User: Rashad
 * Date: 9/20/14
 * Time: 1:40 PM
 */

class RegistrationController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('admin_user');
    }
    public function getTableView() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $text = "";
        if(Input::get("searchText")) {
            $query = $query."student_unique_id Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $reg = null;
        $total = 0;
        if(count($array) > 0 ) {
            $reg = Registration::whereRaw($query, $array)->take($max)->skip($offset);
            $total = Registration::whereRaw($query, $array)->count();
        } else {
            $reg = Registration::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = Registration::count();
        }
        $registrations = $reg->get();
        return View::make("registration.tableView", array(
            'registration' => $registrations,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text
        ));
    }

    public function getCreate(){
        $student = StudentInformation::all();
        $students = array('' => "None");
        foreach($student as $std) {
            $students[$std->id] = $std->student_id;
        }
        return View::make("registration.create",array('students' => $students));
    }

    public function getEdit()
    {
        $id = Input::get("id");
        $registration = null;
        $student = null;
        if($id){
            $registration = Registration::find($id);
            $student = StudentInformation::find($registration->student_id);
        }
        else{
            $registration = new Registration();
        }
        return View::make("registration.edit", array(
            'student' => $student,
            'registration' => $registration
        ));
    }

    public function postSave(){
        $rules = array(
            'student_id' => 'required',
            'has_transport' => 'required',
            'readmission' => 'required',
            'fee' => 'required',
            'clazz' => 'required',
            'tuition' => 'required'

        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $student_id = Input::get("student_id");
        $transport = Input::get("transport");
        $area = Input::get("area");
        $year = Input::get("year");
        $has_relative = Input::get("has_relative");
        $has_transport = Input::get("has_transport");
        $readmission = Input::get("readmission");
        $fee = Input::get("fee");
        $clazz = Input::get("clazz");
        $section = Input::get("section");
        $shift = Input::get("shift");
        $tuition = Input::get("tuition");
        $relative_student = Input::get("relative_student");
        $relative_student_class = Input::get("relative_student_class");
        $relative_student_section = Input::get("relative_student_section");
        $transportfee = Input::get("transportfee");
        $id = Input::get("id");


        $registration = null;
        $student = null;

        if($student_id){
            $student = StudentInformation::where('student_id' , '=', $student_id)->first();;
        }

        if($id){
            $registration = Registration::find($id);
        }
        else{
            $registration = new Registration();
        }
        if($has_relative == "Yes"){
            $registration->has_relative = 1;
        }
        else{
            $registration->has_relative = 0;
        }
        if($has_transport == "Yes"){
            $registration->has_transport = 1;
        }
        else{
            $registration->has_transport = 0;
        }
        if($readmission == "Yes"){
            $registration->is_readmission = 1;
        }
        else{
            $registration->is_readmission = 0;
        }
        $registration->student_id = $student->id;
        $registration->transport_fee = $transportfee;
        $registration->clazz = $clazz;
        $registration->section = $section;
        $registration->area = $area;
        $registration->shift = $shift;
        $registration->relative_id = $relative_student;
        $registration->relative_class = $relative_student_class;
        $registration->relative_section = $relative_student_section;
        $registration->fee = $fee;
        $registration->tuition_fee = $tuition;
        $registration->year = $year;
        $registration->student_unique_id = $student->student_id;
        if($registration->save()){
            return array('status' => 'success', 'message' => 'Registration has been saved successfully.');
        }
        else{
            return array('status' => 'error', 'message' => 'Registration Failed.');
        }
    }
}