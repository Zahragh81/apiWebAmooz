<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse($validate->messages(), '422');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token = $user->createToken('zahra')->accessToken;
        return $this->successResponse([
            'user' => $user,
            'token' => $token,
        ], 201);
    }


    public function login(Request $request)
    {
        //خب ماقراره برای لاگین از کاربر ایمیل و پسوردش رابگیریم که بره در دیتابیس چک بشه که اگر مطابقت داشت بره لاگین صورت بگیره
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse($validate->messages(), '422');
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)){
            return $this->errorResponse($validate->messages(), '422');
        }

        $token = $user->createToken('zahra')->accessToken;
        return $this->successResponse([
           'user' => $user,
           'token' => $token,
        ]);
    }
}
