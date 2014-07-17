<?php
class OSMS {
    static public $baseUrl = "/changes/public/";

    static $NAV_MENU = array(
        'admission' => "Admission",
        'sells' => "Sells",
        'payroll' => "Payroll",
         'administrator' => "Administrator"
    );

    static $USER_TYPE = array(
        5 => "Super Admin",
        4 => "Admin",
        3 => 'Normal User',
        0 => ""
     );
}