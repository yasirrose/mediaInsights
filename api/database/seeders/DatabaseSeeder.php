<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
         // Call the RoleSeeder
         $this->call(RoleSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Password1'),
            'role_id' => '1',
            'is_subscribed' => '1',
            'stripe_id' => '_stripeid',
        ]);
    }
}
