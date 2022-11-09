<?php

declare(strict_types=1);

namespace Tests\Feature\Base\GraphQL\Publics\Query;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Tests\TestCase;

class VehiclesQueryTest extends TestCase
{

    protected $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    use WithoutMiddleware;
    
    public function test()
    {
        $query = 'query FindVehiclesByCol {
            Vehicles(_id: "4958afe0-5fdc-11ed-900f-a12677dc6e1a") {
              id,
              tahun,
              warna
            }
          }';

        $expected = [
            "data" => [
                "Vehicles" => [
                   [
                      "id", 
                      "tahun", 
                      "warna"
                   ] 
                ] 
            ] 
        ];

        $this->assertJsonStructure(
            '/graphql',
            [
                'query' => $query,
            ],
            $expected
        );
    }
}
