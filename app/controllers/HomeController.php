<?php

class HomeController extends BaseController {
    public function home(){
        /*\Illuminate\Support\Facades\Mail::Send('emails.auth.test',array('name' => 'Rashad'),function($message){
                $message->to('kh.tafiqul.islam@gmail.com','Rashad')->subject('Test email sending');
            }
        );*/
        return View::make('home');
    }
}
