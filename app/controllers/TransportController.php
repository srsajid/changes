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
            $query = $query."student_id = ?";
            $text = trim(Input::get("searchText")) ;
            $student  = Student::where("sid", '=', $text)->get()->first();
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
        $student = Student::where('sid', '=', $studentId)->get()->first();
        if($student == null ) {
            return array("status" => "error", 'message' => "Student not Found");
        }
        $transportCount = TransportFeeCount::where('year', '=', $year)->where("student_id", "=", $student->id)->get()->first();
        if($transportCount == null ) {
            return array("status" => "error", 'message' => "Student is not admitted");
        }
        $html = View::make("transport.transportFeeNextStep", array("student" => $student, 'transportCount' => $transportCount));
        return array("status" => "success", "html" => $html->render());
    }

    public function postTakeTransport() {
        $sid = Input::get("studentId");
        $student  = Student::where("sid", '=', $sid)->get()->first();
        $year = (int) Input::get("year");
        $transportCount = TransportFeeCount::where('year', '=', $year)->where('student_id', '=', $student->id)->get()->first();
        $noOfMonth = (int) Input::get("monthCount");
        $amount = $student->transport_fee * $noOfMonth;
        $discount = (double) Input::get("discount") ?: 0;
        $fine = (double) Input::get("fine") ?: 0;
        if($discount > $amount) {
            return array('status' => "error", 'message' => "Discount should not greater then or equal total amount");
        }
        if(($transportCount->month_count + $noOfMonth) > 12) return;
        DB::transaction(function() use ($transportCount, $noOfMonth, $student, $amount, $discount, $fine) {
            $user = Auth::user();
            $transportCount->month_count += $noOfMonth;
            $transport = new TransportFee();
            $transport->number_of_month = $noOfMonth;
            $transport->amount = $amount;
            $transport->discount = $discount;
            $transport->fine = $fine;
            $transport->comment = Input::get("comment");
            $transport->student_id = $student->id;
            $transport->user_id = $user->id;
            $transport->transport_fee_count_id = $transportCount->id;
            $transportCount->save();
            $transport->save();
        });
        return array('status' => 'success', 'message' => "Transport fee has been taken successfully");
    }
}
