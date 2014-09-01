<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class IncomeEntryController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('super_admin', array('except' => array("loadTable")));
    }
    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $income_list = IncomeEntryService::getIncomes();
        $total = IncomeEntryService::getCounts();
        return View::make("incomeEntry.tableView", array(
            'income' => $income_list,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function getCreate() {
        return View::make("income.create");
    }
    public function getEdit() {
        $id = Input::get("id");
        $income = Income_type::find($id);
        return View::make("income.edit", array(
            'income' => $income,
        ));
    }

    public function postSave()
    {
        $rules = array(
            'name' => 'required'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $id = Input::get("id");
        $name = Input::get("name");
        $description = Input::get("description");
        if(IncomeService::saveIncomeType($id,$name,$description)){
            return array('status' => 'success', 'message' => 'Income type has been successfully saved');
        }
        else{
            return array('status' => 'error', 'message' => 'Income type not added');
        }
    }
}
