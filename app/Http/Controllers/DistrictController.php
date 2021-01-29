<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    //
    public function index(){
        $districts = District::all();

        return view('district.index', ['districts' => $districts]);


    }

   /* public function store(Request $request) {
        $district = new District();
        $district->name = $request->name;
        $district->code = $request->code;

        $district->save();
    }

*/
    //Adding
    public function store(Request $request) {
        $district = District::create([
            'name' => $request->name,
            'code' => $request->code
        ]);
        return $this->index();
    }

    //Deleting

    public function delete(Request $request) {
        $deletedrows = District::where('name', $request->name)->delete();

        return $this->index();
    }

    //find a specific district

    /*
    public function show( $name ) {

       return view('district.show', ['district' => District::findOrFail($name)]);

    }
    */

    public function show( Request $request ) {

        $district = District::where('name', $request->name)->get()->first();
    

        return view('district.show', compact('district'));
    }


    /*
      {
           public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
    }




    */













    ///Route::get('/', function () {
   /// return view('greeting', ['name' => 'James']);
/// });
}
