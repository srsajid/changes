<?php
class ExpenseEntry extends Eloquent{
    public function expenseType(){
        return $this->belongsTo("Expense_type");
    }
    protected $table = 'expense_entries';
    public $timestamps = false;
}