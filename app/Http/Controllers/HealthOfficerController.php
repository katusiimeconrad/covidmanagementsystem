<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthOfficer;
use App\Models\Hospital;

class HealthOfficerController extends Controller
{
    public function index(){
        $healthOfficers = HealthOfficer::all();
        return view('officer.index', compact('healthOfficers'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'firstName' =>  'required',
            'lastName'  =>  'required',
            'gender'  => 'required|notIn:0',
        ]);

        //get hopital with least number of officers from general hospital only
        $minOfficer = Hospital::all()
                            ->where('hospitalType','=','General')
                            ->min('officerNumber');
        
        $hospital = Hospital::where('officerNumber','=',$minOfficer)
                            ->where('officerNumber','<=','15')
                            ->where('hospitalType','=','General')
                            ->get()->first();
        
        //create officer
        $officer = new healthOfficer;
        $officer->firstName = $request->input('firstName');
        $officer->lastName = $request->input('lastName');
        $officer->genderName = $request->input('gender');
        $officer->noOfPatients = 0;
        if($hospital){
            if(count($hospital->healthofficer) == 0){
                $officer->title = "Head healthOfficer";
            }
            else{
                $officer->title = "healthOfficer";
            }
            $officer->hospital_id = $hospital->id;
            $officer->status = "Active";
            $hospital = Hospital::find($hospital->id);
            $hospital->officerNumber = ($hospital->officerNumber + 1);
            $hospital->save();
        }
        else{
            $officer->hospital_id = 200;
            $officer->status = "Pending";
        }
        $officer->admin_id = 1;
        $officer->save();
        
        return redirect()->route('officers.index');
        
    }

    public function edit($id){
        $officer = HealthOfficer::find($id);
        $healthOfficers = HealthOfficer::all();
        return view("officer.edit", compact('officer','healthOfficers'));
    }

    public function update(Request $request){
        dd('update');
        
    }

    public function delete($id){
        dd('delete');
        
    }
}
