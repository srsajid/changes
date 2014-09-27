<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class ExpenseEntryController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('super_admin', array('except' => array("loadTable")));
    }
    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $expense_list = ExpenseEntryService::getExpenses();
        $total = ExpenseEntryService::getCounts();
        return View::make("expenseEntry.tableView", array(
            'expenseE' => $expense_list,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function getCreate() {
        $expenseAll = Expense_type::all();
        $expenseTypes = array('' => "None");
        foreach($expenseAll as $exp) {
            $expenseTypes[$exp->id] = $exp->name;
        }
        return View::make("expenseEntry.create",array('expenseTypes' => $expenseTypes));
    }

    public function postSave()
    {
        $rules = array(
            'expenseType' => 'required',
            'amount' => 'required'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $id = Input::get("expenseType");
        $amount = Input::get("amount");
        $expense_type_id = Input::get("expenseType");
        if(ExpenseEntryService::saveExpenseEntry($id,$amount,$expense_type_id)){
            return array('status' => 'success', 'message' => 'Expense entry has been successfully saved');
        }
        else{
            return array('status' => 'error', 'message' => 'Expense entry not added');
        }
    }
    public function getDateselect() {
        return View::make("expenseEntry.dateSelection");
    }

    public function postReport(){
        $from = Input::get("from");
        $to = Input::get("to");
        $array = array();
        $query= "";
        $flag = false;
        if($from) {
            array_push($array, new DateTime($from."00:00:00"));
            $query = $query."created_at >= ?";
            $flag = true;
        }
        if($to) {
            array_push($array, new DateTime($to."23:59:59"));
            $query = $query.($flag ? " and " : "");
            $query = $query."created_at <= ?";
        }
        if(strlen($query) <= 0) {
            return "invalid query";
        }
        $expenses = ExpenseEntry::whereRaw($query, $array)->orderBy('created_at', 'ASC')->get();
        /*$allIncome = (array) null;
        foreach($incomes as $inc) {
            $allIncome[$inc->name()] = $inc->amount;
        }*/
        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html =  View::make("expenseEntry.report", array('expenses' => $expenses, 'to' => $to, 'from' => $from));
        return $html;
    }
}
