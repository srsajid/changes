<?php

class TuitionFeeController extends \BaseController {
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
            'searchText' => $text
        ));
    }

    public function getTuitionFeeForm() {
        return View::make("tuition.tuitionFeeForm");
    }

    public function getTuitionFeeNext() {
        $inputs = Input::all();
        $studentId = $inputs["studentId"];
        $year = (int) $inputs["year"];
        $student = Student::where('sid', '=', $studentId)->get()->first();
        if($student == null ) {
            return array("status" => "error", 'message' => "Student not Found");
        }
        $tuitionCount = TuitionFeeCount::where('year', '=', $year)->where("student_id", "=", $student->id)->get()->first();
        if($tuitionCount == null ) {
            return array("status" => "error", 'message' => "Student is not admitted");
        }
        $html = View::make("tuition.tuitionFeeNextStep", array("student" => $student, 'tuitionCount' => $tuitionCount));
        return array("status" => "success", "html" => $html->render());
    }

    public function postTakeTuition() {
        $sid = Input::get("studentId");
        $student  = Student::where("sid", '=', $sid)->get()->first();
        $year = (int) Input::get("year");
        $tuitionCount = TuitionFeeCount::where('year', '=', $year)->where('student_id', '=', $student->id)->get()->first();
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
            $tuition->student_id = $student->id;
            $tuition->user_id = $user->id;
            $tuition->tuition_fee_count_id = $tuitionCount->id;
            $tuitionCount->save();
            $tuition->save();
        });
        return array('status' => 'success', 'message' => "Tuition fee has been taken successfully");
    }
}
