<?php

namespace App\GraphQL\Types;

use App\Models\Vehicle;
use Rebing\GraphQL\Support\Type as GraphQLType;

class VehicleType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Vehicle',
        'description'   => 'Vehicle',
        'model'         => Vehicle::class,
    ];

    public function fields(): array
    {
        return (new Vehicle())->fields();
    }
}