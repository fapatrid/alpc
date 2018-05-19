<?php

use App\Role;

use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('assigned_roles')->truncate();

        $user = User::create([
        	'name' =>'Fernando',
        	'email' =>'info@gerhost.net',
        	'password' =>'sa'
        ]);

        $role = Role::create([
        	'name' =>'admin',
        	'display_name' =>'Administrador',
        	'description' =>'Administrador del sitio web'
        ]);

        $user->roles()->save($role);
    }
}
