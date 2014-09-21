<?php
/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/
App::before(function($request)
{
    date_default_timezone_set('Asia/Dhaka');
});
App::after(function($request, $response)
{
//
});
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
Route::filter('auth', function()
{
    if (Auth::guest()) {
        return Redirect::guest('/');
    }
});
Route::filter('auth.basic', function()
{
    return Auth::basic();
});
/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/
Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::to('/admin');
});
/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/
Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
Route::filter('super_admin', function(){
    if(!Auth::check() || Auth::user()->weight < 5) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});

Route::filter('admission_user', function(){
    if(!Auth::check() || (Auth::user()->weight < 5 && Auth::user()->weight != 4)) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});

Route::filter('sells_user', function(){
    if(!Auth::check() || (Auth::user()->weight < 5 && Auth::user()->weight != 3)) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});

Route::filter('payroll_user', function(){
    if(!Auth::check() || (Auth::user()->weight < 5 && Auth::user()->weight != 2)) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});

Route::filter('administration_user', function(){
    if(!Auth::check() || (Auth::user()->weight < 5 && Auth::user()->weight != 1)) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});

Route::filter('admin', function(){
    if(!Auth::check() || Auth::user()->weight < 4) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});
Route::filter('normal', function(){
    if(!Auth::check() || Auth::user()->weight < 3) {
        return Response::json(array('status' => 'error', 'message' => 'You do not have right permission'), 401);
    }
});