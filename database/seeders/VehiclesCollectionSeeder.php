<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class VehiclesCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonFile = file_get_contents(storage_path() . "/json/vehicles.json");
        $vehicles = json_decode($jsonFile, true);

        foreach ($vehicles as $vehicle) {
            DB::connection('mongodb')
                ->collection('vehicles')
                ->insert([
                    'id' => $vehicle['id'],
                    'tahun' => $vehicle['tahun'],
                    'harga' => $vehicle['harga'],
                    'warna' => $vehicle['warna'],
                    'mobil' => $vehicle['mobil'],
                    'motor' => $vehicle['motor'],
                ]);
        }

        $this->command->info('VehiclesCollectionSeeder run successfully!');
    }
}
