<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormType;
use Illuminate\Support\Facades\Hash;
// use Auth;
// use Validator;
use Illuminate\Support\Str;
use App\Models\User;
// use App\Rules\ruleIdExist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormsController extends Controller
{

    
    public function addForm(Request $request)
    {
        try {
            $user=auth()->user()->id;
            $data=Form::create([
                'user_id'=>$user,
                'form_name' =>$request->form_name
            ]);
            return response()->json(["status"=> 200,
                        "message"=>"Form Is Add Successfully ",
                        "data"=> $data]);

        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }
    public function editForm(Request $request)
    {
        try {
           
           $exist=Form::find($request->id);
           if($exist != null){
            $user=auth()->user()->id;
            $exist->user_id=$user;
            $exist->form_name =$request->form_name;
            $exist->update();

            return response()->json(["status"=> 200,
                        "message"=>"Form Is updated Successfully ",
                        "data"=> $exist]);
           }else{
            return response()->json([
                'status' => 'error',
                'message' => "provided Id is not valied",
                'data' => [],
            ], 401);
           }
           

        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }
    public function addFormType(Request $request)
    {
        try {
            $user=auth()->user()->id;
            $data=new FormType();
            $data->field_type   =$request->field_type;
            $data->option_type  =$request->option_type;
            $data->field_name   =$request->filed_name;
            $storeForm=$data->save();
           
            return response()->json(["status"=> 200,
                        "message"=>"Form type Is Add Successfully ",
                        "data"=> $data]);

        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }
    public function editFormType(Request $request)
    {
        try {
            $user=auth()->user()->id;
            $data=FormType::find($request->id);
            if(!empty($data)){
                $data->field_type   =$request->field_type;
                $data->option_type  =$request->option_type;
                $data->field_name   =$request->filed_name;
                $storeForm=$data->update();
               
                return response()->json(["status"=> 200,
                            "message"=>"Form Type Is Updated Successfully ",
                            "data"=> $data]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => "provided Id is not valied",
                    'data' => [],
                ], 401);
            }
           

        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
    }
    public function addFormFiled(Request $request)
    {
        try {

            $data=FormFields::create([
                'form_id'=>$request->form_id,
                'field_type_id' =>$request->field_type_id
            ]);

            return response()->json(["status"=> 200,
                        "message"=>"Form Filed Is Add Successfully ",
                        "data"=> $data]);
        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }
     public function editFormFiled(Request $request)
    {
        try {
            $data=FormFields::find($request->id);
            $data->form_id=$request->form_id;
            $data->field_type_id=$request->field_type_id;
            return response()->json(["status"=> 200,
                        "message"=>"Form Filed Is Updated Successfully ",
                        "data"=> $data]);
        } catch (\exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e,
            ], 500);
            //throw $th;
        }
        

        
    }

     public function getformdata(Request $request)
    {
        $getForm = Form::where('form_name', $request->input('form_name'))->first();
        
        if (!$getForm) {
            return response()->json([
                "message" => "Form not found",
                "data" => [],
            ]);
        }
        
        $data = FormFields::where('form_id', $getForm->id)->get();
        $formattedData = [];
    
        foreach ($data as $key => $value) {
            $formField = DB::table('form_types')
                ->whereNotNull('group_name')
                ->where('id', $value->field_type_id)
                ->select('group_name', DB::raw('MAX(field_name) as field_name'), DB::raw('MAX(option_type) as option_type'))
                ->groupBy('group_name')
                ->first();
    
            if (!empty($formField)) {
                $groupExists = $formField->group_name;
                $fields = DB::table('form_types')
                    ->where('group_name', $groupExists)
                    ->get();
    
                $fetchFields = [];
    
                foreach ($fields as $key => $field) {
                    $fetchFields[] = [
                        "id" => $field->id,
                        "field_type" => $field->field_type,
                        "option_type" => $field->option_type,
                        "field_name" => $field->field_name,
                        "label_name" => Str::title(str_replace('_', ' ', $field->field_name)),
                        "parent_id" => $field->parent_id,
                        "group_name" => $field->group_name,
                        "created_at" => $field->created_at,
                        "updated_at" => $field->updated_at
                    ];
                }
    
                $formattedData[] = [
                    "group_name" => $groupExists,
                    "fields" => $fetchFields
                ];
            }
        }
    
        if (!empty($formattedData)) {
            return response()->json([
                "message" => $request->input('form_name') . " fields have been fetched successfully.",
                "data" => $formattedData,
            ]);
        } else {
            return response()->json([
                "message" => $request->input('form_name') . " fields No data found",
                "data" => [],
            ]);
        }
    }

    public function getformdataProject(Request $request)
    {
        dd($request);
        $data =FormFields::where('form_name',$request)->get();
        $formField=[];
        $formattedData=[];
        foreach ($data as $key => $value) {
            $formField = DB::table('form_types')
                ->whereNotNull('group_name')
                ->select('group_name', DB::raw('MAX(field_name) as field_name'), DB::raw('MAX(option_type) as option_type')) // Replace column1, column2, etc. with your actual column names
                ->groupBy('group_name')
                ->get();
                
        }
        foreach ($formField as $key => $value) {
         
             $groupExists=$value->group_name;
             if (!empty($groupExists)) {
                 $fields= DB::table('form_types')
                 ->where('group_name',$groupExists)
                 ->get();
                 $formattedData[] = [
                     "group_name" => $groupExists,
                     "fields" =>
                     [
                        "id"=>$fields->id,
                        "field_type"=>$fields->field_type,
                        "option_type"=>$fields->option_type,
                        "field_name"=>$fields->field_name,
                        "label_name"=>Str::title(str_replace('_', ' ', $fields->label_name)),
                        "parent_id"=>$fields->parent_id,
                        "group_name"=>$fields->group_name,
                        "created_at"=>$fields->created_at,
                        "updated_at"=>$fields->updated_at
    
                    ]
                    
                 ];
             }
         }
        return response()->json([
            "message" => "Property fields have been fetched successfully.",
            "data" => $formattedData,
        ]);
         
    }

    
    
}
