<?php

class TuitionFeeController extends \BaseController {
    public function __construct() {
        $this->beforeFilter("administration_user");
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array(); $query = ""; $text = ""; $year = ""; $flag = false;
        if(Input::get("searchText")) {
            $query = $query."student_information_id = ?";
            $text = trim(Input::get("searchText")) ;
            $student  = StudentInformation::where("student_id", '=', $text)->get()->first();
            array_push($array, $student ? $student->id : 0);
            $flag = true;
        }
        if(Input::get("year")) {
            $year = (int) Input::get("year");
            $query = $query.($flag ? " and " : "");
            $query = $query."tuition_fee_count_id IN (select id from `tuition_fee_counts` where `year` = ?)";
            array_push($array, $year);
        }
        $fees = null;
        $total = 0;
        if(count($array) > 0 ) {
            $fees = TuitionFee::whereRaw($query, $array)->take($max)->skip($offset);
            $total = TuitionFee::whereRaw($query, $array)->count();
        } else {
            $fees = TuitionFee::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = TuitionFee::count();
        }
        $fees = $fees->get();
        return View::make("tuition.tableView", array(
            'fees' => $fees,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text,
            "year" => $year
        ));
    }

    public function getTuitionFeeForm() {
        return View::make("tuition.tuitionFeeForm");
    }

    public function getTuitionFeeNext() {
        $inputs = Input::all();
        $studentId = $inputs["studentId"];
        $year = (int) $inputs["year"];
        $registration = Registration::where('student_unique_id', '=', $studentId)->where("year", "=", $year)->get()->first();
        $tuitionCount = TuitionFeeCount::where('year', '=', $year)->where("student_information_id", "=", $registration->student_id)->get()->first();
        if($registration == null) {
            return array("status" => "error", 'message' => "Student is not admitted");
        }
        $html = View::make("tuition.tuitionFeeNextStep", array("registration" => $registration, 'tuitionCount' => $tuitionCount));
        return array("status" => "success", "html" => $html->render());
    }

    public function postTakeTuition() {
        $sid = Input::get("studentId");
        $student  = StudentInformation::where("student_id", '=', $sid)->get()->first();
        $year = (int) Input::get("year");
        $tuitionCount = TuitionFeeCount::where('year', '=', $year)->where('student_information_id', '=', $student->id)->get()->first();
        $noOfMonth = (int) Input::get("monthCount");
        $amount = $student->tuition_fee * $noOfMonth;
        $discount = (double) Input::get("discount") ?: 0;
        $fine = (double) Input::get("fine") ?: 0;
        if($discount > $amount) {
            return array('status' => "error", 'message' => "Discount should not greater then or equal total amount");
        }
        if(($tuitionCount->month_count + $noOfMonth) > 12) return;
        DB::transaction(function() use ($tuitionCount, $noOfMonth, $student, $amount, $discount, $fine) {
            $user = Auth::user();
            $tuitionCount->month_count += $noOfMonth;
            $tuition = new TuitionFee();
            $tuition->number_of_month = $noOfMonth;
            $tuition->amount = $amount;
            $tuition->discount = $discount;
            $tuition->fine = $fine;
            $tuition->comment = Input::get("comment");
            $tuition->student_information_id = $student->id;
            $tuition->user_id = $user->id;
            $tuition->tuition_fee_count_id = $tuitionCount->id;
            $tuitionCount->save();
            $tuition->save();
        });
        return array('status' => 'success', 'message' => "Tuition fee has been taken successfully");
    }
}
