<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('careers')->insert([
            'name' => "ING. SISTEMAS COMPUTACIONALES",
        ]);
        DB::table('careers')->insert([
            'name' => "ING. MECATRONICA",
        ]);
        DB::table('careers')->insert([
            'name' => "ING. ELECTROMECANICA",
        ]);
        DB::table('careers')->insert([
            'name' => "ING. QUIMICA",
        ]);

        DB::table('categories')->insert([
            'name' => "PROCESO",
        ]);
        DB::table('categories')->insert([
            'name' => "PROTOCOLO",
        ]);
        DB::table('categories')->insert([
            'name' => "PROTOTIPO",
        ]);

        DB::table('admins')->insert([
            'name' => "MARIO ALBERTO NONATO CARRILLO",
            'email' => "mnonatoc@toluca.tecnm.mx",
            'password' => Hash::make("Slayer74156@"),
            'role' => "3",
        ]);

        DB::table('events')->insert([
            'name' => "EXPO SISTEMAS",
            'time' => "12:00:00",
            'image' => "holamundo.png",
            'date' => "2022-05-10",
            'status' => "0",
            'fk_admin' => "1",
        ]);

        DB::table('gender')->insert([
            'name' => "MASCULINO",
        ]);
        DB::table('gender')->insert([
            'name' => "FEMENINO",
        ]);
    }
}
