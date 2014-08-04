<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 10:00 PM
 */

class LoanGiven extends Eloquent {
    protected $table = "loan_given";

    public function payments() {
        return $this->hasMany("LoanPaymentBack");
    }

    public function given_by() {
        return $this->belongsTo("User");
    }

    public function given_to() {
        return $this->belongsTo("Beneficiary");
    }
} 