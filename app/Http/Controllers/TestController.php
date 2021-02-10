<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $total_fund = 140000000;
        if($total_fund > 100000000){
            $rem = $total_fund - 100000000;

            //first director cut 
            $director = 5000000;
            $rem = $rem - 5000000;

            //superintendant
            $super = 2500000;
            $rem = $rem - 2500000; 

            //

            //admin last 
            $admin = (3/4) * $super;
        }
    }
}
