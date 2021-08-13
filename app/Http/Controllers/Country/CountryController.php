<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{
    //
    
    /**
     * country
     * This function get
     * list of all country 
     * and display them
     * @return void
     */
    public function country()
    {
        return response()->json(Country::get(),200);
    }
    
    /**p
     * countryById
     * This function get
     * country by ID 
     * and display them
     * @param  mixed $id
     * @return void
     */
    public function countryById($id){
        $countryId= Country::find($id);
        if(is_null($countryId)){
            return response()->json(['message','Record not found!'],404);
        }
        return response()->json($countryId,200);

    }
    
    /**
     * countrySaved
     * This save Country
     * into database
     * @param  mixed $request
     * @return void
     */
    public function countrySaved(Request $request){

        $rules = [
            'name' => 'required|min:3',
            'iso' => 'required|min:2',
        ];
        $validator = Validator::make($request->all(),$rules);

        // $validator = Validator::make($request->all(), [
        //           'name' => 'required|min:3',
        //       'iso' => 'required|min:2',
        // ]);

        if($validator->fails()){
            return response()->json($validator->errors(),404);

        }
        $country = Country::create($request->all());
        return response()->json($country, 201);
    }
    
    /**
     * countryUpdate
     * This function update
     * single country
     * @param  mixed $request
     * @param  mixed $country
     * @return void
     */
    public function countryUpdate(Request $request, $id){
      
        $country= Country::find($id);

        if(is_null($country)){
            return response()->json(['message','Record not found!'],404);
        }
        
        $country->update($request->all());
        return response()->json($country,200);
    }
    
    /**
     * countryDelete
     * Delete single Country
     * from the database
     * @param  mixed $request
     * @param  mixed $country
     * @return void
     */
    public function countryDelete(Request $request, $id){

        $country= Country::find($id);

        if(is_null($country)){
            return response()->json(['message','Record not found!'],404);
        }

        $country->delete($request->all());
        return response()->json($country,204);
    }
}
