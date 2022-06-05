<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
            'first_name' => 'Luis',
            'last_name' => 'Vazquez',
            'email' => 'luis.vazquez@irondev.com.mx',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
