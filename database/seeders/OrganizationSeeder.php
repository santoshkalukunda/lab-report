<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => 'ABC Lab Pvt. Ltd.',
            'phone' => "098788633",
            'address' => 'Butwal , nepal',
            'email' => 'admin@argon.com',
            'url' => 'lab.kalukunda.com.np',
            'logo' => 'argon/img/brand/lab.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
