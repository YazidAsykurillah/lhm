<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'manage-role',
           'manage-user',
           'access-admin-dashboard',
           'access-my-profile',
        ];
        
        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
