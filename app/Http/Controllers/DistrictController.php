<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    public function index(){
        
        $districts = District::all();
        return view('districts.index', compact('districts'));
    }

    public function create(){
        return view('districts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'districtName'      =>  'required|max:191|unique:districts',
            'districtRegion'           => 'required|notIn:0',
        ]);

        $district = new District;
        $district->districtName = $request->input('districtName');
        $district->region = $request->input('districtRegion');
        $district->save();
        
        return redirect()->route('districts.index');
        
    }

    public function edit($id){
        dd('edit');
    }

    public function update(Request $request){
        dd('update');
    }

    public function delete($id){
        dd('delete');
    }
}
