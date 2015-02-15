<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/4/14
 * Time: 11:27 PM
 */

class BeneficiaryController extends \BaseController {

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
        $inputs = Input::all();
        $beneficiary = null;
        if($inputs["id"]) {
            $beneficiary = Beneficiary::find(intval($inputs["id"]));
        } else {
            $beneficiary = new Beneficiary();
        }
        $rules = array(
            'phone' => 'required|unique:beneficiaries,phone'.($beneficiary->id ? ",$beneficiary->id" : ""),
            'email' => 'email',
            'image' => 'image'
        );
        if(!$beneficiary->id) {
            $rules['join_date'] = 'required';
        }
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $image = Input::file("image");
        DB::transaction(function() use ($beneficiary, $inputs, $image){
            $beneficiary->name = $inputs["name"];
            $beneficiary->phone = $inputs["phone"];
            $beneficiary->email = $inputs["email"];
            $beneficiary->designation = $inputs["designation"];
            $beneficiary->address_1 = $inputs["address_1"];
            $beneficiary->address_2 = $inputs["address_2"];
            $beneficiary->father_name = $inputs["father_name"];
            $beneficiary->mother_name = $inputs["mother_name"];
            $beneficiary->national_id = $inputs["national_id"];
            $beneficiary->status = "A";
            $beneficiary->sex = $inputs['sex'];
            $beneficiary->campus = $inputs['campus'];
            $beneficiary->bank_account = $inputs['bank_account'];
            $beneficiary->type = intval($inputs["type"]);
            $beneficiary->employee_id = $inputs["employee_id"];
            if(!$beneficiary->id) {
                $date = date_create_from_format('m/d/Y', $inputs['join_date']);
                $date = date_format($date, 'Y-m-d');
                $beneficiary->salary = floatval($inputs["salary"]);
                $beneficiary->join_date = $date;
                $beneficiary->last_increment_date = $date;
            }
            if($image) {
                $beneficiary->image = $image->getClientOriginalName();
            }
            $beneficiary->save();
            $beneficiary->educations->each(function($education) {
                $education->delete();
            });
            $degrees = json_decode($inputs["degrees"]);
            $institutions = json_decode($inputs["institutions"]);
            $grades = json_decode($inputs["grades"]);
            $boards = json_decode($inputs["boards"]);
            $size = count($degrees);
            for($i = 0; $i < $size; $i++ ) {
                $education = new Education();
                $education->degree = $degrees[$i];
                $education->institution = $institutions[$i];
                $education->grade = $grades[$i];
                $education->board = $boards[$i];
                $education->beneficiary_id = $beneficiary->id;
                $education->save();
            }
            if($image) {
                $fileName = storage_path()."/images/employee/$beneficiary->id/";
                if(File::exists($fileName)) {
                    File::deleteDirectory($fileName);
                }
                $image->move(storage_path()."/images/employee/$beneficiary->id/", $image->getClientOriginalName());
            }
        });
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
        $extra = (float) $inputs["extra"];
        $deduction = (float) $inputs["deduction"];
        $loanPayment = doubleval(Input::get("loan_payment"));
        $comment = $inputs["comment"];
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
        if($amount + $extra < $deduction + $loanPayment) {
            return array('status' => 'error', 'message' => "Total deduction Should not greater then total Payment");
        }
        try {
            DB::transaction(function() use($id, $month, $year, $amount, $loanPayment, $extra, $deduction, $comment){
                $user = Auth::user();
                $salary = new Salary();
                $salary->month = $month;
                $salary->year = $year;
                $salary->amount = $amount;
                $salary->user_id = $user->id;
                $salary->beneficiary_id = $id;
                $salary->extra_payment = $extra;
                $salary->deduction = $deduction;
                $salary->comment = $comment;
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

    public function getCreateIncrement() {
        $id = Input::get("id");
        return View::make("beneficiary.increment", array('id' => $id));
    }

    public function postSaveIncrement() {
        $inputs = Input::all();
        $rule = array(
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required'
        );
        $validation = Validator::make($inputs, $rule);
        if($validation->fails()) {
            return array('status' => 'error', 'message' => $validation->messages()->all());
        }
        $beneficiary = Beneficiary::find($inputs['id']);
        $beneficiary->salary = $beneficiary->salary + floatval($inputs['amount']);
        $date = date_create_from_format('m/d/Y', $inputs['date']);
        $date = date_format($date, 'Y-m-d');
        if($inputs['type'] == "Regular") {
            $beneficiary->last_increment_date = $date;
        }
        $history = new SalaryHistory();
        $history->adjust_amount = $inputs['amount'];
        $history->type = $inputs['type'];
        $history->date = $date;
        $history->user_id = Auth::user()->id;
        $history->comment = $inputs['comment'];
        $history->beneficiary_id = $beneficiary->id;
        DB::transaction(function() use ($beneficiary, $history){
            $beneficiary->save();
            $history->save();
        });
        return array('status' => 'success', 'message' => 'Salary has been adjust salary');
    }

    public function getSalaryHistory() {
        $id = (int) Input::get("id");
        $beneficiary = Beneficiary::find($id);
        return View::make("beneficiary.salaryHistory", array('beneficiary' => $beneficiary));
    }
} 