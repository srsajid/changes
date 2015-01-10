<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/30/14
 * Time: 4:08 PM
 */

class PackageService {
    public static function getPackages() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $packages = null;
        if(count($array) > 0 ) {
            $packages = Package::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $packages = Package::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $packages->get();
    }

    public static function getCounts() {
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        if(count($array) > 0 ) {
            return Package::whereRaw($query, $array)->count();
        }
        return Package::count();
    }

    public static function save($id, $name, $items, $quantities) {
        DB::transaction(function() use ($id, $name, $items, $quantities) {
            $size = count($items);
            $package = null;
            if($id) {
                $package = Package::find(intval($id));
            } else {
                $package = new Package();
            }
            $package->name = $name;
            $package->save();
            $package->items->each(function($item){
                $item->delete();
            });
            for($i=0; $i < $size; $i++) {
                $item = (int) $items[$i];
                $product = Product::find($item);
                $packageItem = new PackageItem();
                $packageItem->quantity = (int) $quantities[$i];
                $packageItem->product()->associate($product);
                $packageItem->package()->associate($package);
                $packageItem->save();
            }
        });
        return true;
    }
}