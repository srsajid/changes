<?php
class StudentInformation extends Eloquent {
    public function registrations() {
        return $this->hasMany('Registration');
    }
    protected $table = 'student_informations';
    public $timestamps = false;
}