<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use JWTAuth;
use Cookie;

class LoginController extends Controller
{
     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return view('auth/login');
    }
    
    public function login(LoginRequest $request){
        if (!$token = auth()->attempt($request->only('email','password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        setcookie(config('jwt.COOKIE_KEY'),$token, time() + (86400 * 180), "/");
        return response()->json([
            'success' => 'Logined Successfully!',
            'redirect' => route('welcome'),
            'user' => auth()->user(),
            'access' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 600
            ]
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $request->headers->set('authorization', 'Bearer '.$_COOKIE[config('jwt.COOKIE_KEY')]);
        JWTAuth::manager()->invalidate(new \Tymon\JWTAuth\Token($_COOKIE[config('jwt.COOKIE_KEY')]), true);
        auth()->logout();
        $array = array();
        foreach (Cookie::get() as $key => $item){
            $array [] = cookie($key, null, -2628000, null, null);
        }
        if( $request->wantsJson() || $request->expectsJson()){
            return response()->json(['message' => 'User successfully signed out'],201)->withCookie($array);
        }else{
            return redirect()->route('welcome');
        }
    }
}
