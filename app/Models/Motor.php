<?php

namespace App\Models;

use App\Traits\Uuids;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Jenssegers\Mongodb\Casts\ObjectIDCast;

class Motor extends Eloquent
{
    use Uuids;

    protected $collection = 'vehicles.motor';
    
    protected $fillable = ['mesin', 'suspensi', 'transmisi', 'sold'];

    public $incrementing = false;
    public $timestamps = false;

    public function fields(): array
    {
        return [
            'mesin' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'This description'
            ],
            'suspensi' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'This description'
            ],
            'transmisi' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'This description'
            ],
            'sold' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The description'
            ],
        ];
    }
}