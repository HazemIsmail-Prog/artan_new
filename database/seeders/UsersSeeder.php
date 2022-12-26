<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            ['name' => 'Super Admin',   'username' => 'admin',          'active' => 1, 'type' => 'admin',       'password' => bcrypt('123')],
            ['name' => 'Hazem',         'username' => 'hazem',          'active' => 1, 'type' => 'user',        'password' => bcrypt('123')],
            ['name' => 'Norhan',        'username' => 'norhan',         'active' => 1, 'type' => 'accountant',  'password' => bcrypt('123')],
            ['name' => 'Abd Al Rahman', 'username' => 'abdulrahman',    'active' => 1, 'type' => 'user',        'password' => bcrypt('123')],
            ['name' => 'Asmaa',         'username' => 'asmaa',          'active' => 1, 'type' => 'user',        'password' => bcrypt('123')],
            ['name' => 'T1',            'username' => 't1',             'active' => 1, 'type' => 'tech',        'password' => bcrypt('123')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
