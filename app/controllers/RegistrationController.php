<?php
/**
 * Created by PhpStorm.
 * User: Rashad
 * Date: 9/20/14
 * Time: 1:40 PM
 */

class RegistrationController extends \BaseController {

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
}