<?php
class Registration extends Eloquent {
    public function registrations() {
        return $this->belongsTo("StudentInformation");
    }
    protected $table = 'registrations';
    public $timestamps = false;
}