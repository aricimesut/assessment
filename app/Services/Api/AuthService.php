<?php

namespace App\Services\Api;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService extends ApiService
{
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $request
     * @return array
     */
    public function register($request) : array
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
        ],[],[
            'email' => 'Email',
            'password' => 'Şifre',
        ]
        );

        if ($validator->fails()) {
            $errors = implode(' ', $validator->errors()->all());
            return [
                'message' => $errors,
                'status' => 422,
                'data' => []
            ];
        }

        return $this->repository->store($request->all());
    }

    /**
     * @param $request
     * @return array
     */
    public function login($request)  : array
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = implode(' ', $validator->errors()->all());
            return [
                'message' => $errors,
                'status' => 422,
                'data' => []
            ];
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return [
                'message' => 'Giriş başarılı',
                'status' => 200,
                'data' => [
                    'token' => $token
                ]
            ];
        } else {
            return [
                'message' => 'Kullanıcı adı veya şifre hatalı',
                'status' => 401,
                'data' => []
            ];
        }

    }

    /**
     * @return array
     */
    public function user() : array
    {
        $user = Auth::user();
        return [
            'message' => 'Kullanıcı bilgileri',
            'status' => 200,
            'data' => [
                'user' => $user
            ]
        ];
    }

    /**
     * @return array
     */
    public function logout() : array
    {
        Auth::user()->token()->revoke();
        return [
            'message' => 'Çıkış başarılı',
            'status' => 200,
            'data' => []
        ];
    }

}
