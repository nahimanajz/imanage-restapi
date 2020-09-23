<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserValidator;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource as UserResource;


class AuthController extends Controller
{
    public function login(UserLoginRequest $req) {
        try{
            $data = Auth::attempt(['email' => request('email'), 'password' => bcrypt(request('password'))]);
            return dd($data);
            $user = Auth::user(); 
            
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], 200); 

           /* $credentials = $req->validated();
            $d = Auth::attempt($credentials);
            $user = Auth::user();
            return dd($credentials);
            $success['token'] = $user->createToken('MyApp')->successToken;
            return $this->getHttpResponse( "welcome",$success, 200);
           */ 
        
        }catch(Expception $e) {
            return $this->getHttpResponse("error", $e->getMessage(),500);
        }
        
       
       
    }
    public function signup(UserValidator $req){

        $data = array_merge($req->validated(), ['password'=>bcrypt(request()->password)]);
        $user = User::create($data);
        $success['user'] = $user;
        $success['token'] = $user->createToken('MyApp')->accessToken;
        return $this->getHttpResponse("success", $success, 200);
    }
    public function details() {
        return UserResource::collection(Auth::user());  
    }

    public function getHttpResponse(string $status = null, $data = null, $response) {
        return response()->json([
            "status"=> $status,
            "data"=> $data,
            
        ], $response);
    }
   
}
