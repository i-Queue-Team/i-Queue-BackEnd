<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CurrentqueuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('current_queues')->insert([
            'fixed_capacity' => '40',
            'average_time' => '5',
            'password_verification' => '12345',
            'commerce_id' => '1',
        ]);
    }
}
