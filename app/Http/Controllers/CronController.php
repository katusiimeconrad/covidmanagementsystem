<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;
use App\Models\HealthOfficer;
use App\Models\Patient;
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
                    fseek($fp,$data * 68,SEEK_SET);
                    $line = fgets($fp,68);
                    $fname       = substr($line,4,10);
                    $fname       = str_replace("\0","",$fname);
                    if(strlen($fname) == 0){
                            break;
                    }
                    $lname       = substr($line,14,10);
                    $lname       = str_replace("\0","",$lname);
                    $date        = substr($line,24,11);
                    $date        = str_replace("\0","",$date);
                    $sex         = substr($line,35,2);
                    $sex         = str_replace("\0","",$sex);
                    $category         = substr($line,37,4);    
                    $category         = str_replace("\0","",$category);
                    $officer = substr($line,41,19);
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

                        //Upgrade a covid health officer
                        if(count($healthOfficer->patient) >= 100 && count($healthOfficer->patient) < 900 && ($healthOfficer->title != "senior healthOfficer" || $healthOfficer->title != "superintendent")){
                            
                            $minOfficer = Hospital::all()
                                ->where('hospitalType','=','Regional Referral')
                                ->min('officerNumber');

                            $hospital2 = Hospital::where('officerNumber','=',$minOfficer)
                                ->where('officerNumber','<=','100')
                                ->where('hospitalType','=','Regional Referral')
                                ->get()->first();

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
                        elseif(count($healthOfficer->patient) >= 900 && ($healthOfficer->title != "covid-19 consultant" || $healthOfficer->title != "director covid-19")){
                            
                            $minOfficer = Hospital::all()
                                ->where('hospitalType','=','National Referral')
                                ->min('officerNumber');

                            $hospital3 = Hospital::where('officerNumber','=',$minOfficer)
                                ->where('officerNumber','<=','900')
                                ->where('hospitalType','=','National Referral')
                                ->get()->first();

                            if($hospital3){
                                $officer = HealthOfficer::find($healthOfficer->id);
                                if(count($hospital3->healthofficer) == 0){
                                    $officer->title = "director covid-19";
                                }
                                else{
                                    $officer->title = "covid-19 consultant";
                                }
                                $officer->hospital_id = $hospital3->id;
                                $officer->status = "Active";
                                $officer->save();

                                $hospital3 = Hospital::find($hospital3->id);
                                $hospital3->officerNumber = ($hospital3->officerNumber + 1);
                                $hospital3->save();
                            }
                            else{
                                $officer = HealthOfficer::find($healthOfficer->id);
                                $officer->status = "Pending";
                                $officer->save();
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

                        //Upgrade a covid health officer
                        if(count($healthOfficer->patient) >= 100 && count($healthOfficer->patient) < 900 && ($healthOfficer->title != "senior healthOfficer" || $healthOfficer->title != "superintendent")){
                            
                            $minOfficer = Hospital::all()
                                ->where('hospitalType','=','Regional Referral')
                                ->min('officerNumber');

                            $hospital2 = Hospital::where('officerNumber','=',$minOfficer)
                                ->where('officerNumber','<=','100')
                                ->where('hospitalType','=','Regional Referral')
                                ->get()->first();

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
                        elseif(count($healthOfficer->patient) >= 900 && ($healthOfficer->title != "covid-19 consultant" || $healthOfficer->title != "director covid-19")){
                            
                            $minOfficer = Hospital::all()
                                ->where('hospitalType','=','National Referral')
                                ->min('officerNumber');

                            $hospital3 = Hospital::where('officerNumber','=',$minOfficer)
                                ->where('officerNumber','<=','900')
                                ->where('hospitalType','=','National Referral')
                                ->get()->first();

                            if($hospital3){
                                $officer = HealthOfficer::find($healthOfficer->id);
                                if(count($hospital3->healthofficer) == 0){
                                    $officer->title = "director covid-19";
                                }
                                else{
                                    $officer->title = "covid-19 consultant";
                                }
                                $officer->hospital_id = $hospital3->id;
                                $officer->status = "Active";
                                $officer->save();

                                $hospital3 = Hospital::find($hospital3->id);
                                $hospital3->officerNumber = ($hospital3->officerNumber + 1);
                                $hospital3->save();
                            }
                            else{
                                $officer = HealthOfficer::find($healthOfficer->id);
                                $officer->status = "Pending";
                                $officer->save();
                            }
                            

                        }

                    }
                    $data++;
                }
                
                //Delete records in file
                if($z == 1){
                    $count = 0;
                    while($count < 200){
                        fseek($fp,$count * 68,SEEK_SET);
                        $line = fgets($fp,68);
                        $fname       = substr($line,4,10);
                        $fname       = str_replace("\0","",$fname);
                        if(strlen($fname) == 0){
                                break;
                        }

                        fseek($fp,$count * 68,SEEK_SET);
                        $d =0;
                        for($d=0; $d < 68;$d++){
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
