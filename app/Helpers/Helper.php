<?php
namespace App\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;

class Helper
{
    public static function validateWebJwt()
    {
        if(isset($_COOKIE[config('jwt.COOKIE_KEY')]) && $_COOKIE[config('jwt.COOKIE_KEY')] != ""){

            $request = app(\Illuminate\Http\Request::class);
            $request->headers->set('authorization', 'Bearer '.$_COOKIE[config('jwt.COOKIE_KEY')]);
            try {
                return JWTAuth::parseToken()->authenticate(); 
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}