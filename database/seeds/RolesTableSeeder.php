<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['instructor', 'student'];

        foreach($roles as $r){
            $role = new Role;
            $role->name = $r;
            $role->save();
        }
    }
}
