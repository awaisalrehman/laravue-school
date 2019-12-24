<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
        	'name' => 'Awais ur Rehman',
        	'father_name' => 'Muhammad Saleem',
          'roll_no' => 0001,
        	'dob' => date('Y-m-d'),
        	'gender' => '1',
        	'cnic' => '34504030322',
        	'identification_mark' => 'null',
        	'contact' => '0343324564',
        	'address' => 'Hafizabad.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Ali Raza',
        	'father_name' => 'Muhammad Khalid',
          'roll_no' => 0002,
        	'dob' => date('Y-m-d'),
        	'gender' => '1',
        	'cnic' => '3410194399478',
        	'identification_mark' => 'null',
        	'contact' => '03436343338',
        	'address' => 'Sialkot.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Asim',
        	'father_name' => 'Imran Ali',
          'roll_no' => 0003,
        	'dob' => date('Y-m-d'),
        	'gender' => '1',
        	'cnic' => '3410178485487',
        	'identification_mark' => 'null',
        	'contact' => '03436783540',
        	'address' => 'Islamabad.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Ayesha',
        	'father_name' => 'Muhammad Farhan',
          'roll_no' => 0004,
        	'dob' => date('Y-m-d'),
        	'gender' => '2',
        	'cnic' => '3410183384747',
        	'identification_mark' => 'null',
        	'contact' => '03436723343',
        	'address' => 'Karachi.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Komal',
        	'father_name' => 'Ashraf Khan',
          'roll_no' => 0005,
        	'dob' => date('Y-m-d'),
        	'gender' => '2',
        	'cnic' => '3410173388993',
        	'identification_mark' => 'null',
        	'contact' => '03423288322',
        	'address' => 'Multan.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Hassan',
        	'father_name' => 'Muhammad Saleem',
          'roll_no' => 0006,
        	'dob' => date('Y-m-d'),
        	'gender' => '1',
        	'cnic' => '3410128828882',
        	'identification_mark' => 'null',
        	'contact' => '03432883321',
        	'address' => 'Gujranwala.',
        ]);

        DB::table('students')->insert([
        	'name' => 'Mahnoor',
        	'father_name' => 'Jamil Khan',
          'roll_no' => 0007,
        	'dob' => date('Y-m-d'),
        	'gender' => '1',
        	'cnic' => '3410138733738',
        	'identification_mark' => 'null',
        	'contact' => '03413887343',
        	'address' => 'Faisalabad.',
        ]);
    }
}
