<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Uuids;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Uuids, HasApiTokens, Authenticatable, Authorizable, CanResetPassword;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    //use HasApiTokens, HasFactory, Notifiable, Uuids, ;

    public $timestamps = true;
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fields(): array
    {
        return [
            'status' => [
                'type' => Type::string(),
                'description' => 'The identifier status login the users',
            ],
            'id' => [
                'type' => Type::string(),
                'description' => 'The identifier of the users',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The users name',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email name',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The token access',
            ],
        ];
    }
}
