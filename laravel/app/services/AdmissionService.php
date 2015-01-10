<?php
class AdmissionService {
    public static function getStudents() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."student_id Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $students = null;
        if(count($array) > 0 ) {
            $students = StudentInformation::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $students = StudentInformation::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $students->get();
    }

    public static function getCounts() {
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."student_id Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        if(count($array) > 0 ) {
            return StudentInformation::whereRaw($query, $array)->count();
        }
        return StudentInformation::count();
    }
}
