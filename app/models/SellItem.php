<?php
/**
 * Created by PhpStorm.
 * User: Sajid
 * Date: 6/7/14
 * Time: 8:02 AM
 */

class SellItem extends Eloquent {
    public $timestamps = false;
    public function sell() {
        return $this->belongsTo("Sell");
    }
} 