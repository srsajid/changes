<?php
class OSMS {
    static public $baseUrl = "/changes/public_html/";

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

    static $BENEFICIARY_TYPE = array(
        1 => "Chairman",
        2 => "Director",
        3 => "Teacher",
        4 => "Staff"
    );
}