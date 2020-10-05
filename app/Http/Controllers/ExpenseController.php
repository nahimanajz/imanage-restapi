<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Expense;
use App\User;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Resources\ExpenseResource as ExpenseResource;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExpenseResource::collection(Auth::user()->expenses);     
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $req)
    {
        if(User::updateExpenseBalance(request('amount')) === true){
            return response()->json([
                "message"=> "Expense stored successfully",
                "expense" => Expense::create($req->validated())], 201);
        } else {
            return response()->json(["message" => "Insufficient Balance ","status"=> 400]);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $expense = Expense::where('category',$category)->get();
        return ExpenseResource::collection($expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExpenseRequest $request, $id)
    {
        if(User::updateExpenseBalance(request('amount')) === true){        
            $expense = Expense::findOrFail($id);
            $expense->update($request->validated());
            
            return response()->json([
                 "message"=> "Expense Updated Successfully",
                 "expense" => $expense 
           ], 200);
        }else {
            return response()->json(["message" => "Insufficient Balance "], 400);
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
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json([ "message"=> "Expense Deleted Successfully"], 200);
    }
}
