<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TweetsSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\Money_managementSeeder;
use Database\Seeders\Target_amountSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TweetsSeeder::class,
            UsersSeeder::class,
            Money_managementSeeder::class,
            Target_amountSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
