<?php
Class AccountController extends BaseController{
    public function login() {
        $user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if (Auth::attempt($user)) {
            return Redirect::route('admin')
                ->with('flash_notice', 'You are successfully logged in.');
        }
        return Redirect::route('login')
            ->with('flash_error', 'Your username/password combination was incorrect.')
            ->withInput();
    }

    public function logout() {
       Auth::logout();
       return Redirect::to("/");
    }

    public function admin() {
        $menus = Menu::all();
        $user = Auth::user();
        return View::make("admin.cms", array('menus' => $menus, 'user' => $user));
    }

    public function postSignIn(){
        $validator = Validator::make(Input::all(),
            array(
                'username' => 'required|email',
                'password' => 'required'
            )
        );
        if($validator->fails()){
            return Redirect::route('sign-in')
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $auth = Auth::attempt(array(
                    'username' => Input::get('username'),
                    'password' => Input::get('password')
                )
            );
            if($auth){
                return Redirect::route('admin');
            }
            else{
                return Redirect::route('')
                    -> with('global','Wrong username and password.');
            }
        }
        return Redirect::route('sign-in')
            -> with('global','There was a problem singing in.');
    }
}