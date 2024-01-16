<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_user = new User();
        $new_user->name = 'Ugo';
        $new_user->surname = 'De Ughi';
        $new_user->date_of_birth = '2015-01-01';
        $new_user->email = 'ugo.deughi@gmail.com';
        $new_user->password = '12345';
        $new_user->save();
    }
}
