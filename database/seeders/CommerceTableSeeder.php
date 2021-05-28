<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CommerceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commerces')->insert([
            'name' => 'Pizzeria Local',
            'latitude' => '37.649034',
            'longitude' => '37.649034',
            'user_id'=> '1'

        ]);
    }
}
