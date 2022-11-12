<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function index(){
        return view('auth/register');
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request) {
        $user = User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
        ]);
        $token = auth()->attempt($request->only('email','password'));
        setcookie(config('jwt.COOKIE_KEY'),$token, time() + (86400 * 180), "/");
        return response()->json([
            'success' => 'User successfully registered',
            'user' => $user,
            'redirect' => route('welcome'),
            'access' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 600
            ]
        ], 201);
    }

}
