<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'cfobdorg',
            'email' => 'info@cfobd.org',
            'password' => Hash::make('cfodborg@SSGBD123')
        ]);
    }
}
