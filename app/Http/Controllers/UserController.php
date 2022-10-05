<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
class UserController extends Controller
{
    public function createuser(Request $req){

        $Errors = [];
        // hello there

        $djfd = 'sd';
        
        if(!$req->password or !$req->email or !$req->phone or !$req->username or !$req->password_confirmation or !$req->cnic or !$req->referal_code ){
            
           

         if (!$req->email) {
       $vars = (object)array("message"=>"Email is Required");

           array_push($Errors,$vars);

          } 

          if (!$req->phone) {
            $vars = (object)array("message"=>"Phone is Required");
     
                array_push($Errors,$vars);
     
               }
               if (!$req->password) {
                $vars = (object)array("message"=>"password is Required");
         
                    array_push($Errors,$vars);
         
                   } 
                   if (!$req->password_confirmation) {
                    $vars = (object)array("message"=>"password_confirmation is Required");
             
                        array_push($Errors,$vars);
             
                       } 
                       if (!$req->username) {
                        $vars = (object)array("message"=>"username is Required");
                 
                            array_push($Errors,$vars);
                 
                           } 

                           if (!$req->cnic) {
                            $vars = (object)array("message"=>"cnic is Required");
                     
                                array_push($Errors,$vars);
                     
                               } 

                               if (!$req->referal_code) {
                                $vars = (object)array("message"=>"referal_code is Required");
                         
                                    array_push($Errors,$vars);
                         
                                   } 
    

                   



          return [
            'data'=> $Errors,
            'status'=> '401'
   
            ]; 
           }

        
    


        if(User::where('username',$req->username)->exists()){

         return response([
             "message" => '401',
             "message" => 'username already have taken'
         ],401);

        }

        $user = User::where('email',$req->email)->first();
        if($user){

            return response([

                "message" => '401',
                "message" =>'User already registered please enter different email'
            ],401);}

        $user = User::where('phone',$req->phone)->first();
            if($user){
    
                return response([
    
                    "message" => '401',
                    "message" =>'User already registered please enter different phone number'
                ],401);}

         

     $field = $req->validate([
         'email' => 'required|string|unique:users,email',
         'username' => 'required|string|unique:users,username',
         'password' => 'required|string|min:6|confirmed',
         'phone' => 'required|string',
         'cnic' => 'required|string',
         'referal_code' => 'required|string',
         
         
         
     ]);

     
 
    
    

     $user = User::create([
          'email' => $field['email'],
          'username' => $field['username'],
          'password' => bcrypt($field['password']),
          'phone' => $field['phone'],
          'cnic' => $field['cnic'],
          'referal_code' => $field['referal_code'],
       
          
          
          

     ]);

     

     $token = $user->createToken('myapptaken')->plainTextToken;
     $response = [

               'user' => $user,
               'token' => $token,
               'response' => "200"
     ];

     return response($response, 201);
     
 

}

public function login(Request $req){


    // if(!$req->password or !$req->phone){
    //     return response([

    //         "message" => '401',
    //         "message" =>'operation failed'
    //     ],401);
    //    }

  
    $messages = [
        "phone.required" => "phone is required",
        "phone.phone" => "phone is not valid",
        "phone.exists" => "phone doesn't exists",
        "password.exists" => "Password doesn't match",
        "password.required" => "Password is required",
        "password.min" => "Password must be at least 6 characters"
    ];
    $validator = Validator::make($req->all(), [
        'phone' => 'required',
        'password' => 'required|min:6'
    ], $messages);

    if ($validator->fails()) {
       return $messages = $validator->messages();
    } else {
        $user = User::where('phone',$req->phone)->first();

        if(!$user){

            return response([

                "message" => '401',
                "message" =>'No user found'
            ],401);
        }

         if(!Hash::check($req->password,$user->password)){
                return response([

                    "message" => '401',
                    "message" =>'Invalid password'
                ],401);
            }
        

$token = $user->createToken('myapptoken')->plainTextToken;

$response = [
    'user' => $user,
    'token' => $token,
    'response' => "200"

];

return response($response, 201);

}
}

function updatepassword(Request $req){
	
    $validator = Validator::make($req->all(), [
        'old_password' => 'required',
        'password' => 'required|min:6',
      'confirm_password' => 'required|same:password'
    ]);
    if ($validator->fails()) {
       return response()->json([
         'message' => 'Validatio fails',
         'errors' => $validator->errors()
         ],402);
}
    else{
      $user = User::where([
            'id' => $req->id
        ])
        ->first();
    if($user && Hash::check($req->old_password,$user->password)){
        $user->update([
          'password'=>Hash::make($req->password)
        ]);
        return response()->json([
            "message" =>'password is changed'
        ],200);
    }

    if (!(Hash::check($req->old_password,$user->password))) {
        return response()->json(['message' => 'old password does not match']);
    }
    else{
        return response()->json([
            "message" =>'Operation failed'
        ],401);
    }
}
    }

}
