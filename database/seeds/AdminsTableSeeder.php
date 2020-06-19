<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $adminRecords = [
            ['id' => 1, 'name' => 'gattsu', 'type' => 'admin', 'mobile' => '0641234567', 'email' => 'gattsu@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1],
            ['id' => 2, 'name' => 'user2', 'type' => 'subadmin', 'mobile' => '0641234567', 'email' => 'user2@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1],
            ['id' => 3, 'name' => 'user3', 'type' => 'subadmin', 'mobile' => '0641234567', 'email' => 'user3@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1],
            ['id' => 4, 'name' => 'user4', 'type' => 'admin', 'mobile' => '0641234567', 'email' => 'user4@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
