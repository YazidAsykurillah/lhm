<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateJamaahUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrcreate(
            [
                'name' => 'Ahmad Suparjo', 
                'email' => 'ahmadsuparjo@email.com',
                'username'=>'002',
            ],
            [
                'name' => 'Ahmad Suparjo', 
                'email' => 'ahmadsuparjo@email.com',
                'username'=>'002',
                'password' => bcrypt('123456'),
                'phone_number'=>'07878789'
            ],
        );
            
        $role = Role::updateOrCreate(
            ['name'=>'Member']
        );
         
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
