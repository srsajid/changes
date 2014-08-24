<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 11:27 PM
 */

class BeneficiaryController extends \BaseController {
    public function __construct() {
        $this->beforeFilter('super_admin', array('only' => array("getCreate", "postSave")));
        $this->beforeFilter('admin', array('only' => array("postPaySalary", "getPaySalaryNextStep", "getPaySalaryForm", "getLoadTable")));
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $text = "";
        if(Input::get("searchText")) {
            $query = $query."name Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $beneficiaries = null;
        $total = 0;
        if(count($array) > 0 ) {
            $beneficiaries = Beneficiary::whereRaw($query, $array)->take($max)->skip($offset);
            $total = Beneficiary::whereRaw($query, $array)->count();
        } else {
            $beneficiaries = Beneficiary::take($max)->skip($offset)->orderBy('id', "ASC");
            $total = Beneficiary::count();
        }
        $beneficiaries = $beneficiaries->get();
        return View::make("beneficiary.tableView", array(
            'beneficiaries' => $beneficiaries,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $text
        ));
    }

    public function getCreate() {
        $beneficiary = null;
        if(Input::get("id")) {
            $beneficiary = Beneficiary::find(intval(Input::get("id")));
        } else {
            $beneficiary = new Beneficiary();
        }
        return View::make("beneficiary.create", array('beneficiary' => $beneficiary));
    }

    public function postSave() {
        $beneficiary = null;
        $inputs = Input::all();
        if($inputs["id"]) {
            $beneficiary = Beneficiary::find(intval($inputs["id"]));
        } else {
            $beneficiary = new Beneficiary();
        }
        $rules = array(
            'phone' => 'required|unique:beneficiaries,phone'.($beneficiary->id ? ",$beneficiary->id" : ""),
            'email' => 'email'
        );
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $beneficiary->name = $inputs["name"];
        $beneficiary->phone = $inputs["phone"];
        $beneficiary->email = $inputs["email"];
        $beneficiary->designation = $inputs["designation"];
        $beneficiary->address = $inputs["address"];
        $beneficiary->status = "A";
        $beneficiary->type = intval($inputs["type"]);
        $beneficiary->salary = floatval($inputs["salary"]);
        $beneficiary->save();
        return array('status' => 'success', 'message' => "Beneficiary has been created successfully");
    }

    public function getPaySalaryForm() {
        $beneficiary = Beneficiary::find(intval(Input::get("id")));
        return View::make("beneficiary.paySalaryForm", array('beneficiary' => $beneficiary));
    }

    public function getPaySalaryNextStep() {
        $inputs = Input::all();
        $id = (int) $inputs["id"];
        $month = (int) $inputs["month"];
        $year = (int) $inputs["year"];
        $beneficiary = Beneficiary::find($id);
        $paid = DB::table("salaries")->where("beneficiary_id", "=", $id)->where("month", "=", $month)->where("year", "=", $year)->sum("amount");
        $loan = DB::table("loan_given")->select(DB::raw('sum(amount - paid) as loan'))->where("beneficiary_id", "=", $id)->where("is_paid", "=", 'N')->first()->loan;
        $amount = $beneficiary->salary - $paid;
        return View::make("beneficiary.paySalaryNextStep", array('paid' => $paid, 'amount' => $amount, 'salary' => $beneficiary->salary, 'loan' => $loan));
    }

    public function postPaySalary() {
        $inputs = Input::all();
        $id = (int) $inputs["id"];
        $month = (int) $inputs["month"];
        $year = (int) $inputs["year"];
        $amount = (float) $inputs["amount"];
        $loanPayment = doubleval(Input::get("loan_payment"));
        $beneficiary = Beneficiary::find($id);
        $paid = DB::table("salaries")->where("beneficiary_id", "=", $id)->where("month", "=", $month)->where("year", "=", $year)->sum("amount");
        $toPaid = $beneficiary->salary - $paid;
        if($amount > $toPaid) {
            return array('status' => 'error', 'message' => "Maximum amount is $toPaid");
        }
        $loan = DB::table("loan_given")->select(DB::raw('sum(amount - paid) as loan'))->where("beneficiary_id", "=", $id)->where("is_paid", "=", 'N')->first()->loan;
        if($loanPayment > $loan || $loanPayment > $amount) {
            $max = $loanPayment > $amount ? $amount : $loan;
            return array('status' => 'error', 'message' => "Maximum loan payment amount is $max");
        }
        try {
            DB::transaction(function() use($id, $month, $year, $amount, $loanPayment){
                $user = Auth::user();
                $salary = new Salary();
                $salary->month = $month;
                $salary->year = $year;
                $salary->amount = $amount;
                $salary->user_id = $user->id;
                $salary->beneficiary_id = $id;
                $salary->save();
                $loans = LoanGiven::where("beneficiary_id", "=", $id)->where("is_paid", "=", "N")->get();
                $i = 0;
                while($loanPayment > 0) {
                    $loan = $loans[$i];
                    $toPaymentBack = $loan->amount - $loan->paid;
                    $loanPaymentBack = new LoanPaymentBack();
                    $loanPaymentBack->loan_given_id = $loan->id;
                    $loanPaymentBack->user_id = $user->id;
                    if($toPaymentBack > $loanPayment) {
                        $loanPaymentBack->amount = $loan->paid + $loanPayment;
                        $loan->paid = $loan->paid + $loanPayment;
                        $loanPayment = 0;

                    } else if($loanPayment > $toPaymentBack) {
                        $loanPaymentBack->amount = $loan->paid + $toPaymentBack;
                        $loan->paid = $loan->paid + $toPaymentBack;
                        $loanPayment = $loanPayment - $toPaymentBack;
                        $loan->is_piad = 'Y';
                    } else {
                        $loanPaymentBack->amount = $loan->paid + $loanPayment;
                        $loan->paid = $loan->paid + $loanPayment;
                        $loan->is_paid = 'Y';
                        $loanPayment = 0;
                    }
                    $loanPaymentBack->save();
                    $loan->save();
                    $i++;
                }
            });
            return array('status' => 'success', 'message' => "Salary has been successfully paid");
        } catch(Exception $e) {
            return array('status' => 'error', 'message' => "Salary payment has been failed");
        }
    }
} 