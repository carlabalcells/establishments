<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Juan',
            'email' => 'juan@juan.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Carla',
            'email' => 'carla@carla.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Pepa',
            'email' => 'pepa@pepa.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
        ]);
    }
}
