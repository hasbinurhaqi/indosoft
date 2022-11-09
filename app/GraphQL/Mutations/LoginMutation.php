<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Services\AuthenticationService;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LoginMutation extends Mutation
{

    private $authService;

    protected $attributes = [
        'name' => 'LoginMutation',
    ];

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function type(): Type
    {
        return GraphQL::type('UserProfile');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email', 
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'password' => [
                'name' => 'password', 
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return $this->authService->authentication($args);
    }
}
