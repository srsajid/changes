<?php

Route::get("/", function(){
    return View::make("admin.login", array('message' => Session::get("flash_error")));
})->before("guest");

Route::post("login", "AccountController@login");
Route::get("logout", "AccountController@logout");
Route::get("/admin", array('as' => 'admin', 'uses' => "AccountController@admin"))->before("auth");

Route::get("/account/change-pass", "AccountController@changePass")->before("normal");
Route::post("/account/save-pass", "AccountController@savePass")->before("normal");

Route::group(array('before' => 'permission'), function() {
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

    Route::get("/income/loadTable", "IncomeController@loadTable");
    Route::get("/income/create", "IncomeController@create");
    Route::post("/income/save", "IncomeController@save");
    Route::get("/income/edit", "IncomeController@edit");

    Route::controller("package", "PackageController");
    Route::controller('user', 'UserController');
    Route::controller('registration', 'RegistrationController');
    Route::controller('expense', 'ExpenseController');
    Route::controller('beneficiary', 'BeneficiaryController');
    Route::controller('salary', 'SalaryController');
    Route::controller('loan', 'LoanController');
    Route::controller('incomeEntry', 'IncomeEntryController');
    Route::controller('expenseEntry', 'ExpenseEntryController');
    Route::controller('tuition', 'TuitionFeeController');
    Route::controller('transport', 'TransportController');
    Route::controller('others', 'OthersController');
    Route::controller('notification', 'NotificationController');
});

Route::any("images/employee/{id}/{name}", function($id, $name) {
    $response = Response::make(File::get(storage_path()."/images/employee/$id/$name"));
    $response->header('Content-Type', 'image/png');
    return $response;
})->before("normal");

Route::get("test", function(){
//   return DB::table("salaries")->select(DB::raw("beneficiaries.name as name, sum(salaries.amount) as amount"))->join("beneficiaries", "salaries.beneficiary_id", "=", "beneficiaries.id")->groupBy("salaries.beneficiary_id")->get();
    $ps = Permission::all();
    $p = $ps->first(function($key, $x) {
        if($x->action == "getTa") {
            return $x;
        }
    });
    return Hash::make("admin");

});