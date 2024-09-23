<?php

namespace App\Http\Controllers\apicontroller;
use App\Models\Patient;
use App\Http\Controllers\Controller;
use App\Models\Apointment;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(){
        //

        $patients=Patient::all();
        if($patients===null){
            return response()->json(
                [
             'message'=>'not found any patients'
                ],
                404
                );


    }
    else{
        return response()->json(
            [
             'message'=>'succeses',
             $patients
            ],
            200
         );
    }

    }
    public function show($id)
    {

        $patient = Patient::find($id);
        $patient->load(['Apointments','doctors']);
        if(!$patient){
            return response()->json(
                [
             'message'=>'not found any patients'
                ],
                404
                );


    }
    else{
        return response()->json(
            [
             'message'=>'succeses',
             $patient
            ],
            200
         );
    }


}
public function create(Request $request)
{


    Patient::create($request->all());

    return response()->json(['message' => 'Patient created successfully'], 201);
}
public function destroy($id)
{

    $patient = Patient::find($id);

    if(!$patient){
        return response()->json(
            [
         'message'=>'not found any patients'
            ],
            404
            );


}
else{
    $patient->delete();
    return response()->json(
        [
         'message'=>'succeses delete',
         $patient
        ],
        200
     );
}
}

public function update(Request $request,$id)
{

    $patient = Patient::find($id);

    if($patient===null){
        return response()->json(
            [
         'message'=>'not found any patients'
            ],
            404
            );


}
else{
    $patient->update($request->all());

        return response()->json(
            [
         'message'=>'succese update patients'
            ],
           200
            );


}
}

}

