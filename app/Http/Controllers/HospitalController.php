<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;
use App\Models\HealthOfficer;

class HospitalController extends Controller
{
    public function index(){

        $hospitals = Hospital::all();
        $districts = District::all();
        $a = array();
        foreach ($hospitals as $hospital) {
            $x = (count($hospital->healthOfficer));
            array_push($a, $x);
        }
        return view('hospitals.index', compact('hospitals','districts', 'a'));
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
        $districts = District::all();
        return view('hospitals.edit', compact('healthOfficers','hospital','districts'));
    }

    public function update(Request $request){
        $hospital = Hospital::find($request->input('id'));
        $this->validate($request, [
            'hospitalName'  =>  'required|max:1200','unique:hospital,hospitalName,'.$hospital->id.',id',
            'hospitalType'  => 'required|notIn:0',
            'district_id'   =>'required',
        ]);

        $district = District::find($request->input('district_id'));

        $hospital->hospitalName = $request->input('hospitalName');
        $hospital->hospitalType = $request->input('hospitalType');
        $hospital->district_id = $district->id;
        $hospital->save();

        return redirect()
        ->route('hospitals.edit', [
            'id'    =>  $hospital->id,
        ]);



    }

    public function delete($id){
        $hospital = Hospital::find($id);
        $hospital->delete();

        return back();
    }
}
