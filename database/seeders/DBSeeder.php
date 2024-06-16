<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DBSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classroom')->insert([
        "classroomName" => 'Lab1',
        "infrastructure"=> '201',
        "floor" => '2'
    ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab1',
            "infrastructure"=> '202',
            "floor" => '2'
        ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab1',
            "infrastructure"=> '203',
            "floor" => '2'
        ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab2',
            "infrastructure"=> '204',
            "floor" => '2'
        ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab3',
            "infrastructure"=> '205',
            "floor" => '2'
        ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab3',
            "infrastructure"=> '206',
            "floor" => '2'
        ]);
        DB::table('classroom')->insert([
            "classroomName" => 'Lab3',
            "infrastructure"=> '207',
            "floor" => '2'
        ]);
    }

}
