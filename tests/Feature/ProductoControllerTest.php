<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

use App\Models\Producto;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('index', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    Sanctum::actingAs(User::factory()->create()->assignRole('Usuario'));

    Producto::factory(3)->create();

    $response = $this->getJson('/api/productos');

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'nombre',
                    'descripcion',
                    'categoria',
                    'precio'
                ]
            ]
        ]);
});

test('show', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    Sanctum::actingAs(User::factory()->create()->assignRole('Usuario'));

    $producto = Producto::factory()->create();

    $response = $this->getJson("/api/productos/{$producto->id}");

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'id',
                'nombre',
                'descripcion',
                'categoria',
                'precio'
            ]
        ]);
});

test('store', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    $usuario = Sanctum::actingAs(User::factory()->create()->assignRole('Administrador'));
    
    $data = [
        'nombre' => $this->faker->word,
        'descripcion' => $this->faker->sentence,
        'categoria' => $this->faker->word,
        'precio' => $this->faker->numberBetween(1000, 10000)
    ];

    $response = $this->postJson('/api/productos', $data);

    $response->assertStatus(Response::HTTP_CREATED);

    $this->assertDatabaseHas('productos', [
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'categoria' => $data['categoria'],
        'precio' => $data['precio']
    ]);
});

test('update', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    $usuario = Sanctum::actingAs(User::factory()->create()->assignRole('Administrador'));

    $producto = Producto::factory()->create();

    $data = [
        'nombre' => 'Producto Actualizado',
        'descripcion' => 'Descripción actualizada',
        'categoria' => 'Categoría actualizada',
        'precio' => 19999
    ];

    $response = $this->putJson("/api/productos/{$producto->id}", $data);

    $response->assertStatus(Response::HTTP_ACCEPTED);

    $this->assertDatabaseHas('productos', [
        'id' => $producto->id,
        'nombre' => 'Producto Actualizado',
        'descripcion' => 'Descripción actualizada',
        'categoria' => 'Categoría actualizada',
        'precio' => 19999
    ]);
});

test('destroy', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    Sanctum::actingAs(User::factory()->create()->assignRole('Administrador'));

    $producto = Producto::factory()->create();

    $response = $this->deleteJson("/api/productos/{$producto->id}");

    $response->assertStatus(Response::HTTP_NO_CONTENT);

    $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
});

test('unauthorized_store', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);
    
    // Cambiado a rol Usuario que no tiene el permiso 'Crear productos'
    $usuario = User::factory()->create();
    $usuario->assignRole('Usuario');
    Sanctum::actingAs($usuario);

    $data = [
        'nombre' => $this->faker->word,
        'descripcion' => $this->faker->sentence,
        'categoria' => $this->faker->word,
        'precio' => $this->faker->numberBetween(1000, 10000)
    ];
    
    $response = $this->postJson('/api/productos', $data);
    $response->assertStatus(Response::HTTP_FORBIDDEN);
});

test('unauthorized_destroy', function () {
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);
    
    // Asegurarnos de que el usuario no tiene el permiso 'Eliminar productos'
    $usuario = User::factory()->create();
    $usuario->assignRole('Editor');
    Sanctum::actingAs($usuario);

    $producto = Producto::factory()->create();
    
    $response = $this->deleteJson("/api/productos/{$producto->id}");
    $response->assertStatus(Response::HTTP_FORBIDDEN);
});