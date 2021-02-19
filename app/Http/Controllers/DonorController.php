<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Fund;
use PhpParser\Node\Stmt\Do_;

class DonorController extends Controller
{
    //
    public function index(){
        $donors = Donor::all();
        return view('donors.index', compact('donors'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'firstName' =>  'required',
            'lastName'  =>  'required',
            'gender'  => 'required|notIn:0',
        ]);

        //Create a Donor
        $donor = new Donor;
        $donor->firstName = $request->input('firstName');
        $donor->lastName = $request->input('lastName');
        $donor->gender = $request->input('gender');
        $donor->save();

        return redirect()->route('donors.index');

    }

    public function edit($id){
        $donor = Donor::find($id);
        $donors = Donor::all();
        return view("donor.edit", compact('donor','donors'));
    }

    public function show( $id ){
        $donor = Donor::find($id);
        $donations = Fund::all()->where('donor_id', $id );

        return view('donors.show',compact('donor', 'donations') );

    }



    public function update(Request $request){
        dd('update');

    }

    public function delete($id){
        $donor = Donor::find($id);
        $donor->delete();

        return back();

    }
}
