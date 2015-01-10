<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/30/14
 * Time: 12:19 AM
 */

class TuitionFee extends Eloquent {

    public function tuitionFeeCount() {
        return $this->belongsTo("TuitionFeeCount", "tuition_fee_count_id");
    }

    public function collectedBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function studentInformation() {
        return $this->belongsTo("StudentInformation");
    }

    public function getTotal() {
        return $this->amount + $this->fine - $this->discount;
    }
} 