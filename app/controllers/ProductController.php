<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/17/14
 * Time: 5:40 PM
 */

class ProductController extends BaseController {

    public function loadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $products = ProductService::getProducts();
        $total = ProductService::getCounts();
        return View::make("product.tableView", array(
           'products' => $products,
           'total' => $total,
           'max' => $max,
           'offset' => $offset,
           'searchText' => $searchText
        ));
    }

    public  function  view(){
        $id = Input::has("id") ? intval(Input::get("id")) : null;
        $product = null;
        if($id) {
            $product = Product::find($id);
        } else {
            $product = new Product();
        }
        $categories = Category::find($product->category_id);
        return View::make("product.view", [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function create() {
        $id = Input::has("id") ? intval(Input::get("id")) : null;
        $product = null;
        if($id) {
            $product = Product::find($id);
        } else {
            $product = new Product();
        }
        $categories = Category::all();
        return View::make("product.form", array(
            'product' => $product,
            'categories' => $categories
        ));
    }

    public function save() {
        $rules = array(
           'name' => 'required',
           'salePrice' => 'required|numeric',
           'costPrice' => 'required|numeric',
           'category' => 'required|integer'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $product = null;
        if(Input::get('id')) {
            $id = (int)$inputs['id'];
            $product = Product::find($id);
        } else {
            $product = new Product();
        }
        $id = (int) $inputs['category'];
        $category = Category::find($id);
        $product->name = $inputs['name'];
        $product->cost_price = doubleval($inputs['costPrice']);
        $product->sale_price = doubleval($inputs['salePrice']);
        $product->category()->associate($category);
        $product->save();
        return array('status' => 'success', 'message' => 'Product has been saved successfully.');
    }

    public function loadInventoryForm() {
        $id = Input::get("id");
        if(!$id) {
            App::abort(404);
        }
        $product = Product::find(intval($id));
        return View::make("product.inventoryUpdate", array('product' => $product));
    }

    public function updateInventory() {
        $inputs = Input::all();
        $rules = array(
            'id' =>"required|integer",
            'quantity' =>"required|integer"
        );
        $validator = Validator::make($inputs, $rules);
        $id = intval($inputs['id']);
        $comment = $inputs['comment'];
        $quantity = intval($inputs['quantity']);

        if(!$validator->fails() && ProductService::updateInventory($quantity, $comment, $id)){
            return array('status' => 'success', 'message' => "Inventory has been updated successfully");
        } else {
            return array('status' => 'error', 'message' => "Inventory update operation has been failed");
        }
    }

    public function productForSelection() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $products = ProductService::getProducts();
        $total = ProductService::getCounts();
        return View::make("product.selection", array(
            'products' => $products,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function history() {
        $id = (int) Input::get("id");
        $product = Product::find($id);
        return View::make("product.history", array('product' => $product));
    }
}