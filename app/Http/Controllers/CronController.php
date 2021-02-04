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
    
            
            $fp = fopen($filename,"r+");
            $z = 0;
            
            $data = 0;
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
                    $patient->healthofficer_id = $healthOfficer->id;
                    $patient->hospital_id = $hospital->id;
                    $patient->category = $category;
                    $patient->save();
                    $z = 1;
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
                    $patient->genderName = $sex;
                    $patient->healthofficer_id = $healthOfficer->id;
                    $patient->hospital_id = $hospital->id;
                    $patient->category = $category;
                    $patient->save();
                    $z = 1;
                    
                }

                $data++;
            }

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
