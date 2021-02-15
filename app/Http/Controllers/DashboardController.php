<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class DashboardController extends Controller
{
    public function dashboard(){
        $patients = Patient::all();

        //group patients by month and year
        $monthly_patients = Patient::orderBy('submission')->get()->groupBy(function($data) {
            return $data->submission->format('Y-m');
        });
        //dd(isset($monthly_patients['2021-01']));
        $yr20 = array_fill(0,12,0);
        $yr21 = array_fill(0,12,0);
        for ($i=1; $i <= 12; $i++) {
            $value = sprintf("%02d", $i);
            if (isset($monthly_patients['2020-'.$value])) {
                $x = count($monthly_patients['2020-'.$value]);
                $yr20[$i-1] = $x;
            }else if (isset($monthly_patients['2021-'.$value])) {
                $y = count($monthly_patients['2021-'.$value]);
                $yr21[$i-1] = $y;
            }
        }
        return view('dashboard',compact('patients','yr20','yr21'));
    }
    
}
