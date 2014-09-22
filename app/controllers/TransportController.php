<?php

class TransportController extends \BaseController {
    public function __construct() {
        $this->beforeFilter("admin_user");
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $text = "";
        if(Input::get("searchText")) {
            $query = $query."student_information_id = ?";
            $text = trim(Input::get("searchText")) ;
            $student  = StudentInformation::where("student_id", '=', $text)->get()->first();
            array_push($array, $student ? $student->id : 0);
        }
        $fees = null;
        $total = 0;
        if(count($array) > 0 ) {
            $fees = TransportFee::whereRaw($query, $array)->take($max)->skip($offset);
            $total = TransportFee::whereRaw($query, $array)->count();
        } else {
            $fees = TransportFee::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = TransportFee::count();
        }
        $fees = $fees->get();
        return View::make("transport.tableView", array(
            'fees' => $fees,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text
        ));
    }

    public function getTransportFeeForm() {
        return View::make("transport.transportFeeForm");
    }

    public function getTransportFeeNext() {
        $inputs = Input::all();
        $studentId = $inputs["studentId"];
        $year = (int) $inputs["year"];
        $registration = Registration::where('student_unique_id', '=', $studentId)->where("year", "=", $year)->get()->first();
        if( $registration== null ) {
            return array("status" => "error", 'message' => "Student is not admitted");
        }
        if(!$registration->has_transport) {
            return array("status" => "error", 'message' => "Student do not use transport service");
        }
        $transportCount = TransportFeeCount::where('year', '=', $year)->where("student_information_id", "=", $registration->student_id)->get()->first();
        $html = View::make("transport.transportFeeNextStep", array("registration" => $registration, 'transportCount' => $transportCount));
        return array("status" => "success", "html" => $html->render());
    }

    public function postTakeTransport() {
        $sid = Input::get("studentId");
        $year = (int) Input::get("year");
        $registration  = Registration::where("student_unique_id", '=', $sid)->where("year", "=", $year)->get()->first();
        $transportCount = TransportFeeCount::where('year', '=', $year)->where('student_information_id', '=', $registration->student_id)->get()->first();
        $noOfMonth = (int) Input::get("monthCount");
        $amount = $registration->transport_fee * $noOfMonth;
        $discount = (double) Input::get("discount") ?: 0;
        $fine = (double) Input::get("fine") ?: 0;
        if($discount > $amount) {
            return array('status' => "error", 'message' => "Discount should not greater then or equal total amount");
        }
        if(($transportCount->month_count + $noOfMonth) > 12) return;
        DB::transaction(function() use ($transportCount, $noOfMonth, $registration, $amount, $discount, $fine) {
            $user = Auth::user();
            $transportCount->month_count += $noOfMonth;
            $transport = new TransportFee();
            $transport->number_of_month = $noOfMonth;
            $transport->amount = $amount;
            $transport->discount = $discount;
            $transport->fine = $fine;
            $transport->comment = Input::get("comment");
            $transport->student_information_id = $registration->student_id;
            $transport->user_id = $user->id;
            $transport->transport_fee_count_id = $transportCount->id;
            $transportCount->save();
            $transport->save();
        });
        return array('status' => 'success', 'message' => "Transport fee has been taken successfully");
    }
}
