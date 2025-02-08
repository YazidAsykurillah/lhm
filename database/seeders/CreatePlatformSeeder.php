<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platform;

class CreatePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
           'Shopee',
           'Tik Tok',
           'Instagram',
           'Facebook',
        ];
        
        foreach ($platforms as $platform) {
             Platform::updateOrCreate(['name' => $platform]);
        }
    }
}
