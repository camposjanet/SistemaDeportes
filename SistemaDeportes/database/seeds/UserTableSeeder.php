<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_administrador= Role::where('nombre_rol','Administrador')->first();
		$role_operario= Role::where('nombre_rol','Operario')->first();
		$role_profesor= Role::where('nombre_rol','Profesor')->first();

		$user= new User();
		$user->name="userAdministrador";
		$user->email="administrador@email.com";
		$user->password= bcrypt('12345678');
		$user->id_estado=1;
		$user->save();
		$user->roles()->attach($role_administrador);

		$user= new User();
		$user->name="userOperario";
		$user->email="operario@email.com";
		$user->password= bcrypt('12345678');
		$user->id_estado=1;
		$user->save();
		$user->roles()->attach($role_operario);

		$user= new User();
		$user->name="userProfesor";
		$user->email="profesor@email.com";
		$user->password= bcrypt('12345678');
		$user->id_estado=1;
		$user->save();
		$user->roles()->attach($role_profesor);

    }
}
