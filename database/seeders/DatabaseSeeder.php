<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table("users")->insert([
            "name" => "Nguyễn Ngọc Tân",
            "email" => "teach@gmail.com",
            "address" => "a17",
            "phone" => "1951941056",
            "password" => Hash::make("123456789"),
            "role" => "teacher"
        ]);

        DB::table("users")->insert([
            "name" => "admin",
            "email" => "ad@gmail.com",
            "address" => "TQB",
            "phone" => "0709292929",
            "password" => Hash::make("145678923"),
            "role" => "admin"
        ]);

        DB::table("major")->insert([
            "majorName" => "Dev"
        ]);
        DB::table("major")->insert([
            "majorName" => "Des"
        ]);
        DB::table("major")->insert([
            "majorName" => "Marketing"
        ]);
        DB::table("major")->insert([
            "majorName" => "Security"
        ]);

        DB::table('_shifts')->insert([
            ['time_in' => '08:00:00', 'time_out' => '10:00:00', 'comments' => ''],
            ['time_in' => '10:00:00', 'time_out' => '12:00:00', 'comments' => ''],
            ['time_in' => '08:00:00', 'time_out' => '12:00:00', 'comments' => ''],
            ['time_in' => '13:30:00', 'time_out' => '15:30:00', 'comments' => ''],
            ['time_in' => '15:30:00', 'time_out' => '17:30:00', 'comments' => ''],
            ['time_in' => '13:30:00', 'time_out' => '17:30:00', 'comments' => ''],
        ]);

    }
}
