<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:12 PM
 */
class IncomeController extends BaseController {
    public function loadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $income_list = IncomeService::getIncomes();
        $total = IncomeService::getCounts();
        return View::make("income.tableView", array(
            'income' => $income_list,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function create() {
        return View::make("income.create");
    }
    public function edit() {
        $id = Input::get("id");
        $income = Income_type::find($id);
        return View::make("income.edit", array(
            'income' => $income,
        ));
    }

    public function save()
    {
        $rules = array(
            'name' => 'required|unique:income_types,name'
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