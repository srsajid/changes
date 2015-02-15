<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:22 PM
 */

class IncomeService {
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
            $incomes = Income_type::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $incomes = Income_type::take($max)->skip($offset)->orderBy('id', "DESC");
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
            return Income_type::whereRaw($query, $array)->count();
        }
        return Income_type::count();
    }

    public static function saveIncomeType($id, $name, $description) {
        DB::transaction(function() use ($id, $name, $description){
            $income = null;
            if($id){
                $income = Income_type::find($id);
            }
            else{
                $income = new Income_type();
            }
            $income->name = $name;
            $income->description = $description;
            $income->status = "Y";
            $income->save();
        });
        return true;
    }
}