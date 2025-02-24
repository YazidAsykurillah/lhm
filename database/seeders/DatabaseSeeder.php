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
        // User::factory(10)->create();

        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateSuperAdminSeeder::class);
        $this->call(CreateHostUserSeeder::class);
        $this->call(CreatePlatformSeeder::class);
        $this->call(PlatformAccountSeeder::class);
        
    }
}
