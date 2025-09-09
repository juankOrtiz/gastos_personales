<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opcional: Reinicia los permisos en la cache
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1) Definir (Crear) los permisos
        $permisoVerListadoTransacciones = Permission::create(['name' => 'ver-listado-transacciones']);
        $permisoVerTransaccion = Permission::create(['name' => 'ver-transaccion']);
        $permisoCrearTransaccion = Permission::create(['name' => 'crear-transaccion']);
        $permisoEditarTransaccion = Permission::create(['name' => 'editar-transaccion']);
        $permisoEliminarTransaccion = Permission::create(['name' => 'eliminar-transaccion']);

        $permisoVerListadoUsuarios = Permission::create(['name' => 'ver-listado-usuarios']);
        $permisoVerUsuario = Permission::create(['name' => 'ver-usuario']);
        $permisoCrearUsuario = Permission::create(['name' => 'crear-usuario']);
        $permisoEditarUsuario = Permission::create(['name' => 'editar-usuario']);
        $permisoEliminarUsuario = Permission::create(['name' => 'eliminar-usuario']);

        // 2) Definir los roles
        $rolAdmin = Role::create(['name' => 'admin']);
        $rolNormal = Role::create(['name' => 'normal']);

        // 3) Asignar permisos a los roles
        $rolAdmin->givePermissionTo([
            $permisoVerListadoTransacciones,
            $permisoVerTransaccion,
            $permisoCrearTransaccion,
            $permisoEditarTransaccion,
            $permisoEliminarTransaccion,
            $permisoVerListadoUsuarios,
            $permisoVerUsuario,
            $permisoCrearUsuario,
            $permisoEditarUsuario,
            $permisoEliminarUsuario,
        ]);
        $rolNormal->givePermissionTo([
            $permisoVerListadoTransacciones,
            $permisoVerTransaccion,
            $permisoCrearTransaccion,
            $permisoEditarTransaccion,
            $permisoEliminarTransaccion,
        ]);

        // 4) Crear usuarios de prueba y asignarle roles
        $usuarioAdmin = User::create([
            'name' => 'Usuario admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
        $usuarioNormal = User::create([
            'name' => 'Usuario normal',
            'email' => 'normal@mail.com',
            'password' => bcrypt('password'),
        ]);
        $usuarioAdmin->assignRole('admin');
        $usuarioNormal->assignRole('normal');
    }
}
