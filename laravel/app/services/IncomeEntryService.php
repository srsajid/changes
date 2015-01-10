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
            $text = trim(Input::get("searchText"));
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

    public static function getIncomesWithFilter() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $admission = Income_type::where('name','=','Admission Form')->get()->first();
        $readmission = Income_type::where('name','=','Readmission Form')->get()->first();
        $transfer = Income_type::where('name','=','Transfer certificate')->get()->first();
        $incomes = null;
        if($admission && $readmission && $transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$readmission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif($admission && $readmission && !$transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$readmission->id)->take($max)->skip($offset);
        }
        elseif($admission && !$readmission && $transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif($admission && !$readmission && !$transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$admission->id)->take($max)->skip($offset);
        }
        elseif(!$admission && $readmission && $transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$readmission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif(!$admission && $readmission && !$transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$readmission->id)->take($max)->skip($offset);
        }
        elseif(!$admission && !$readmission && $transfer){
            $incomes = IncomeEntry::where('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif(!$admission && !$readmission && !$transfer){
            return $incomes;
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

    public static function saveIncomeEntry( $type, $amount, $income_type ) {
        DB::transaction(function() use ($type, $amount, $income_type){
            $user = Auth::user();
            $income = new IncomeEntry();
            $income->income_type_id = $income_type;
            $income->user_id = $user->id;
            $income->amount = $amount;
            $income->save();
        });
        return true;
    }
}