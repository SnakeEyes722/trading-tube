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
        $deposit -> status = $req->status;
        $deposit -> amount = $req->amount;
        $deposit -> verified = $req->verified??'false';

        $pic = time().'1.'.$req->proof_image->extension();
        $req->proof_image->move(public_path('post'),$pic);
        $path = "$pic";
        $deposit->proof_image=$path;

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

    // function UpdateDeposit(Request $req,$user_id){


    //     $deposit =Deposit::where('user_id',$user_id)->first();
       
    //     $deposit -> verified = $req->verified??'false';

    //     //$deposit = Deposit::where('user_id', '=',  $req->user_id)->get();

    //    $data =  DB::table('deposits')
        
    //          ->select('balance')
    //         ->where('user_id',$user_id)
    //         ->first();

    //         DB::table('balances')->insert($data)([

    //                     'amount' => $data->balance,
        
    //                 ]);
        
    //     $result =  $deposit -> update($req->all());
    
    //     if($result){

    //         return response([
    //             "status" => '200',
    //             "message" =>'data has been updated'
    //         ]);
    //     }
    //     else{
    //     return response([
    //             "message" =>'Operation failed'
    //         ]);
    //     }


    //     // $deposit = new Deposit;

    //     // $deposit = Deposit::where('user_id', '=',  $req->user_id)->get();
    //     // $count = $deposit->count();

    //     // DB::table('balances')
    //     // ->where('user_id', $req->user_id)
    //     // ->increment('total_deposit', $req->total_deposit && 'balance');

    //     // DB::table('deposits')
    //     // ->where('user_id', $req->user_id)
    //     // ->update('verifies', $req->verified);

      
    // }

    
}
