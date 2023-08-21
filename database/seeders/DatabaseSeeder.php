<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        $user = User::factory()->create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'username' => 'mattelcashier',
            'password' => bcrypt('cashier1234')
        ]);

        $user->assignRole('cashier');

        $user2 = User::factory()->create([
            'name' => 'Store Manager',
            'email' => 'manager@example.com',
            'username' => 'mattelmanager',
            'password' => bcrypt('manager1234')
        ]);

        $user2->assignRole('manager');

        // $this->call(RoleSeeder::class);
    }
}
