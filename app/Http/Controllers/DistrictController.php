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
        $district = District::find($id);
        $districts = District::all();
        return view('districts.edit',compact('district','districts'));
    }

    public function update(Request $request){
        $district = District::find($request->input('id'));
        $this->validate($request, [
            'districtName'      =>  'required|max:191|','unique:districts,districtName,'.$district->id.',id',
            'districtRegion'           => 'required|notIn:0',
        ]);

        $district->districtName = $request->input('districtName');
        $district->region = $request->input('districtRegion');
        $district->save();
        
        return redirect()
            ->route('districts.edit', [
                'id'        => $district->id,
            ]);

        

        
    }

    public function delete($id){
        dd('delete');
    }
}
