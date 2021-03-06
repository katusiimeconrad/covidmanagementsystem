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
        $hospitals = Hospital::where('hospitalType','=','General')
                            ->get();
        $min = 14; 
        foreach($hospitals as $hospitala){
            if(count($hospitala->healthofficer) <= $min && $min < 15){
                $min = count($hospitala->healthofficer);
                $hospital = $hospitala;
            }
        }

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

    public function assign($id){
        $officer = HealthOfficer::find($id);
        //get hopital with least number of officers from general hospital only
        $hospitals = Hospital::where('hospitalType','=','National Referral')
                            ->get();
        $min = 1000; 
        foreach($hospitals as $hospitala){
            if(count($hospitala->healthofficer) <= $min){
                $min = count($hospitala->healthofficer);
                $hospital = $hospitala;
            }
        }

        if(count($hospital->healthofficer) == 0){
            $officer->title = "director covid-19";
        }
        
        $officer->hospital_id = $hospital->id;
        $officer->status = "Active";
        $officer->save();

        return redirect()->back();
    }

    public function edit($id){
        $officer = HealthOfficer::find($id);
        $healthOfficers = HealthOfficer::all();
        return view("officer.edit", compact('officer','healthOfficers'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'firstName' =>  'required',
            'lastName'  =>  'required',
            'gender'  => 'required|notIn:0',
        ]);
        $officer = HealthOfficer::find($request->input('officer_id'));
        $officer->firstName = $request->input('firstName');
        $officer->lastName = $request->input('lastName');
        $officer->save();

        return redirect()->route('officers.edit', [
            'id'    =>  $officer->id,
        ]);



    }

    public function delete($id){
        $healthOfficer = HealthOfficer::find($id);
        $healthOfficer->delete();

        return back();
    }
}
