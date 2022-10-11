<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Approve_deposit;
use Illuminate\Support\Facades\DB;



class ApprovedepositController extends Controller
{
    function show(Request $req){
       


        $deposit = Deposit::where('id',$req->id)->first();
        $deposit -> verified = $req->verified??'false';
        $deposit -> update($req->all());    
       // $deposit = Deposit::get();
        

        $total_deposit = $deposit->where('id',$req->id)->pluck('amount');
        $balance = $deposit->where('id',$req->id)->pluck('amount');
        $user_id = $deposit->where('id',$req->id)->pluck('payer_id');

        if(Approve_deposit::where('user_id',$user_id)->exists()){

            $depos = Approve_deposit::where('user_id',$user_id)->pluck('total_deposit');
            $total_deposit = $depos->sum()+$total_deposit->sum();

            $nbalance = Approve_deposit::where('user_id',$user_id)->pluck('balance');
            $total_balance = $nbalance->sum()+$balance->sum();


            $approve_deposit = new Approve_deposit;
            $approve_deposit->balance = $total_balance;
            $approve_deposit->total_deposit = $total_deposit;

            // $result = $approve_deposit->where('user_id',$user_id)->save();


            $result= DB::table('approve_deposits')
            ->where('user_id', $user_id)
            ->update([
                 'balance' => $total_balance,
                 'total_deposit' => $total_deposit
                ]);

           
        if($result){
            return response([
                "response" => '200',
                "data" => $result
            ],200);           }


        }
        // foreach($deposit as $key =>$value){
        //     Approve_deposit::updateOrCreate([
        //         'balance'=>$value->amount,
        //         'total_deposit'=>$value->amount,
        //         'user_id'=>$value->payer_id, 
        //     ]);
        // }
        // return 'data shifted';
        // $result =  $deposit -> update($req->all());
    
        // if($result){

        //     return response([
        //         "status" => '200',
        //         "message" =>'data has been updated'
        //     ]); 
        // }
        // else{
        // return response([
        //         "message" =>'Operation failed'
        //     ]);
        // }


    }
}
