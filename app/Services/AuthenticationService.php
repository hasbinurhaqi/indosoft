<?php

namespace App\Services;

use App\Repositories\AuthenticationRepositoryInterface;

class AuthenticationService
{
    const SCHEMA_NAME = 'users';
    private $authRepository;

    public function __construct(AuthenticationRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function authentication(array $args)
    {
        return $this->authRepository->authentication($args);
    }
}