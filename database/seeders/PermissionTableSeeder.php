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
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'access-admin-dashboard',
           'manage-user',
           'access-my-profile',
           'manage-umrah-batch',
           'access-saving-transaction',
           'access-saving-transaction',
           'access-all-saving-transaction'
        ];
        
        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
