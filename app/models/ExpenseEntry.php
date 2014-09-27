<?php
class ExpenseEntry extends Eloquent{
    protected $table = 'expense_entries';

    public function expenseType(){
        return $this->belongsTo("Expense_type");
    }

    public function name(){
        return Expense_type::find($this->expense_type_id)->name;
    }
}