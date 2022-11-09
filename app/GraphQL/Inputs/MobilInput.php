<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use App\Models\Mobil;
use Rebing\GraphQL\Support\InputType;

class MobilInput extends InputType
{
    protected $attributes =
        [
            'name' => 'MobilInput',
            'description' => 'Mobil of sales',
            'model' => Mobil::class
        ];

    public function fields(): array
    {
        return (new Mobil())->fields();
    }

}
