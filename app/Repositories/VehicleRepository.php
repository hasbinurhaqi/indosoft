<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Builder;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function update(array $args) : Vehicle
    {
        $restaurant = Vehicle::where('id', $args['id']);

        if ($restaurant->exists()) {
            $restaurant->update($args, ['upsert' => true]);

            return $restaurant->first();
        }
    }

    public function create(array $args) : Vehicle
    {
        return Vehicle::create($args);
    }

    public function find(array $args, array $selects) : Collection
    {
        $query = $this->makeSelect(Vehicle::query(), $selects);
        $query = $this->makeWhere($query, $args);

        return $query->get();
    }

    private function makeSelect(Builder $query, array $selects) : Builder
    {
        $selectUsed = [];

        foreach ($selects as $select => $value) {
            if (is_array($value)) {
                array_push($selectUsed, $select);

                foreach ($value as $fieldDepthKey => $fieldDepthValue) {
                    $query->addSelect("$select.$fieldDepthKey");
                }
            }

            !in_array($select, $selectUsed) ? $query->addSelect($select) : null;
        }

        return $query;
    }

    private function makeWhere(Builder $query, array $args) : Builder
    {
        if (!empty($args)) {

            if (array_key_exists("_id",$args)) {
                $id = $args['_id'];
                $query->where('id', $id);
            }

            if (array_key_exists("tahun",$args)) {
                $tahun = $args['tahun'];
                $query->where('tahun', $tahun);
            }

            if (array_key_exists("sold",$args)) {
                $filter = [
                    'motor' => [
                        '$elemMatch' => ['sold' => $args['sold']]
                    ],
                    'mobil' => [
                        '$elemMatch' => ['sold' => $args['sold']]
                    ],
                ];
                $query->project($filter);
            }

            if (array_key_exists("lng",$args) && array_key_exists("lat",$args)) {
                $query->where('address', 'nearSphere', [
                    '$geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            (float) $args['lng'],
                            (float) $args['lat']
                        ],
                    ],
                    '$maxDistance' => 10000000,
                ]);
            }
        }

        return $query;
    }

    public function sold(array $args) : Vehicle 
    {
        $vehicle = Vehicle::where('id', $args['vehicle_id']);
        if ($vehicle->exists()) {
            Vehicle::where('id', $args['vehicle_id'])->update(array('motor.'.$args['index'].'.sold' => $args['sold']));
            return $vehicle->first();
        }
    }

}