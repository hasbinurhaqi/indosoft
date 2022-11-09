<?php

declare(strict_types=1);

namespace Tests\Feature\Base\GraphQL\Publics\Query;

use Tests\TestCase;

class LoginQueryTest extends TestCase
{

    protected $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    public function test()
    {
        $query = 'mutation {
            signIn(
              email: "hasbinurhaqy@gmail.com",
              password: "user123)"
            )
            {
              status,
              id,
              name,
              email,
              token
            }
        }';

        $expected = [
            'data' => [
                'signIn' => [
                    'status',
                    'id',
                    'name',
                    'email',
                    'token',
                ],
            ],
        ];

        $this->assertJsonStructure(
            '/graphql/auth',
            [
                'query' => $query
            ],
            $expected
        );
    }
}
