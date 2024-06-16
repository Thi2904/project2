<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->insert([
            'studentName' => 'John Doe',
            'gender' => 'male',
            'email' => 'john.doe1@example.com',
            'phoneNumber' => '123-456-7890',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Jane Smith',
            'gender' => 'female',
            'email' => 'jane.smith1@example.com',
            'phoneNumber' => '123-456-7891',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Alice Johnson',
            'gender' => 'female',
            'email' => 'alice.johnson1@example.com',
            'phoneNumber' => '123-456-7892',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Bob Brown',
            'gender' => 'male',
            'email' => 'bob.brown1@example.com',
            'phoneNumber' => '123-456-7893',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Charlie Davis',
            'gender' => 'male',
            'email' => 'charlie.davis1@example.com',
            'phoneNumber' => '123-456-7894',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Emily Evans',
            'gender' => 'female',
            'email' => 'emily.evans1@example.com',
            'phoneNumber' => '123-456-7895',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Frank Green',
            'gender' => 'male',
            'email' => 'frank.green1@example.com',
            'phoneNumber' => '123-456-7896',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Grace Harris',
            'gender' => 'female',
            'email' => 'grace.harris1@example.com',
            'phoneNumber' => '123-456-7897',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Henry Jackson',
            'gender' => 'male',
            'email' => 'henry.jackson1@example.com',
            'phoneNumber' => '123-456-7898',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Ivy Kelly',
            'gender' => 'female',
            'email' => 'ivy.kelly1@example.com',
            'phoneNumber' => '123-456-7899',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Jack Lee',
            'gender' => 'male',
            'email' => 'jack.lee1@example.com',
            'phoneNumber' => '123-456-7800',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Kathy Miller',
            'gender' => 'female',
            'email' => 'kathy.miller1@example.com',
            'phoneNumber' => '123-456-7801',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Liam Nelson',
            'gender' => 'male',
            'email' => 'liam.nelson1@example.com',
            'phoneNumber' => '123-456-7802',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Mia Owens',
            'gender' => 'female',
            'email' => 'mia.owens1@example.com',
            'phoneNumber' => '123-456-7803',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Nathan Perry',
            'gender' => 'male',
            'email' => 'nathan.perry1@example.com',
            'phoneNumber' => '123-456-7804',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Olivia Quinn',
            'gender' => 'female',
            'email' => 'olivia.quinn1@example.com',
            'phoneNumber' => '123-456-7805',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Paul Roberts',
            'gender' => 'male',
            'email' => 'paul.roberts1@example.com',
            'phoneNumber' => '123-456-7806',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Quincy Scott',
            'gender' => 'male',
            'email' => 'quincy.scott1@example.com',
            'phoneNumber' => '123-456-7807',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Rachel Taylor',
            'gender' => 'female',
            'email' => 'rachel.taylor1@example.com',
            'phoneNumber' => '123-456-7808',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Steve Upton',
            'gender' => 'male',
            'email' => 'steve.upton1@example.com',
            'phoneNumber' => '123-456-7809',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Tina Vance',
            'gender' => 'female',
            'email' => 'tina.vance1@example.com',
            'phoneNumber' => '123-456-7810',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Ursula White',
            'gender' => 'female',
            'email' => 'ursula.white1@example.com',
            'phoneNumber' => '123-456-7811',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Victor Xander',
            'gender' => 'male',
            'email' => 'victor.xander1@example.com',
            'phoneNumber' => '123-456-7812',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Wendy Young',
            'gender' => 'female',
            'email' => 'wendy.young1@example.com',
            'phoneNumber' => '123-456-7813',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Xander Zane',
            'gender' => 'male',
            'email' => 'xander.zane1@example.com',
            'phoneNumber' => '123-456-7814',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Yara Adams',
            'gender' => 'female',
            'email' => 'yara.adams1@example.com',
            'phoneNumber' => '123-456-7815',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Zack Bennett',
            'gender' => 'male',
            'email' => 'zack.bennett1@example.com',
            'phoneNumber' => '123-456-7816',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Amy Carter',
            'gender' => 'female',
            'email' => 'amy.carter1@example.com',
            'phoneNumber' => '123-456-7817',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Brian Davis',
            'gender' => 'male',
            'email' => 'brian.davis1@example.com',
            'phoneNumber' => '123-456-7818',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'studentName' => 'Cindy Edwards',
            'gender' => 'female',
            'email' => 'cindy.edwards1@example.com',
            'phoneNumber' => '123-456-7819',
            'classID' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
