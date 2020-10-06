<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(15);
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignupRequest $request)
    {
        $validated = $request->validated();
        $data = array_merge($validated, ["password" => bcrypt($request->password)]);

        $user = User::create($data);
        return response()->json([
            "message" => "User registered successfully",
            "user"=>$user,
            "token" => $this->signToken($request)
        ],
            201);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        return new UserResource(User::findOrFail($id));
    }
    /**
     * Login user and create token
     */
      public function login(UserLoginRequest $req) {
            $credentials = $req->validated();
            if(!Auth::attempt($credentials)){
                return json_encode(['error'=>true, 'message' => 'Invalid Email or Password'], 401);
            }           
            return response()->json([
                'error'=>false,
                'user' => Auth::user(),
                'token' => $this->signToken($req)
               
            ]);      
           
      } 
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $req) {
        $req->user()->tokens()->delete();
        return response()->json([
            "message" => "Successfully logged out"
        ]);
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $req) {
        return response()->json($req->user());
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserValidator $request, $id)
    {
        $user = User::findOrFail($id);
        $data = array_merge($request->validated());
        $user->update($data);
        $s= trans('messages.updated');
        return response()->json([
            "message" => $s,
            "user"=>$user],
            201);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->softDelete();
        return response()->json(["message" => "User is deleted"], 200);
    }
   private function signToken(Request $req) {
    $key = ($req->device_name)?(string)$req->device_name:'Personal Access Token';
    return $req->user()->createToken($key)->plainTextToken; 
   }
}
