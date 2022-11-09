<?php

namespace App\GraphQL\Types;

use App\Models\User;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserProfileType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'UserProfile',
        'description'   => 'Responsible for food delivery in the region.',
        'model'         => User::class,
    ];

    public function fields(): array
    {
        return (new User())->fields();
    }
}
