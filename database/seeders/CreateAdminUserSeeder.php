<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrcreate(
            [
                'name' => 'Mang Admin', 
                'email' => 'admin@email.com',
                'username'=>'001',
            ],
            [
                'password' => bcrypt('lhm!admin#88'),
                'phone_number'=>'081291513745'
            ],
        );
            
        $role = Role::updateOrCreate(
            ['name'=>'Administrator']
        );
         
       
        $role->syncPermissions(
            ['manage-role', 'manage-user', 'access-admin-dashboard']
        );
         
        $user->assignRole([$role->id]);
    }
}
