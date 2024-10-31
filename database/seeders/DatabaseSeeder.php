<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Empleado; // Ya lo tienes importado
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Creación de usuarios existente
        User::factory(19)->create();
        User::factory()->create([
            'name' => 'Klebert Gabriel Hernandez Tello',
            'email' => 'klebert@admin.com',
        ]);

        // Agregar la creación de empleados aquí
        Empleado::factory(20)->create(); // Crea 20 empleados, puedes ajustar el número

        // El resto de tu código existente
        Cliente::factory(10)->create();
        Producto::factory(80)->create();
        Inventario::factory(80)->create();
        Venta::factory(100)->create(); 

        // Obtener la colección de empleados si la necesitas para relaciones
        $empleados = Empleado::all();
        
        // El resto de tus colecciones y relaciones...
        $user = User::all();
        $clientes = Cliente::all();
        $inventarios = Inventario::all();
        $productos = Producto::all();
        $ventas = Venta::all();

        // Tus relaciones existentes...
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