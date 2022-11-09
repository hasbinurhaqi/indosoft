<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\Models\Motor;
use Rebing\GraphQL\Support\InputType;

class MotorInput extends InputType
{
    protected $attributes =
        [
            'name' => 'MotorInput',
            'description' => 'Motor of vehicles',
        ];

    public function fields(): array
    {
        return (new Motor())->fields();
    }

}
