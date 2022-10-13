<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use Illuminate\Support\Facades\DB;
class InvestmentController extends Controller
{
    function AddInvestment(Request $req){

        $investment = new Investment;
        
        $investment-> package_id= $req -> package_id;
        $investment-> investor_id= $req -> investor_id;
        $investment-> investor_name= $req -> investor_name;
        $investment-> is_finished= $req -> is_finished??'false';
       
        $result =  $investment -> save();
    

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

    function fetchInvestment(Request $req){

        $response = DB::table('investments')->where('investor_id',$req->investor_id)
        ->join('packages','investments.package_id',"=",'packages.id')
        ->select('packages.title','packages.quantity','packages.description','packages.status','packages.image','investments.investor_name','investments.applied_price','investments.applied_income','investments.package_id','investments.investor_id','investments.created_at','investments.updated_at')
        ->get();

        return response()->json(['data'=>$response], 201);

    }


    }
