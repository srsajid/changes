<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/18/14
 * Time: 2:39 AM
 */

class InventoryHistory extends Eloquent{
    protected $table = 'inventory_histories';
    public function product() {
        return $this->belongsTo("Product");
    }
    public function user() {
        return $this->belongsTo("User");
    }
} 