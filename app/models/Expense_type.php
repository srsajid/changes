<?php
class Expense_type extends Eloquent{
    public function expense_entries() {
        return $this->hasMany('ExpenseEntry');
    }
    protected $table = 'expense_types';
    public $timestamps = false;
}