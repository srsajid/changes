<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class OthersController extends BaseController {

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $income_list = IncomeEntryService::getIncomesWithFilter();
        $total = IncomeEntryService::getCounts();
        return View::make("others.tableView", array(
            'incomeE' => $income_list,
            'total' => $total,
            'max' => $max,
            'offset' => $offset
        ));
    }

    public function getCreate() {
        $incomeAll = Income_type::all();
        $incomeTypes = array('' => "None");
        foreach($incomeAll as $inc) {
            if($inc->name == "Admission Form"){
                $incomeTypes[$inc->id] = $inc->name;
            }
            elseif($inc->name == "Readmission Form"){
                $incomeTypes[$inc->id] = $inc->name;
            }
            elseif($inc->name == "Transfer certificate"){
                $incomeTypes[$inc->id] = $inc->name;
            }
        }
        return View::make("others.create",array('incomeTypes' => $incomeTypes));
    }
}
