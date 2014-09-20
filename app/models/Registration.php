<?php
class Registration extends Eloquent {
    public function registrations() {
        return $this->belongsTo("StudentInformation");
    }
    public function name(){
        return StudentInformation::find($this->student_id)->name;
    }
    protected $table = 'registrations';
    public $timestamps = false;
}