<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    function AddPackage(Request $req){
    
        

        $Errors = [];
        
        if(!$req->title or !$req->quantity or !$req->price or !$req->income or !$req->description or !$req->status or !$req->image ){
            
           

                        if (!$req->title) {
                    $vars = (object)array("message"=>"Title is Required");

                        array_push($Errors,$vars);

                        }

            
                if (!$req->quantity) {
                    $vars = (object)array("message"=>"Quantity is Required");
            
                        array_push($Errors,$vars);
            
                    } 
                    if (!$req->price) {
                        $vars = (object)array("message"=>"Price is Required");
                
                            array_push($Errors,$vars);
                
                        } 
                        if (!$req->income) {
                            $vars = (object)array("message"=>"Income is Required");
                    
                                array_push($Errors,$vars);
                    
                            } 
                            if (!$req->description) {
                                $vars = (object)array("message"=>"Description is Required");
                        
                                    array_push($Errors,$vars);
                        
                                } 
                                if (!$req->status) {
                                    $vars = (object)array("message"=>"Status is Required");
                            
                                        array_push($Errors,$vars);
                            
                                    } 
                                    if (!$req->image) {
                                        $vars = (object)array("message"=>"Image is Required");
                                
                                            array_push($Errors,$vars);
                                
                                        } 

          return [
            'data'=> $Errors,
            'status'=> '401'
   
            ]; 
           }

           else {

           $package = new Package;
        
        $package-> title= $req -> title;
        $package-> quantity= $req -> quantity;
        $package-> price= $req -> price;
        $package-> income= $req -> income;
        $package-> description= $req -> description;
        $package-> status= $req -> status;
        
        $pic = time().'1.'.$req->image->extension();
        $req->image->move(public_path('post'),$pic);
        $path = "$pic";
        $package->image=$path;
       
        $result =  $package -> save();
    

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
    

function fetchallpackage(){
    return Package::all();
}

function fetch_package_id(Request $req,$id){
    $package = Package::find($id);
    if($package != null){
        return  response([
          'status'=>'200',
          'data'=> $package
        ],200); 
        }
        else{
      
        return  response([
          'status'=>'400',
          'message'=> 'operation failed'
          
        ],400);  
        }

}

function UpdatePackage(Request $req,$id){
    
    $package = Package::find($id);
    
    $package-> title= $req -> title;
    $package-> quantity= $req -> quantity;
    $package-> price= $req -> price;
    $package-> income= $req -> income;
    $package-> description= $req -> description;
    $package-> status= $req -> status;
    
    $pic = time().'1.'.$req->image->extension();
    $req->image->move(public_path('post'),$pic);
    $path = "$pic";
    $package->image=$path;
   
    $result =  $package -> update($req->all());


    if($result){

        return response([
            "status" => '200',
            "message" =>'data has been updated'
        ]);
    }
    else{
    return response([
            "message" =>'Operation failed'
        ]);
    }
    

}

function UpdatePackageStatus(Request $req,$id){
    
    $package = Package::find($id);   
    $package-> status= $req -> status;
   
    $result =  $package -> update($req->all());


    if($result){

        return response([
            "status" => '200',
            "message" =>'data has been updated'
        ]);
    }
    else{
    return response([
            "message" =>'Operation failed'
        ]);
    }
    

}

public function deletepackage($id){
    
    $result =  Package::destroy($id);
    
       if($result){
           return["result"=>"Data Deleted"];

       }
       else{
           return["result"=>"Error occured"];

       }
 }

 

}
