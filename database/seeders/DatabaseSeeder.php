<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (! Role::count()) {
            Role::create(['name' => 'Admin']);
            Role::create(['name' => 'HR']);
            Role::create(['name' => 'Employee']);
        }

        if (! User::where('email', 'admin@gmail.com')->count()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ])->assignRole('Admin');
        }

        if (! User::where('email', 'hr@gmail.com')->count()) {
            User::create([
                'name' => 'HR',
                'email' => 'hr@gmail.com',
                'password' => bcrypt('password'),
            ])->assignRole('HR');
        }

        if (! User::where('email', 'employee@gmail.com')->count()) {
            User::create([
                'name' => 'Employee',
                'email' => 'employee@gmail.com',
                'password' => bcrypt('password'),
            ])->assignRole('Employee');
        }

        if (! Permission::count()) {
            $names = [
                'create employee',
                'change setting',
                'approve furlough',
                'propose furlough',
                'view employee',
            ];
            foreach ($names as $name) {
                Permission::create(['name' => $name]);
            }
        }

        $roles = [
            [
                'name' => 'Admin',
                'permissions' => [
                    'create employee',
                    'change setting',
                    'approve furlough',
                    'propose furlough',
                    'view employee',
                ],
            ],
            [
                'name' => 'HR',
                'permissions' => [
                    'create employee',
                    'change setting',
                    'approve furlough',
                    'view employee',
                ],
            ],
            [
                'name' => 'Employee',
                'permissions' => [
                    'propose furlough',
                ],
            ],
        ];
        foreach ($roles as $item) {
            $role = Role::where('name', $item['name'])->first();
            foreach ($item['permissions'] as $name) {
                $permission = Permission::where('name', $name)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
