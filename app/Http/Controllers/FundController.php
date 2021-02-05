<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    //
    public function index() {
        $funds = Fund::all();

        return view('funds.index', compact('funds'));

    }
}
