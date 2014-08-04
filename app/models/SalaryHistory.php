<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 10:22 PM
 */

class SalaryHistory extends Eloquent {
    protected $table = "salary_histories";

    public function beneficiary() {
        return $this->belongsTo("Beneficiary");
    }

    public function adjust_by() {
        return $this->belongsTo("User");
    }
}