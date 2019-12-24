<?php

use Illuminate\Database\Seeder;

class GradeSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grade_settings')->insert([
            'percentage' => '80-100',
            'grade' => 'A+',
            'description' => 'Exceptional',
        ]);

        DB::table('grade_settings')->insert([
            'percentage' => '70-79',
            'grade' => 'A',
            'description' => 'Excellent',
        ]);

        DB::table('grade_settings')->insert([
            'percentage' => '60-69',
            'grade' => 'B',
            'description' => 'Very Good',
        ]);

        DB::table('grade_settings')->insert([
            'percentage' => '50-59',
            'grade' => 'C',
            'description' => 'Good',
        ]);

        DB::table('grade_settings')->insert([
            'percentage' => '33-49',
            'grade' => 'D',
            'description' => 'Satisfactory',
        ]);

        DB::table('grade_settings')->insert([
            'percentage' => '0-33',
            'grade' => 'F',
            'description' => 'Fail',
        ]);
    }
}
