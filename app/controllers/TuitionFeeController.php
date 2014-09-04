<?php

class TuitionFeeController extends \BaseController {
    public function __construct() {
        $this->beforeFilter("admin");
    }

}
