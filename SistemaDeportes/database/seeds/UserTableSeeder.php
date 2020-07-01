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
		$role_administrativo= Role::where('nombre_rol','Administrativo')->first();
		$role_profesor= Role::where('nombre_rol','Profesor')->first();

		$user= new User();
		$user->name="nico rojas";
		$user->email="nicorojas@email.com";
		$user->password= bcrypt('12345678');
		$user->role_id=3; // ESTA LINEA VA SOLO SI EL CAMPO ROLE_ID ES NOT NULL
		$user->save();
		$user->roles()->attach($role_profesor);

    }
}
