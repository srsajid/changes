<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/30/14
 * Time: 12:19 AM
 */

class TransportFeeCount extends  Eloquent {
    public function fees() {
        return $this->hasMany("TransportFee");
    }

    public function student() {
        return $this->belongsTo("Student");
    }
} 