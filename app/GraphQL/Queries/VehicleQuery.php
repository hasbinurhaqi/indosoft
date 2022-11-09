<?php

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Services\VehicleService;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VehicleQuery extends Query
{
    private $vehicleServices;

    public function __construct(VehicleService $vehicleServices)
    {
        $this->vehicleServices = $vehicleServices;
    }

    protected $attributes = [
        'name' => 'Vehicle',
        'description' => 'Query to Vehicle data and relations data (motor, mobil).',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Vehicle'));
    }

    public function args(): array
    {
        return [
            '_id' => ['name' => '_id', 'type' => Type::string()],
            'tahun' => ['name' => 'tahun', 'type' => Type::int()],
            'sold' => ['name' => 'sold', 'type' => Type::boolean()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $resolveInfo->getFieldSelection($depth = 3);

        return $this->vehicleServices->find($args, $fields);
    }
}