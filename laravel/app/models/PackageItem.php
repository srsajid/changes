<?php

class PackageItem extends Eloquent {
    protected $table = "package_items";

    public function product(){
        return $this->belongsTo("Product");
    }

    public function package(){
        return $this->belongsTo("Package");
    }
}