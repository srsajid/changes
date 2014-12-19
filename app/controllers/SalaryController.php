<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/8/14
 * Time: 1:10 PM
 */

class SalaryController extends BaseController {

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

    public function getReportForm() {
        return View::make("salary.reportForm");
    }

    public function postReport() {
        $year = Input::get("year");
        $month = Input::get("month");
        $salaries = DB::table("salaries")->select(DB::raw("beneficiaries.name as name, sum(salaries.amount) as amount, sum(salaries.extra_payment) as extra, sum(salaries.deduction) as deduction"))->join("beneficiaries", "salaries.beneficiary_id", "=", "beneficiaries.id")->where("salaries.year", "=", $year)->where("month", "=", $month)->groupBy("salaries.beneficiary_id")->get();
        return View::make("salary.report", array("year" => $year, "month" =>  $month, "salaries" => $salaries));
    }

    public function getView() {
        $salary = Salary::find(intval(Input::get("id")));
        return View::make("salary.view", array("salary" => $salary));
    }
} 