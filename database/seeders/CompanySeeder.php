<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'company_name' => "Diamond Paints Unit # 6 Branch",
            'address' => \Str::random(80),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
