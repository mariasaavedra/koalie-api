<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
  {
    $role_admin = new Role();
    $role_admin->name = 'admin';
    $role_admin->description = 'An admin of an event';
    $role_admin->save();

    $role_member = new Role();
    $role_member->name = 'member';
    $role_member->description = 'A member of an event';
    $role_member->save();
  }
}
