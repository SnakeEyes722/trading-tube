<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Balance;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    function AddDeposit(Request $req){

         $deposit = new Deposit;
         $deposit -> payer_id = $req->payer_id;
         $deposit -> account_type = $req->account_type;
         $deposit -> account_title = $req->account_title;
         $deposit -> account_no = $req->account_no;
         $deposit -> proof_image = $req->proof_image;

         $deposit -> amount = $req->amount;
         $deposit -> verified = $req->verified??'false';

         $result =  $deposit -> save();
    

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
