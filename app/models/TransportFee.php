<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/30/14
 * Time: 12:19 AM
 */

class TransportFee extends Eloquent {

    public function transportFeeCount() {
        return $this->belongsTo("TransportFeeCount", "transport_fee_count_id");
    }

    public function collectedBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function student() {
        return $this->belongsTo("Student");
    }

    public function getTotal() {
        return $this->amount + $this->fine - $this->discount;
    }
} 