<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:16 PM
 */
class Income_type extends Eloquent{
    public function income_entries() {
        return $this->hasMany('IncomeEntry');
    }
    protected $table = 'income_types';
    public $timestamps = false;
}