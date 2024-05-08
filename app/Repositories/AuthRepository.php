<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthRepository
{
    /**
     * @var Auth
     */
   // protected user $user;

    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {
        $user=User::query()->create(
            [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),


            ]
            );
                $token=$user->createToken('API TOKEN')->plainTextToken;

            $result=[
                'user'=>$user,

                'token'=>$token
            ];
            return $result;
        });

    }
    public function login(array $data)
    {

        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
        {
            $user=User::where('email',$data['email'])->first();
            $token=$user->createToken('API TOKEN')->plainTextToken;
            $result=[
                'user'=>$user,
                'token'=>$token
            ];
            return $result;
        }
        else
        return 'Email and password does not match with our record';


}
public function logout()
{
    Auth::user()->token()->revoke();

    return 'logged out';
}
}
