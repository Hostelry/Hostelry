<?php

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Hostelry\Account\Entities\User::class)->create([
            'username' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'api_token' => \Illuminate\Support\Str::random(32),
        ]);
    }
}
