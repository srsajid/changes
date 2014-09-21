<?php
class IncomeEntry extends Eloquent{
    public function incomeType(){
        return $this->belongsTo("Income_type");
    }

    public function name(){
        return Income_type::find($this->income_type_id)->name;
    }

    protected $table = 'income_entries';
}