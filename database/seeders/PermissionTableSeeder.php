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
           'manage-platform',
           'manage-live-stream-activity',
           'view-all-live-stream-activity',
           'manage-platform-account',
           'manage-payment-note',
           'access-admin-dashboard',
           'access-my-profile',
           'access-my-live-stream-activity',
           'approve-live-stream-activity',
           
        ];
        
        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
