<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Resources\CreditResource as CreditResource;
use App\Http\Resources\HttpResponseResource as Hrr;

use App\Credit;
use App\User;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $credits = Auth::user()->credits;
         return CreditResource::collection($credits);
    
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditRequest $request)
    {
        if(User::updateExpenseBalance(request('amount')) === true){        
            $data = $request->validated();
            $StoreCredit = Credit::create($data);
            return response()->json([
                "message"=>"Credit is saved successfully",
                'Credit'=> $StoreCredit
            ], 201); 
        } else {
            return response()->json(["message" => "Unable to give a credit due to insufficient balance ","status"=>400]);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Credits = Credit::where('id', $id)->orWhere('phone',$id)->orWhere('creditor', $id)->get();   
        if(count($Credits) === 0) {
            return response()->json([
                "message"=> "You have no Credit from this ID",
                "status" => 404
                ]);
        }        
        return CreditResource::collection($Credits);        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCreditRequest $request, $id)
    {
        if(User::updateExpenseBalance(request('amount')) === true){        
            $Credit  = Credit::findOrFail($id);
            $Credit->update($request->validated());
            return response()->json([
                "message"=>"Credit is updated successfully",
                'Credit'=> $Credit
            ], 200); 
        }else {
            return response()->json(["message" => "Unable to give a credit due to insufficient balance ","status"=>400]);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Credit  = Credit::findOrFail($id);
        $Credit->delete();
        return response()->json([
            "message"=>"Credit is deleted successfully",
        ], 200); 
    }
}
