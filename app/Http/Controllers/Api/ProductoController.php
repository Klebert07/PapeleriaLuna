<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductoCollection;
use App\HTTP\Requests\StoreProductoRequest;
use App\HTTP\Requests\UpdateProductoRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('Ver productos'); 
        return new ProductoCollection(Producto::all());
    }

    public function store(StoreProductoRequest $request){
        $this->authorize('Crear productos');
        $producto = Producto::create($request->all());  
        if($request->has('productos')) {
            $producto->inventario()->attach(json_decode($request->productos));
        }
        return response()->json(new ProductoResource($producto), Response::HTTP_CREATED);
    }
    public function show(Producto $producto)
    {
        $this->authorize('Ver productos');
        $producto = $producto->load('inventario');
        return new ProductoResource($producto);
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('Editar productos');
        $producto->update($request->all());
        return response()->json(new ProductoResource($producto), Response::HTTP_ACCEPTED);
    }

    public function destroy(Producto $producto)
    {
        $this->authorize('Eliminar productos');
        $producto->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}