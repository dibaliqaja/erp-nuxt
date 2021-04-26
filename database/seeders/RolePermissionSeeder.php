<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user_list      = Permission::firstOrCreate(['name' => 'user.list']);
        $user_create    = Permission::firstOrCreate(['name' => 'user.create']);
        $user_edit      = Permission::firstOrCreate(['name' => 'user.edit']);
        $user_delete    = Permission::firstOrCreate(['name' => 'user.delete']);
        $employee_list      = Permission::firstOrCreate(['name' => 'employee.list']);
        $employee_create    = Permission::firstOrCreate(['name' => 'employee.create']);
        $employee_edit      = Permission::firstOrCreate(['name' => 'employee.edit']);
        $employee_delete    = Permission::firstOrCreate(['name' => 'employee.delete']);
        $admin->syncPermissions([
            $user_list,
            $user_create,
            $user_edit,
            $user_delete,
            $employee_list,
            $employee_create,
            $employee_edit,
            $employee_delete
        ]);

        $user = User::where('email', 'admin@demo.com')->first();
        $user->assignRole($admin);
    }
}
