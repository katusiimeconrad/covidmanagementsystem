<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Fund;
use App\Models\User;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;

class FundController extends Controller
{
    //
    public function index() {
        $funds = Fund::with('donor')->get();
        $donors = Donor::all();

        return view('funds.index', compact('funds', 'donors'));

    }

    //Store funds
    public function store(Request $request) {
        $fund = new Fund;

        if( $request->input('DirectAmount') ) {
            $this->validate($request, [
                'DirectAmount' =>  'required'
            ]);

            $fund->amountPaid = $request->input('DirectAmount');
            $fund->dateOfPayment = now();
        //    $fund->admin_id =

            $fund->save();

            return redirect()->route('funds.index');

        }


        if( $request->input('Donation') ) {
            $this->validate($request, [
                'Donation' =>  'required',
                'donor' => 'required'
            ]);

            $donor = Donor::find( $request->input('donor'));


            $fund->amountPaid = $request->input('Donation');
            $fund->dateOfPayment = now();
            $fund->donor_id = $donor->id;

            $fund->save();

            return redirect()->route('funds.index');

        }


    }
}

/*
public function store(Request $request){
    $this->validate($request, [
        'hospitalName'  =>  'required|max:1200|unique:hospitals',
        'hospitalType'  => 'required|notIn:0',
        'district_id'   =>'required',
    ]);

    $district = District::find($request->input('district_id'));
    $hospital = new Hospital;
    $hospital->hospitalName = $request->input('hospitalName');
    $hospital->hospitalType = $request->input('hospitalType');
    $hospital->district_id = $district->id;
    $hospital->save();

    return redirect()->route('hospitals.index');

}
*/
