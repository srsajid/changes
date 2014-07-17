<?php
class AdmissionService {
    public static function getStudents() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."clazz Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $students = null;
        if(count($array) > 0 ) {
            $students = Student::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $students = Student::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $students->get();
    }

    public static function getCounts() {
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        if(count($array) > 0 ) {
            return Student::whereRaw($query, $array)->count();
        }
        return Student::count();
    }
}
