<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlatformAccount;

class PlatformAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platform_accounts = [
            [
                'platform_id'=>1,
                'name'=>'Shopee 1',
            ],
            [
                'platform_id'=>1,
                'name'=>'Shopee 2',
            ],
            [
                'platform_id'=>2,
                'name'=>'Tiktok 1',
            ],
        ];

        foreach($platform_accounts as $platform_account){

            PlatformAccount::updateOrcreate(
                [
                    'platform_id'=>$platform_account['platform_id'],
                    'name'=>$platform_account['name'],
                ]
            );
        }
    }
}
