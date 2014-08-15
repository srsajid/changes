<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 10:12 PM
 */

class LoanPaymentBack extends Eloquent {
    protected $table = "loan_payment_back";

    public function loan() {
        return $this->belongsTo("LoanGiven", "load_given_id");
    }

    public function collect_by() {
        return $this->belongsTo("User", "user_id");
    }
} 