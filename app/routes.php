<?php

Route::get("/", function(){
    return View::make("admin.login", array('message' => Session::get("flash_error")));
})->before("guest");

Route::post("login", "AccountController@login");
Route::get("logout", "AccountController@logout");
Route::get("/admin", array('as' => 'admin', 'uses' => "AccountController@admin"))->before("auth");

Route::get("/account/change-pass", "AccountController@changePass")->before("normal");
Route::post("/account/save-pass", "AccountController@savePass")->before("normal");

Route::get("/admission", "AdmissionController@loadTable");
Route::get("/admission/create", "AdmissionController@create");
Route::post("/admission/save", "AdmissionController@save");
Route::get("/admission/edit", "AdmissionController@edit");

Route::get("/category", "CategoryController@loadTable");
Route::get("/category/create", "CategoryController@create");
Route::get("/category/edit", "CategoryController@edit");
Route::post("/category/save", "CategoryController@save");

Route::get("/sells/loadTable", "SellsController@loadTable");
Route::get("/sells/create", "SellsController@create");
Route::post("/sells/save", "SellsController@save");
Route::get("/sells/selection", "SellsController@selection");
Route::get("/sells/pdf", "SellsController@pdf");
Route::get("/sells/view", "SellsController@view");
Route::get("/sells/reportForm", "SellsController@reportForm");
Route::post("/sells/report", "SellsController@report");

Route::get("/product/loadTable", "ProductController@loadTable");
Route::get("/product/create", "ProductController@create");
Route::get("/product/view", "ProductController@view");
Route::post("/product/save", "ProductController@save");
Route::get("/product/inventory", "ProductController@loadInventoryForm");
Route::post("/product/updateInventory", "ProductController@updateInventory");
Route::get("/product/selection", "ProductController@productForSelection");
Route::get("/product/history", "ProductController@history");

Route::get("/package/loadTable", "PackageController@loadTable");
Route::get("/package/create", "PackageController@create");
Route::post("/package/save", "PackageController@save");

Route::controller('user', 'UserController');
Route::controller('beneficiary', 'BeneficiaryController');
Route::controller('salary', 'SalaryController');
Route::controller('loan', 'LoanController');

Route::get("test", function(){
    $ym = DateTime::createFromFormat('m/d/Y h:i:s', '10/16/2003 00:00:00')->format("y-m-d h:i:s");
    $x = new DateTime("07/01/2014 00:00:00");
    $y = new DateTime("07/01/2014 23:59:59");
    $x = Sell::whereRaw("created_at >= ? and created_at <= ?", array($x, $y))->get();
    return $x;
});