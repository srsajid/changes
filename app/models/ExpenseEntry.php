<?php
class ExpenseEntry extends Eloquent{
    protected $table = 'expense_entries';
    public $timestamps = false;

    public function expenseType(){
        return $this->belongsTo("Expense_type");
    }
}