<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Empleado; 
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolSeeder::class);

        // Luego crear usuarios
        User::factory()->create([
            'name' => 'Klebert Gabriel Hernandez Tello',
            'email' => 'klebert@admin.com',
        ])->assignRole('Administrador'); // Asignar rol de administrador al primer usuario

        User::factory()->create([
            'name' => 'Arath Galvan Escobedo',
            'email' => 'Arath@gmail.com',
        ])->assignRole('Editor');

        User::factory(28)->create()->each(function ($user){
            $user->assignRole('Usuario');
        });

        Empleado::factory(20)->create();
        Cliente::factory(10)->create();
        Producto::factory(80)->create();
        Inventario::factory(80)->create();
        Venta::factory(100)->create(); 

        $empleados = Empleado::all();
        $user = User::all();
        $clientes = Cliente::all();
        $inventarios = Inventario::all();
        $productos = Producto::all();
        $ventas = Venta::all();

        foreach ($clientes as $cliente) {
            $cliente->ventas()->saveMany(Venta::factory()->count(rand(2, 5))->make());
        }

        foreach($ventas as $venta){
            $venta->productos()->attach($productos->random(rand(2,4)));
        }

        foreach ($inventarios as $inventario) {
            $cantidadProductos = min(rand(1, 5), $productos->count());
            $inventario->productos()->saveMany($productos->random($cantidadProductos));
        }
    }
}