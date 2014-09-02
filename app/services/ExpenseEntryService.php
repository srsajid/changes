<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:22 PM
 */

class ExpenseEntryService {
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
            $expenses = ExpenseEntry::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $expenses = ExpenseEntry::take($max)->skip($offset)->orderBy('id', "ASC");
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
            return ExpenseEntry::whereRaw($query, $array)->count();
        }
        return ExpenseEntry::count();
    }

    public static function saveExpenseEntry( $type, $amount, $expense_type ) {
        DB::transaction(function() use ($type, $amount, $expense_type){
            $expense = null;
            $expense = new ExpenseEntry();
            $expense->expense_type_id = $expense_type;
            $expense->amount = $amount;
            $expense->save();
        });
        return true;
    }
}