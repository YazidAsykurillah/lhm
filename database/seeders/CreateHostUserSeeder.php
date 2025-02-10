<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateHostUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrcreate(
            [
                'name' => 'Live Streamer Test',
                'email' => 'streamertest@email.com',
                'username'=>'002',
            ],
            [
                'password' => bcrypt('lhm!streamer#88'),
                'phone_number'=>'01111',
                'rate_per_hour'=>10000
            ],
        );
            
        $role = Role::updateOrCreate(
            ['name'=>'Live Host']
        );

        $role->syncPermissions(
            [
                'access-my-profile',
                'access-my-live-stream-activity'
            ]
        );
         
        $user->assignRole([$role->id]);
    }
}
