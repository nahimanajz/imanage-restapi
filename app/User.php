<?php

namespace App;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','balance','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function deposits() {
        return $this->hasMany(Deposit::class);
    }
    public function credits() {
        return $this->hasMany(Credit::class);
    }
    
    public function debits() {
        return $this->hasMany(Debit::class);
    }
    
    public function expenses() {
        return $this->hasMany(Expense::class);
    }
    
    private static function getBalance() {
        $user_id = request('user_id');
        return User::find($user_id)->balance;
    }
    
    public static function updateExpenseBalance($expendedAmount){
        if(User::getBalance() < $expendedAmount){
            return false;
        } else {
            $user= User::find(request('user_id'));
            $user->balance = User::getBalance() - $expendedAmount;
            $user->update();
            return true;
        }
    }
    
    public static function updateDepositBalance($depositedAmount){
        $user= User::find(request('user_id'));
        $user->update(['balance'=> User::getBalance() + $depositedAmount]);  
    }
    public function totalAmount($table, $column, $user_id):int{
        return DB::table($table)->where('user_id',$user_id)->sum($column);       
    }
    public function totalData($column, $user_id, $table):int{
        return  DB::table($table)->where('user_id',$user_id)->count($column);
     }
}
