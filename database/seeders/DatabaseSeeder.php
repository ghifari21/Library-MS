<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Ghifari Octaverin',
            'email' => 'ghifariocta@upi.edu',
            'username' => 'ghifari21',
            'password' => Hash::make('password'),
            'account_type' => 'admin'
        ]);

        Category::create([
            'category_code' => 'C001',
            'name' => 'Programming'
        ]);
        Category::create([
            'category_code' => 'C002',
            'name' => 'Fiction'
        ]);
        Category::create([
            'category_code' => 'C003',
            'name' => 'Science'
        ]);
    }
}
