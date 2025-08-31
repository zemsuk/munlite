<?php
namespace App\Auth;

use App\Auth\Model\User;
use App\Controller;
use Zems\Hash;

class Auth extends Controller{
    public static function id(){
        $auth_id = Hash::find_key();
        $user = User::select('id,remember_token')->find($auth_id);
        $token = Hash::token_origin($auth_id);
        
        $ck = Hash::hash_verify($token, $user->remember_token);
        $cont = new Controller;
        if($ck){

            return $user->id;
        }
        return $cont->response_json(["something went wrong!!"]);
    }
    public static function user(){
        $auth_id = Hash::find_key();
        $user = User::select('id, name, email, phone, balance, refar_id, withdrawl_method, withdrawl_account, remember_token')->find($auth_id);
        $token = Hash::token_origin($auth_id);
        
        $ck = Hash::hash_verify($token, $user->remember_token);
        unset($user->remember_token);
        $cont = new Controller;
        if($ck){
            return $cont->response_json($user);
        }
        return $cont->response_json(["something went wrong!!"]);
    }
}