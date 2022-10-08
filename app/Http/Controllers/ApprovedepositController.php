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
            $total_deposit = $depos->sum()+$balance->sum();

            return $total_deposit;
        }
        foreach($deposit as $key =>$value){
            Approve_deposit::updateOrCreate([
                'balance'=>$value->amount,
                'total_deposit'=>$value->amount,
                'user_id'=>$value->payer_id, 
            ]);
        }
        return 'data shifted';
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
