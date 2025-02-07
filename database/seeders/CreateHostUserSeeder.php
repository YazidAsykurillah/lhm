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
                'name' => 'Nina Ninu', 
                'email' => 'ninaninu@email.com',
                'username'=>'002',
            ],
            [
                'password' => bcrypt('lhm!host#88'),
                'phone_number'=>'01111'
            ],
        );
            
        $role = Role::updateOrCreate(
            ['name'=>'Live Host']
        );

        $role->syncPermissions(
            ['access-my-profile']
        );
         
        $user->assignRole([$role->id]);
    }
}
