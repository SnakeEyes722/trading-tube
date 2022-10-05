<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Approve_deposit;
use Illuminate\Support\Facades\DB;



class ApprovedepositController extends Controller
{
    function show(Request $req,$id){

       

        $deposit =Deposit::where('id',$id)->first();
        $deposit -> verified = $req->verified??'false';
        $deposit -> update($req->all());
            

        $deposit = Deposit::get();
        
        foreach($deposit as $key =>$value){
            Approve_deposit::updateOrCreate([
                'balance'=>$value->amount,
                'total_deposit'=>$value->amount,
                'user_id'=>$value->payer_id,


            ]);
            
        }

        $approve_deposits = Approve_deposit::where(['user_id' => $req->payer_id])->exists();
            
       return $approve_deposits;

        //return 'data shifted';
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
