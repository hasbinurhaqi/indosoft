<?php

namespace App\GraphQL\Queries;

use Auth;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Services\VehicleService;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class VehicleStockQuery extends Query
{
    private $vehicleServices;

    public function __construct(VehicleService $vehicleServices)
    {
        $this->vehicleServices = $vehicleServices;
    }

    protected $attributes = [
        'name' => 'Vehicle',
        'description' => 'Query check stock Vehicle data (motor, mobil).',
        'middleware' => ['auth:sanctum']
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Vehicle'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $resolveInfo->getFieldSelection($depth = 3);

        return $this->vehicleServices->find($args, $fields);
    }
}