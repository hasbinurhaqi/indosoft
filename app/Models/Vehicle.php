<?php

namespace App\Models;

use App\Traits\Uuids;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent
{
    use Uuids;

    protected $connection = 'mongodb';
    protected $collection = 'vehicles';

    protected $fillable = ['id', 'tahun', 'warna', 'harga', 'motor', 'mobil'];

    public $timestamps = false;
    public $incrementing = false;

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The identifier of the vechile',
            ],
            'tahun' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The tahun of vechile',
            ],
            'warna' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The warna of vechile',
            ],
            'harga' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'The harga of vehicle',
            ],
            'motor' => [
                'name' => 'motor',
                'description' => 'The motor type of vechile',
                'type' => Type::listOf(GraphQL::type('Motor')),
                'is_relation' => false
            ],
            'mobil' => [
                'name' => 'mobil',
                'description' => 'The mobil type of vechile',
                'type' => Type::listOf(GraphQL::type('Mobil')),
                'is_relation' => false
            ]
        ];
    }

}