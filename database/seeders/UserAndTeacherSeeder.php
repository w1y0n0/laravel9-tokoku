<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAndTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User 1',
            'email' => 'user1@email.com',
            'password' => bcrypt('123'), 
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@email.com',
            'password' => bcrypt('123'), 
        ]);

        User::create([
            'name' => 'User 3',
            'email' => 'user3@email.com',
            'password' => bcrypt('123'), 
        ]);

        Teacher::create([
            'name' => 'Teacher 1',
            'email' => 'teacher1@email.com',
            'password' => bcrypt('123'),
        ]);
    }
}
