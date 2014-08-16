<?php

class LoanController extends \BaseController {
    public function __construct() {
        $this->beforeFilter("admin", array('only' => array("getLoadTable", "getCreate", "postSave")));
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $text = "";
        $flag = false;
        if(Input::get("is_paid")) {
            $isPaid = Input::get("is_paid");
            $query = $query."is_paid = ?";
            array_push($array, $isPaid);
        }
        if(Input::get("searchText")) {
            $query = $flag ? $query." and " : $query;
            $query = $query."beneficiary_id = ?";
            $text = intval(Input::get("searchText")) ;
            array_push($array, $text);
        }
        $loans = null;
        $total = 0;
        if(count($array) > 0 ) {
            $loans = LoanGiven::whereRaw($query, $array)->take($max)->skip($offset);
            $total = LoanGiven::whereRaw($query, $array)->count();
        } else {
            $loans = LoanGiven::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = LoanGiven::count();
        }
        $loans = $loans->get();
        return View::make("loan.tableView", array(
            'loans' => $loans,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text
        ));
    }

    public function getCreate(){
        $beneficiaryId = Input::get("beneficiaryId");
        return View::make("loan.create", array('beneficiaryId' => $beneficiaryId));
    }

    public function postSave() {
        $beneficiaryId = (int) Input::get("beneficiaryId");
        $amount = (double) Input::get("amount");
        $user = Auth::user();
        $loan = new LoanGiven();
        $loan->is_paid = 'N';
        $loan->user_id = $user->id;
        $loan->beneficiary_id = $beneficiaryId;
        $loan->amount = $amount;
        $loan->paid = 0;
        $loan->save();
        return array("status" => "success", 'message' => "Loan has been given successfully");
    }

    public function getCreatePayment() {
        $loanGivenId = (int) Input::get("id");
        $loanGiven = LoanGiven::find($loanGivenId);
        return View::make("loan.createPayment", array('loan' => $loanGiven));
    }

    public function postSavePayment() {
        $loanGivenId = (int) Input::get("id");
        $loanGiven = LoanGiven::find($loanGivenId);
        $loanPayment = (double) Input::get("loan_payment");
        if($loanGiven->amount <= $loanGiven->paid) {
            return array("status" => "success", "message" => 'Loan already paid');
        }
        $toPaymentBack = $loanGiven->amount - $loanGiven->paid;
        if($loanPayment > $toPaymentBack) {
            return;
        }
        $user = Auth::user();
        $loanPaymentBack = new LoanPaymentBack();
        $loanPaymentBack->loan_given_id = $loanGiven->id;
        $loanPaymentBack->user_id = $user->id;
        $loanPaymentBack->amount = $loanGiven->paid + $toPaymentBack;
        $loanGiven->paid = $loanGiven->paid + $loanPayment;
        if($toPaymentBack == $loanPayment) {
            $loanGiven->is_paid = 'Y';
        }
        $loanPaymentBack->save();
        $loanGiven->save();
        return array("status" => "success", "message" => 'Loan payment has been taken successfully');
    }

    public  function getPaymentHistory() {
        $loanGivenId = (int) Input::get("id");
        $loanGiven = LoanGiven::find($loanGivenId);
        $payments = $loanGiven->payments;
        return View::make("loan.paymentHistory", array('payments' => $payments));
    }
}
