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

    public function givenBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function givenTo() {
        return $this->belongsTo("Beneficiary", "beneficiary_id");
    }
} 