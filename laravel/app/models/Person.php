<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/14/14
 * Time: 10:11 PM
 */

class Person extends Eloquent{
    protected $table = 'user';
    protected $fillable = array('name', 'email');
    public $timestamps = false;
} 