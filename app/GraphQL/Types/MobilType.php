<?php

namespace App\GraphQL\Types;

use App\Models\Mobil;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MobilType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'MobilType',
        'description'   => 'Type of mobil',
        'model'         => Mobil::class,
    ];

    public function fields(): array
    {
        return (new Mobil())->fields();
    }
}