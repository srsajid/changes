<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 9:38 PM
 */

class Beneficiary extends Eloquent {
    public function salaries() {
        return $this->hasMany("Salary");
    }

    public function salaryHistories() {
            return $this->hasMany("SalaryHistory");
    }

    public function educations() {
        return $this->hasMany("Education");
    }
} 