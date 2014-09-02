<?php
class IncomeEntry extends Eloquent{
    public function incomeType(){
        return $this->belongsTo("Income_type");
    }
    protected $table = 'income_entries';
    public $timestamps = false;
}