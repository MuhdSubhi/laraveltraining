<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    //test get function at browser
    //run get function at postman
    public function getAllStaff() {

        $staff = Staff::all();

        return response()->json([

            'msg'=>'List Of Data',
            'data'=> $staff
        ]);
    }

    //run create function at postman
    public function createStaff() {

        try {
             request()->validate([
            'fname' => 'required|min:3',
            'lname' => 'required|max:20'
            ]);
        
            // Staff::create(request()->all());

            $staff = new Staff;

            $staff ->fill(request()->all());
            $staff->user_id = auth()->user()->id;
            $staff->save();

            return response()->json([

            'msg'=>'Data Inserted'
            ]);
        }
        catch(\Exception $err){

            return response()->json([

                'msg'=>'Error : Invalid Input, Please Check All Field Is Been Filled',
                'errors'=> $err->getMessage()
            ]);
        }
    }

    //run create function at postman
    public function destroy($id) {

        Staff::destroy($id);

        return response()->json([

            'msg'=>'Data ID '. $id . ' Is Deleted' 
        ]);
    }

    //run create function at postman
    public function updateStaff($id) {

        $staff = Staff::find($id);

        $staff ->fill(request()->all());
        $staff->save();

        return response()->json([

            'msg'=>'Data ID '. $id . ' Is Updated' 
        ]);
    }
}
