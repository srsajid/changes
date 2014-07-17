<?php
/**
 * Created by PhpStorm.
 * User: Sajid
 * Date: 6/10/14
 * Time: 9:56 PM
 */

class SellsService {

    public static function  getSells($params) {
        $max = (int) $params["max"];
        $offset = (int) $params["offset"];
        $array = array();
        $query = "";
        $sells = null;
        $search_text = Input::get("searchText");
        if($search_text){
            if(is_numeric($search_text)){
                $query = $query."mobile Like ?";
                $text = trim($search_text) ;
                array_push($array, "%".$text."%");
            }
            else{
                $query = $query."student_id Like ?";
                $text = trim($search_text) ;
                array_push($array, "%".$text."%");
            }
        }
        if(count($array) > 0 ) {
            $sells = Sell::whereRaw($query, $array)->take($max)->skip($offset);
        } else {
            $sells = Sell::take($max)->skip($offset)->orderBy('id', "DESC");
        }
        return $sells->get();
    }

    public static function getCounts($params) {
        return Sell::count();
    }

    public static function save($studentId, $mobileNo, $ids, $quantities) {
        if(!Auth::check()) {
            throw new Exception("No user logged in");
        }
        DB::transaction(function() use($studentId,$mobileNo, $ids, $quantities) {
            $student = null;
            if($studentId) {
                $student = Student::where('sid', '=', $studentId)->first();
            }
            $user = Auth::user();
            $sells = new Sell();
            $sells->user()->associate($user);
            if($student) {
                $sells->student_id = $studentId;
                $sells->clazz = $student->clazz;
                $sells->section = $student->section;
            }
            elseif($studentId){
                $sells->student_id = $studentId;
            }
            if($mobileNo){
                $sells->mobile = $mobileNo;
            }
            $sells->save();
            $size = count($ids);
            for($i=0; $i < $size; $i++) {
                $id = (int) $ids[$i];
                $quantity = (int) $quantities[$i];
                $product = Product::find($id);
                $item = new SellItem();
                $item->productId = $product->id;
                $item->productName = $product->name;
                $item->productPrice = $product->sale_price;
                $item->quantity = $quantity;
                $item->sell()->associate($sells);
                $item->save();
                ProductService::updateInventory($quantity * -1, "After sells# $sells->id", $id);
            }
        });
        return true;
    }
} 