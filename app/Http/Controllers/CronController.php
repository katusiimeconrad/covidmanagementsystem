<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;
use App\Models\HealthOfficer;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use App\Models\PaymentUser;
use App\Models\Donor;
use App\Models\Fund;
use DB;

class CronController extends Controller
{
    function index(){
        
        $hospitals = Hospital::all();
        foreach($hospitals as $hospital){
            $filename = $hospital->hospitalName.".dat";
            $path = base_path();
            $filename = $path."/".$filename;

        
            if ( file_exists($filename) && ($fp = fopen($filename, "r+"))!==false ) {
                $fp = fopen($filename,"r+");
                $z = 0;
                $data = 0;
                $number = 0;
                while($data < 200){
                    
                    
                    if($data == 10){
                        $data++;
                        continue;
                    }

                    fseek($fp, $data * 76,SEEK_SET);
                    $line = fgets($fp,76);
                    $fname       = substr($line,4,15);
                    $fname       = str_replace("\0","",$fname);

                    if(strlen($fname) == 0){
                            break;
                    }
                    
                    $lname       = substr($line,19,15);
                    $lname       = str_replace("\0","",$lname);
                    $date        = substr($line,34,11);
                    $date        = str_replace("\0","",$date);
                    $sex         = substr($line,45,2);
                    $sex         = str_replace("\0","",$sex);
                    $category         = substr($line,47,4);    
                    $category         = str_replace("\0","",$category);
                    $officer = substr($line,51,25);
                    $officer = str_replace("\0","",$officer);
                    $offi = explode(" ",$officer);

                    

                    $healthOfficer = $hospital
                        ->healthofficer
                        ->where('lastName','=',$offi[0])
                        ->where('firstName','=',$offi[1])
                        ->first();
                    if($healthOfficer){
                        $patient = new Patient;
                        $patient->firstName = $fname;
                        $patient->lastName = $lname;
                        if($sex == "M"){
                            $patient->genderName = "Male";
                        }
                        else{
                            $patient->genderName = "Female";
                        }
                        $patient->submission = $date;
                        $patient->health_officer_id = $healthOfficer->id;
                        $patient->hospital_id = $hospital->id;
                        $patient->category = $category;
                        $patient->save();
                        $z = 1;
                        
                        $patientNo = count($healthOfficer->patient);
                        $patientNo =    count(
                                            DB::table('patients')
                                                ->where('health_officer_id', $healthOfficer->id)
                                                ->get()
                                        );
                        

                        //Upgrade a covid health officer
                        if( $patientNo >= 100 && $patientNo < 900 && ($healthOfficer->title != "senior healthOfficer" || $healthOfficer->title != "superintendent")){
                            //get hopital with least number of officers from regional referral hospital only
                            $hospitals2 = Hospital::where('hospitalType','=','Regional Referral')
                                                ->get();
                            $min = 99; 
                            foreach($hospitals2 as $hospitala){
                                if(count($hospitala->healthofficer) <= $min && $min < 100){
                                $min = count($hospitala->healthofficer);
                                    $hospital2 = $hospitala;
                                }
                            }

                        
                            if($hospital2){
                                $officer = HealthOfficer::find($healthOfficer->id);
                                if(count($hospital2->healthofficer) == 0){
                                    $officer->title = "superintendent";
                                }
                                else{
                                    $officer->title = "senior healthOfficer";
                                }
                                $officer->hospital_id = $hospital2->id;
                                $officer->status = "Active";
                                $officer->save();

                                $hospital2 = Hospital::find($hospital2->id);
                                $hospital2->officerNumber = ($hospital2->officerNumber + 1);
                                $hospital2->save();
                            }
                            else{
                                $officer = HealthOfficer::find($healthOfficer->id);
                                $officer->status = "Pending";
                                $officer->save();
                            }
                            
                        }
                        if($patientNo >= 900 && ($healthOfficer->title != "covid-19 consultant" || $healthOfficer->title != "director covid-19")){
                            $administrators = User::all();
                            $health_officers = HealthOfficer::all();
                            $funds = Fund::all();
                            $payments = Payment::all();

                            //Available Funds
                            $direct_amounts = $funds->whereNull('donor_id')->sum('amountPaid');
                            $donations = $funds->whereNotNull('donor_id')->sum('amountPaid');
                            $available_funds = $direct_amounts + $donations - $payments->sum('amount');

                            $officer = HealthOfficer::find($healthOfficer->id);
                            $officer->title = "covid-19 consultant";    
                            $officer->hospital_id = 200;
                            $officer->status = "Pending";
                            $officer->save();

                            if($available_funds > 10000000){
                                $new_payment = new Payment;
                                $new_payment->amount = 10000000;
                                $new_payment->date = now();
                                $new_payment->save();

                                $apay = new PaymentUser;
                                $apay->amount = 10000000;
                                $apay->health_officer_id = $officer->id;
                                $apay->payment_id = $new_payment->id;
                                $apay->time = now();
                                $apay->save();
                            }
    
                        }
                    }
                            
                    $healthOfficer = $hospital
                        ->healthofficer
                        ->where('firstName','=',$offi[0])
                        ->where('lastName','=',$offi[1])
                        ->first();
                    
                    if($healthOfficer){
                        $patient = new Patient;
                        $patient->firstName = $fname;
                        $patient->lastName = $lname;
                        if($sex == "M"){
                            $patient->genderName = "Male";
                        }
                        else{
                            $patient->genderName = "Female";
                        }
                        $patient->submission = $date;
                        $patient->health_officer_id = $healthOfficer->id;
                        $patient->hospital_id = $hospital->id;
                        $patient->category = $category;
                        $patient->save();
                        $z = 1;
                        
                        $patientNo = count($healthOfficer->patient);
                        $patientNo =    count(
                                            DB::table('patients')
                                                ->where('health_officer_id', $healthOfficer->id)
                                                ->get()
                                        );
                        

                        //Upgrade a covid health officer
                        if( $patientNo >= 100 && $patientNo < 900 && ($healthOfficer->title != "senior healthOfficer" || $healthOfficer->title != "superintendent")){
                            //get hopital with least number of officers from regional referral hospital only
                            $hospitals2 = Hospital::where('hospitalType','=','Regional Referral')
                                                ->get();
                            $min = 99; 
                            foreach($hospitals2 as $hospitala){
                                if(count($hospitala->healthofficer) <= $min && $min < 100){
                                $min = count($hospitala->healthofficer);
                                    $hospital2 = $hospitala;
                                }
                            }

                        
                            if($hospital2){
                                $officer = HealthOfficer::find($healthOfficer->id);
                                if(count($hospital2->healthofficer) == 0){
                                    $officer->title = "superintendent";
                                }
                                else{
                                    $officer->title = "senior healthOfficer";
                                }
                                $officer->hospital_id = $hospital2->id;
                                $officer->status = "Active";
                                $officer->save();

                                $hospital2 = Hospital::find($hospital2->id);
                                $hospital2->officerNumber = ($hospital2->officerNumber + 1);
                                $hospital2->save();
                            }
                            else{
                                $officer = HealthOfficer::find($healthOfficer->id);
                                $officer->status = "Pending";
                                $officer->save();
                            }
                            
                        }
                        if($patientNo >= 900 && ($healthOfficer->title != "covid-19 consultant" || $healthOfficer->title != "director covid-19")){
                            $administrators = User::all();
                            $health_officers = HealthOfficer::all();
                            $funds = Fund::all();
                            $payments = Payment::all();

                            //Available Funds
                            $direct_amounts = $funds->whereNull('donor_id')->sum('amountPaid');
                            $donations = $funds->whereNotNull('donor_id')->sum('amountPaid');
                            $available_funds = $direct_amounts + $donations - $payments->sum('amount');

                            $officer = HealthOfficer::find($healthOfficer->id);
                            $officer->title = "covid-19 consultant";    
                            $officer->hospital_id = 200;
                            $officer->status = "Pending";
                            $officer->save();

                            if($available_funds > 10000000){
                                $new_payment = new Payment;
                                $new_payment->amount = 10000000;
                                $new_payment->date = now();
                                $new_payment->save();

                                $apay = new PaymentUser;
                                $apay->amount = 10000000;
                                $apay->health_officer_id = $officer->id;
                                $apay->payment_id = $new_payment->id;
                                $apay->time = now();
                                $apay->save();
                            }
    
                        }
                    }
                        
                    $data++;
                }
                
                //Delete records in file
                if($z == 1){
                    $count = 0;
                    while($count < 200){
                        fseek($fp,$count * 78,SEEK_SET);
                        $line = fgets($fp,78);
                        $fname       = substr($line,4,15);
                        $fname       = str_replace("\0","",$fname);
                        if(strlen($fname) == 0){
                                break;
                        }

                        fseek($fp,$count * 78,SEEK_SET);
                        $d =0;
                        for($d=0; $d < 78;$d++){
                            fputs($fp,"\0");
                        } 
                        $count++;   
                    }
                }
                
                fseek($fp,-4,SEEK_END);
                fputs($fp,"\0");
            }
        }
    }
}
