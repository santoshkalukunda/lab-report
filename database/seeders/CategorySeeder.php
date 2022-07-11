<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'name' => 'Blood Test',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Stool Test',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Urine Test',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Other Test',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]

        );
    }
}
