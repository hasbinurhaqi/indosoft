<?php

namespace App\Models;

use App\Traits\Uuids;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class Mobil extends Eloquent
{
    use Uuids;
    
    protected $fillable = ['id', 'mesin', 'kapasitas_penumpang', 'tipe', 'sold'];

    public $incrementing = false;

    public function fields(): array
    {
        return [
            'mesin' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description',
            ],
            'kapasitas_penumpang' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description'
            ],
            'tipe' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description'
            ],
            'sold' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The description'
            ],
        ];
    }

}