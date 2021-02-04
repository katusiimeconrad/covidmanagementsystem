<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\District;
class CronController extends Controller
{
    function index(){
        $hospitals = Hospital::all();
        foreach($hospitals as $hospital){
            $filename = $hospital->hospitalName.".dat";
            $path = base_path();
            $filename = $path."/".$filename;
    
            
            $fp = fopen($filename,"r+");
            
            fseek($fp,-1,SEEK_END);
            $data = fgets($fp,2);
            if($data == "\0"){
                    fseek($fp,-1,SEEK_END);
                    fputs($fp,0);
            }
            
            
            while($data<200){
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
                $category         = substr($line,41,25);
                $category         = str_replace("\0","",$category);

                $officer = substr($line,47,19);
                $officer = str_replace("\0","",$officer);
                $offi = explode(" ",$officer);

                dd($officer);

                $data++;
            }

        }
    }
}
