<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'fullName' => 'manger',
                'userName' => 'manger',
                'phone' => '01149671770',
                'email' => 'info@test.com',
                'password' => bcrypt('Admin123123'),
                'email_verified_at'=> now(),
                'isActive' => true,
            ]

            ]);
    }
}
