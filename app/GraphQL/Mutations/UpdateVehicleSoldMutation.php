<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use App\Services\VehicleService;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

use Illuminate\Validation\Rule;


class UpdateVehicleSoldMutation extends Mutation
{
    private $vehicleService;

    protected $attributes = [
        'name' => 'UpdateVehicleSold'
    ];
    /**
     * @var mixed|null
     */
    private $errorMessage;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function type(): Type
    {
        return GraphQL::type('Vehicle');
    }

    public function args(): array
    {
        return [
            'vehicle_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The vechile_id of vehicles',
            ],
            'vehicle_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The vechile_type of vehicles',
            ],
            'index' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The index of vechile_type vehicles'
            ],
            'sold' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The flag sold of vehicles'
            ],
        ];
    }

    public function rules(array $args = []): array
    {   
        return [
            'vehicle_id' => ['required'],
            'vehicle_type' => ['required'],
            'index' => ['required'],
            'sold' => ['required'],
        ];
    }
    
    public function resolve($root, $args)
    {
        return $this->vehicleService->sold($args); 
    }
}