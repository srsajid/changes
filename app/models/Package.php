<?php

class Package extends Eloquent {
    public function items() {
        return $this->hasMany('PackageItem');
    }
}