<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\referral_code;

class ReferalController extends Controller
{
    function addreferrals(Request $req){

        $referral_code = new Referral_code;
            
            $referral_code-> user_id= $req -> user_id;
            $referral_code-> three_letters= $req -> three_letters;


            
           
            $result =  $referral_code -> save();
        
    
            if($result){
    
                return response([
                    "status" => '200',
                    "message" =>'data has been saved'
                ]);
            }
            else{
            return response([
                    "message" =>'Operation failed'
                ]);
            }
        }
    
     
}
