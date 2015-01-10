<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/14/14
 * Time: 11:51 PM
 */

class Product extends Eloquent {
    public function category(){
        return $this->belongsTo("Category");
    }
    public function inventoryHistory() {
        return $this->hasMany("InventoryHistory");
    }
} 