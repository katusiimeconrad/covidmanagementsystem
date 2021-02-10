<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class DashboardController extends Controller
{
    public function dashboard(){
     $patients = Patient::all()->groupBy('created_at');
     dd($patients);

        //dd($patients);
        foreach($patients as $patient){
            //count(($patient->created_at->format('M Y')))8;
            
        }
        return view('dashboard',compact('patients'));
    }
    
}
