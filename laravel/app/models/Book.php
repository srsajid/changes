<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/19/14
 * Time: 9:57 PM
 */

class Book extends Eloquent {
    public $timestamps = false;
    public function authors() {
        return $this->belongsToMany('Author');
    }
} 