<?php

namespace App\Services;

use App\Repositories\VehicleRepositoryInterface;

class VehicleService
{
    const SCHEMA_NAME = 'vehicle';
    private $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function create(array $args)
    {
        return $this->vehicleRepository->create($args);
    }

    public function find(array $args, array $selects)
    {
        return $this->vehicleRepository->find($args, $selects);
    }

    public function sold(array $args)
    {
        return $this->vehicleRepository->sold($args);
    }
}