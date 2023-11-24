<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name'=>"artisan", 'description'=>"Artisan description" ],
            ['name'=>"php", 'description'=>"php description" ],
            ['name'=>"laravel", 'description'=>"Laravel description" ],
        ];

        foreach ($brands as $brand) {
            \DB::table('brands')
            ->insert(
                [
                    'name' => $brand['name'],
                    'description'=> $brand['description'],
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]
                );
        }
    }
}
