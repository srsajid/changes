<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:22 PM
 */

class IncomeEntryService {
    public static function getIncomes() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $incomes = null;
        if(count($array) > 0 ) {
            $incomes = IncomeEntry::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $incomes = IncomeEntry::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $incomes->get();
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
            return IncomeEntry::whereRaw($query, $array)->count();
        }
        return IncomeEntry::count();
    }

    public static function saveIncomeEntry($type, $amount) {
        DB::transaction(function() use ($type, $amount){
            $income = null;
            $income = new IncomeEntry();
            $income->amount = $amount;
            $income->save();
        });
        return true;
    }
}