<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function authentication(array $args)
    {
        $credentials = [ 'email' => $args['email'], 'password' => $args['password'] ];

        $token = auth()->attempt($credentials);

        if (!$token) {
            return [
                'status' => 'error',
                'id' => null,
                'name' => null,
                'email' => null,
                'token' => null,
            ];
        }

        $user = User::where('email', $args['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->status = "success";
        $user->token = $token;
        return $user;
    }
}