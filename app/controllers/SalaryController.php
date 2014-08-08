<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/8/14
 * Time: 1:10 PM
 */

class SalaryController extends BaseController {
    public function __construct() {
        $this->beforeFilter('admin', array('only' => array("postPaySalary")));
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $text = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $salaries = null;
        $total = 0;
        if(count($array) > 0 ) {
            $salaries = Salary::whereRaw($query, $array)->take($max)->skip($offset);
            $total = Salary::whereRaw($query, $array)->count();
        } else {
            $salaries = Salary::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = Salary::count();
        }
        $salaries = $salaries->get();
        return View::make("salary.tableView", array(
            'salaries' => $salaries,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text
        ));
    }

} 