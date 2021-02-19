<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Donor;
use App\Models\Fund;
use App\Models\HealthOfficer;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //Index
    public function index(){
        $funds = Fund::all();
        $payments = Payment::all();


        $available_funds = $funds->sum('amountPaid') - $payments->sum('amount');

        return view('payments.index', compact('payments', 'available_funds'));
    }

    public function store(Request $request){
        $administrators = User::all();
        $health_officers = HealthOfficer::all();
        $funds = Fund::all();
        $payments = Payment::all();

        //Getting the number of officers of each category
        $admins = $administrators->count();
        $directors = $health_officers->where('title', 'Director')->count();
        $superintendents = $health_officers->where('title', 'Superintendent')->count();
        $general_healh_officers = $health_officers->where('title', 'General')->count();
        $senior_health_officers = $health_officers->where('title', 'Senior')->count();
        $head_health_officers = $health_officers->where('title', 'Head')->count();



        //Available Funds
        $available_funds = $funds->sum('amountPaid') - $payments->sum('amount');
        $donations = $funds->whereNotNull('donor_id')->sum('amount');

        //To make a payment, Availbale Funds must be greater than 100 million
        if( $available_funds > 100000000 ){
            /*
            Calculating Totals for Basic Pay of each category of official.

            As:
            sum of category's basic pay = (basic pay)


            */
            static $base_pay = 5000000;

            $directors_basic_pay = $base_pay;
            $superintendents_basic_pay = (1/2) * $directors_basic_pay;
            $admins_baisc_pay = (3/4) * $superintendents_basic_pay;
            $general_healh_officers_basic_pay = (8/5) * $admins_baisc_pay;
            $senior_health_officers_basic_pay = $general_healh_officers_basic_pay + (6/100) * $general_healh_officers_basic_pay;
            $head_health_officers_basic_pay = $general_healh_officers_basic_pay + (3.5/100);


            //Sums for the staff in the category
            $directors_basic_pay_sum = $directors_basic_pay * $directors;
            $superintendents_basic_pay_sum = $superintendents_basic_pay * $superintendents;
            $admins_baisc_pay_sum = $admins_baisc_pay * $admins;
            $general_healh_officers_basic_pay_sum = $general_healh_officers_basic_pay * $general_healh_officers;
            $senior_health_officers_basic_pay_sum = $senior_health_officers_basic_pay * $senior_health_officers;
            $head_health_officers_basic_pay_sum = $head_health_officers_basic_pay * $head_health_officers;


            //Verifying that the amount of funds - donations are enough to process the basic pays.
            $basic_pay = $directors_basic_pay_sum + $superintendents_basic_pay_sum + $admins_baisc_pay_sum + $general_healh_officers_basic_pay_sum + $senior_health_officers_basic_pay_sum + $head_health_officers_basic_pay_sum;

            if( $basic_pay > ( $available_funds - $donations) ){

                return redirect()->back()->withErrors(['msg', 'Not Enough Funds To Process Payments']);//$this->withFail('Not Enough Funds To Process Payments');

            } else {
                //$new_payment = new Payment;


                //Calculate Bonuses
                $available_bonus = $donations - $basic_pay;

                $directors_bonus = (5/100) * $available_bonus;
                $superintendents_bonus = (1/2) * $directors_bonus;
                $admins_bonus= (3/4) * $superintendents_bonus;
                $general_healh_officers_bonus= (8/5) * $admins_bonus;
                $senior_health_officers_bonus = $general_healh_officers_bonus + (6/100) * $general_healh_officers_bonus;
                $head_health_officers_bonus = $general_healh_officers_bonus + (3.5/100);



                //Summing the bonues
                $bonuses = $directors_bonus * $directors
                            + $superintendents_bonus * $superintendents
                            + $admins_bonus * $admins
                            + $general_healh_officers_bonus * $general_healh_officers
                            + $senior_health_officers_bonus * $senior_health_officers
                            + $head_health_officers_bonus * $head_health_officers;

                //Calculating The Actual Pays ( basic pay + bonus )
                $directors_net = $directors_basic_pay + $directors_bonus;
                $superintendents_net = $superintendents_basic_pay + $superintendents_bonus;
                $admins_net = $admins_baisc_pay + $admins_bonus;
                $general_healh_officers_net = $general_healh_officers_basic_pay + $general_healh_officers_bonus;
                $senior_health_officers_net = $senior_health_officers_basic_pay + $senior_health_officers_bonus;
                $head_health_officers_net = $head_health_officers_bonus;


                //Total Amount Paid
                $total_payment = $basic_pay + $bonuses;

                $new_payment = new Payment;
                $new_payment->amount = $total_payment;
                $new_payment->date = now();
                $new_payment->save();


                $request->session()->now('Sucess', 'Payment Processed ');
                return back();
            }

            //dd($general_healh_officers);

        }

        return redirect()->back()->withErrors(['msg', 'Not Enough Funds To Process Payments']);
    }

    public function show($id) {


        //

    }

    public function edit($id){

        //
    }

    public function update(Request $request, $id) {

        //
    }

    public function delete($id){
        $payment = Payment::find($id);
        $payment->delete();

        return back();
    }

}
