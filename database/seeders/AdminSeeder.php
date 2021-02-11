<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name' => \Str::random(15),
            'last_name' => \Str::random(18),
            'company_id' => 1,
            'username' => 'admin',
            'email' => \Str::random(10).'@gmail.com',
            'user_type' => 'admin',
            'user_permissions' => '{}',
            'password' => \Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
