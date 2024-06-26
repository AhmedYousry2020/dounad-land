<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::Create([

            "name"=>"Super Admin",
            "email"=>"Super_Admin2022@app.com",
            "password"=>Hash::make("123456"),

        ]);
    }
}
