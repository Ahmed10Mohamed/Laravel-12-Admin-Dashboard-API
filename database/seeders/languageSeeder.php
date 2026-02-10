<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class languageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'name' => 'English',
                'locale' => 'en',
            ],
            [
                'name' => 'عربى',
                'locale' => 'ar',
            ],
        ]);
    }
}
