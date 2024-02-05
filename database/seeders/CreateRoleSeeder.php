<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super Admin', 'Admin', 'Designer'];
        foreach ($roles as $value) {
            $role = new Role();
            $role->name = $value;
            $role->guard_name = 'web';
            $role->save();
        }
    }
}
