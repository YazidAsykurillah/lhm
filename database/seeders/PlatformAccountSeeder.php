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
                'name'=>'Account 1',
            ],
            [
                'platform_id'=>1,
                'name'=>'Account 2',
            ],
            [
                'platform_id'=>2,
                'name'=>'Account 3',
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
