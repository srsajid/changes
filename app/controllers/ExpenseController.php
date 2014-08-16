<?php
class ExpenseController extends BaseController {
    public function loadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $expense_list = ExpenseService::getExpenses();
        $total = ExpenseService::getCounts();
        return View::make("expense.tableView", array(
            'expenses' => $expense_list,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function create() {
        return View::make("expense.create");
    }
}