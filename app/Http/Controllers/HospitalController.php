<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;

class HospitalController extends Controller
{
    public function index(){
        
        $hospitals = Hospital::all();
        $districts = District::all();
        return view('hospitals.index', compact('hospitals','districts'));
    }

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

    public function edit($id){
        
        $hospital = Hospital::find($id);
        $healthOfficers = $hospital->healthOfficer;
        return view('hospitals.details', compact('healthOfficers', 'hospital'));
    }

    public function update(Request $request){
        dd('update');
    }

    public function delete($id){
        dd('delete'); 
    }
}
