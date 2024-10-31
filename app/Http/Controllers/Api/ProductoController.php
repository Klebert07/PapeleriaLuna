<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductoCollection;
use App\HTTP\Requests\StoreProductoRequest;
use App\HTTP\Requests\UpdateProductoRequest;
use Symfony\Component\HttpFoundation\Response;


class ProductoController extends Controller
{
    public function index(){
        return new ProductoCollection(Producto::all());
    }

    public function store(StoreProductoRequest $request){
        //$producto = Producto::create($request->all());
        $producto = $request->user()->productos()->create($request->all());

        $producto ->inventario()->attach(json_decode($request->productos));
        return response()->json(new ProductoResource($producto),Response::HTTP_CREATED);
    }

    public function show(Producto $producto){
        $producto = $producto->load('producto');
        return new ProductoResource($producto);
    }

    public function update(UpdateProductoRequest $request, Producto $producto){
        $producto->update($request->all());
        
        return response()->json(new ProductoResource($producto),Response::HTTP_ACCEPTED);

    }

    public function destroy(Producto $producto){
        $producto -> delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}



