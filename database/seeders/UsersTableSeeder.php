<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-10-11 16:07:37',
                'verification_token' => '',
                'last_name'          => '',
                'full_name_en'       => '',
                'full_name_ar'       => '',
                'national'           => '',
                'phone'              => '',
                'birth_country'      => '',
                'country'            => '',
                'state'              => '',
                'linkedin'           => '',
                'personal_statement' => '',
            ],
        ];

        User::insert($users);
    }
}
