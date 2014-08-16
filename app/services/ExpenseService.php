<?php
class ExpenseService {
    public static function getExpenses() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $expenses = null;
        if(count($array) > 0 ) {
            $expenses = Expense_type::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $expenses = Expense_type::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $expenses->get();
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
            return Expense_type::whereRaw($query, $array)->count();
        }
        return Expense_type::count();
    }
}