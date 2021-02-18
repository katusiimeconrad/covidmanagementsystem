<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Donor;
use App\Models\Fund;
use App\Models\HealthOfficer;
use App\Models\Payment;
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
        $admin = Admin::all();
        $health_officers = HealthOfficer::all();
        $funds = Fund::all();
        $payments = Payment::all();


        $directors = $health_officers->where('title', 'Director')->count();
        $superintendents = $health_officers->where('title', 'Superintendent')->count();
        $administrators = $health_officers->where('title', 'Administrator')->count();
        $general_healh_officers = $health_officers->where('title', 'General')->count();
        $senior_health_officers = $health_officers->where('title', 'Senior')->count();
        $heads = $health_officers->where('title', 'Head')->count();





        //Available Funds
        $available_funds = $funds->sum('amountPaid') - $payments->sum('amount');
        $donations = $funds->whereNotNull('donor_id')->sum();

        //To make a payment, Availbale Funds must be greater than 100 million
        if( $available_funds > 10_000_000 ){

            dd($general_healh_officers);

        }


        //
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

    public function destroy($id) {


    }

}
