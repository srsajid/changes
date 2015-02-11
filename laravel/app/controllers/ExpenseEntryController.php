<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class ExpenseEntryController extends BaseController {

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
            $query = $query."expense_entries.created_at >= ?";
            $flag = true;
        }
        if($to) {
            array_push($array, new DateTime($to."23:59:59"));
            $query = $query.($flag ? " and " : "");
            $query = $query."expense_entries.created_at <= ?";
        }
        if(strlen($query) <= 0) {
            return "invalid query";
        }
        $testExp = DB::table("expense_entries")->select(DB::raw("expense_types.name as typeName, sum(expense_entries.amount) as amount"))->join("expense_types","expense_entries.expense_type_id","=","expense_types.id")->whereRaw($query, $array)->groupBy("expense_entries.expense_type_id")->get();
//        $expenses = ExpenseEntry::whereRaw($query, $array)->orderBy('created_at', 'ASC')->get();
        /*$allIncome = (array) null;
        foreach($incomes as $inc) {
            $allIncome[$inc->name()] = $inc->amount;
        }*/
//        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html =  View::make("expenseEntry.report", array('expenses' => $testExp, 'to' => $to, 'from' => $from));
        return $html;
    }
}
