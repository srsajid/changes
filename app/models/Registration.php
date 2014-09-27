<?php
class Registration extends Eloquent {
    protected $table = 'registrations';
    public $timestamps = false;

    public function registrations() {
        return $this->belongsTo("StudentInformation");
    }

    public function name(){
        return StudentInformation::find($this->student_id)->name;
    }
}