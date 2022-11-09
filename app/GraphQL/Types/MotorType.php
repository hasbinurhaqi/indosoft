<?php

namespace App\GraphQL\Types;

use App\Models\Motor;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MotorType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'MotorType',
        'description'   => 'Motor Type',
        'model'         => Motor::class,
    ];

    public function fields(): array
    {
        return (new Motor())->fields();
    }
}