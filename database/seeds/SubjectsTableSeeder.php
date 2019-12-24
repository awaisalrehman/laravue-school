<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => 'URDU',
        ]);

        DB::table('subjects')->insert([
            'name' => 'ENGLISH',
        ]);

        DB::table('subjects')->insert([
            'name' => 'ISLAMIYAT',
        ]);

        DB::table('subjects')->insert([
            'name' => 'PAK STUDIES',
        ]);

        DB::table('subjects')->insert([
            'name' => 'PHYSICS',
        ]);

        DB::table('subjects')->insert([
            'name' => 'CHEMISTRY',
        ]);

        DB::table('subjects')->insert([
            'name' => 'BIOLOGY',
        ]);
    }
}
