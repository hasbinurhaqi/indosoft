<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonFile = file_get_contents(storage_path() . "/json/users.json");
        $users = json_decode($jsonFile, true);

        foreach ($users as $user) {
            DB::connection('mongodb')
                ->collection('users')
                ->insert([
                    'id' => \Str::uuid(4),
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                ]);
        }

        $this->command->info('UserCollectionSeeder run successfully!');
    }
}
