<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'name' => 'Restaurant',
            'slug' => Str::slug('Restaurant'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Café',
            'slug' => Str::slug('Café'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Hoteles',
            'slug' => Str::slug('Hoteles'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Bar',
            'slug' => Str::slug('Bar'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Hospitales',
            'slug' => Str::slug('Hospitales'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Gimnasio',
            'slug' => Str::slug('Gimnasio'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'name' => 'Doctor',
            'slug' => Str::slug('Doctor'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
