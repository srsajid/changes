<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/3/2015
 * Time: 12:39 PM
 */

class Education extends Eloquent {
    public  $timestamps = false;

    public function beneficiary() {
        return $this->belongsTo('Beneficiary');
    }
} 