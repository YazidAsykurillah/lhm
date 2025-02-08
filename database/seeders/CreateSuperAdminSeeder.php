<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrcreate(
            [
                'name' => 'THE ROOT', 
                'email' => 'root@email.com',
                'username'=>'000',
            ],
            [
                'password' => bcrypt('lhm!superadmin#88'),
                'phone_number'=>'08888'
            ],
        );
            
        $role = Role::updateOrCreate(
            ['name'=>'Super Admin']
        );
        
        $user->assignRole([$role->id]);
    }
}
