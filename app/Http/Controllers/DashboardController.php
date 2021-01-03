<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($user_id){
        $user = new User;
        return response()->json([
            "credits"=>$user->totalAmount('credits','amount', $user_id),
            "debits"=>$user->totalAmount('debits','amount', $user_id),
            "expenses"=>$user->totalAmount('expenses','amount', $user_id),
            "totalDebits"=>$user->totalData('amount', $user_id, 'debits'),
            "totalCredits"=>$user->totalData('amount', $user_id, 'credits'),
            "totalExpense"=>$user->totalData('amount', $user_id, 'expenses'),
             "status"=> 200]);
    }
}
