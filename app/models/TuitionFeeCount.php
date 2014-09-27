<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/30/14
 * Time: 12:18 AM
 */

class TuitionFeeCount extends Eloquent {
    protected $table = "tuition_fee_counts";

    public function fees() {
        return $this->hasMany("TuitionFee");
    }

    public function studentInformation() {
        return$this->belongsTo("StudentInformation");
    }
} 