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
        $role= new Role();
		$role->nombre_rol="Administrador";
		$role->save();

		$role= new Role();
		$role->nombre_rol="Administrativo";
		$role->save();

		$role= new Role();
		$role->nombre_rol="Profesor";
		$role->save();
    }
}
