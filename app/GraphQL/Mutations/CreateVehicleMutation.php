<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use App\Services\VehicleService;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Validation\Rule;


class CreateVehicleMutation extends Mutation
{
    private $vehicleService;

    protected $attributes = [
        'name' => 'CreateVehicle'
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
            'tahun' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The tahun of vehicles',
            ],
            'warna' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The warna of vehicles'
            ],
            'harga' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'The harga of vehicles'
            ],
            'motor' => [
                'name' => 'motor',
                'description' => 'The motor type of vehicles',
                'type' => Type::listOf(GraphQL::type('MotorInput'))
            ],
            'mobil' => [
                'name' => 'mobil',
                'description' => 'The mobil type of vehicles',
                'type' => Type::listOf(GraphQL::type('MobilInput'))
            ]
        ];
    }

    public function rules(array $args = []): array
    {   
        $tahun = $args['tahun'];
        $warna = $args['warna'];
        return [
            'tahun' => [
                'required',
                Rule::unique('vehicles')->where(function ($query) use($tahun, $warna) {
                    return $query->where('tahun', $tahun)
                    ->where('warna', $warna);
                })->ignore('id')
            ],
            'warna' => ['required'],
            'harga' => ['required'],
            'motor' => ['required'],
        ];
    }
    
    public function resolve($root, $args)
    {
        return $this->vehicleService->create($args); 
    }
}