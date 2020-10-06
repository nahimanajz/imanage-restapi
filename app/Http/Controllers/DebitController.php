<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDebitRequest;
use App\Http\Resources\DebitResource as DebitResource;
use App\Debit;
use App\User;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return DebitResource::collection(Auth::user()->debits);
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebitRequest $request)
    {
        $data = $request->validated();
        $storeDebit = Debit::create($data);
        User::updateDepositBalance(request('amount'));
        return response()->json([
            "message"=>"Debit is saved successfully",
            "debit"=> $storeDebit
        ], 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debits = Debit::where('id', $id)->orWhere('phone',$id)->orWhere('debitor', $id)->get();   
        if(count($debits) === 0) {
            return response()->json([
                "message"=> "You have no debit from this ID",
                "status" => 404
                ]);
        }        
        return DebitResource::collection($debits);        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDebitRequest $request, $id)
    {
        $debit  = Debit::findOrFail($id);
        $debit->update($request->validated());
        User::updateDepositBalance();
        return response()->json([
            "message"=>"debit is updated successfully",
            "debit"=> $debit,
            "status"=> 200
        ]); 
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $debit  = Debit::findOrFail($id);
        $debit->delete();
        return response()->json([
            "message"=>"Debit is deleted successfully",
            "status"=>200
        ]); 
    }
}
