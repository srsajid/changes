<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/19/2014
 * Time: 12:03 AM
 */

class Permission extends Eloquent {
    public $timestamps = false;
    protected $fillable = array('controller', 'action', "user_id");

    public function user() {
        return $this->belongsTo("User");
    }
} 