<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/14/14
 * Time: 11:45 PM
 */

class Category extends Eloquent {
    public function products() {
        return $this->hasMany('Product');
    }
}