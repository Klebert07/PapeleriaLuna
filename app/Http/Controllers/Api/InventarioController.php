<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use App\Http\Resources\InventarioResource;
use App\Http\Resources\InventarioCollection;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Controllers\Api\UpdateInventarioRequest;
use Symfony\Component\HttpFoundation\Response;


class InventarioController extends Controller
{
    public function index(){
        return new InventarioCollection(Producto::all());
    }

    public function store(StoreInventarioRequest $request){
        $inventario = Inventario::create($request->all());
        $inventario ->productos()->attach(json_decode($request->inventario));
        return response()->json(new InventarioResource($inventario),Response::HTTP_CREATED);
    }

    public function show(Inventario $inventario){
        $inventario = $inventario->load('inventario');
        return new InventarioResource($inventario);
    }

    public function update(UpdateInventarioRequest $request, Inventario $inventario){
        $inventario->update($request->all());
        
        return response()->json(new InventarioResource($inventario),Response::HTTP_ACCEPTED);

       
    }

    public function destroy(Inventario $inventario){
        $inventario -> delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
