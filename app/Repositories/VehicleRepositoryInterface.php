<?php

namespace App\Repositories;

interface VehicleRepositoryInterface
{
    public function create(array $args);
    public function update(array $args);
    public function sold(array $args);
    public function find(array $args, array $selects);
}