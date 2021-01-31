<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DepositResource as DepositResource;
use App\Http\Requests\DepositRequest;

use App\User;
use App\Deposit;

class DepositController extends Controller
{
    public function index() {
        return DepositResource::collection(Auth::user()->deposits);
    }
    public function store(DepositRequest $req) {
        Deposit::create($req->validated());
        User::updateDepositBalance($req->amount);
        return response()->json(["status"=>201,"message"=>"Money is deposited"]);      
    }
}
