<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('students')->insert([
        	['name' => 'syy', 'age' => 18],
        	['name' => 'lili', 'age' => 19],
        ]);
    }
}
