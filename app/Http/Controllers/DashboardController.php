<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class DashboardController extends Controller
{
    public function dashboard(){
     $patients = Patient::all();

        /*foreach($patients as $patient){
            dd($patient->submission);
        }
        /*$students = Patient::orderBy('created_at')->get()->groupBy(function($data) {
            return $data->created_at->format('M Y');
        });
        foreach ($students as $student) {
            dd(count($student));
        }*/
        return view('dashboard',compact('patients'));
    }
    
}
