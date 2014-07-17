<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/18/14
 * Time: 1:03 PM
 */

class ProductService {
    public static function getProducts() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $products = null;
        if(count($array) > 0 ) {
            $products = Product::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $products = Product::take($max)->skip($offset)->orderBy('id', "ASC");
        }
        return $products->get();
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
           return Product::whereRaw($query, $array)->count();
        }
        return Product::count();
    }

    public static function updateInventory($quantity, $comment, $productId) {
        DB::transaction(function() use ($quantity, $comment, $productId){
            $product = Product::find($productId);
            $product->available_stock = $product->available_stock + $quantity;
            $product->save();
            $user = User::first();
            $history = new InventoryHistory();
            $history->quantity = $quantity;
            $history->comment = $comment;
            $history->product()->associate($product);
            $history->user()->associate($user);
            $history->save();
        });
        return true;
    }
} 