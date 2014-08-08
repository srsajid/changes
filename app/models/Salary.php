<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 9:46 PM
 */

class Salary extends Eloquent {

    public function givenBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function beneficiary() {
        return $this->belongsTo("Beneficiary");
    }
} 