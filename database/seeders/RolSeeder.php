<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Administrado =>CRUD 
        
        //Editor => CRU
       
        //Usuario => R
        $administrador = Role::create(['name' => 'Administrador']);
        $editor = Role::create(['name' => 'Editor']);
        $usuario = Role::create(['name' => 'Usuario']);
        
        permission::create(['name' => 'Crear productos'])->syncRoles([$administrador, $editor]);
        permission::create(['name' => 'Editar productos'])->syncRoles([$administrador, $editor]);
        permission::create(['name' => 'Eliminar productos'])->syncRoles([$administrador,]);
        permission::create(['name' => 'Ver productos'])->syncRoles([$administrador, $editor, $usuario]);
    }
}
