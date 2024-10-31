<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use Illuminate\Http\Request;
use App\Http\Resources\VentaResource;
use App\Http\Resources\VentaCollection;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use Symfony\Component\HttpFoundation\Response;

class VentaController extends Controller
{
    public function index(){
        return new VentaCollection(Venta::all());
    }

    public function store(StoreVentaRequest $request){
        $venta = Venta::create($request->all());
        $venta ->inventario()->attach(json_decode($request->inventario));
        return response()->json(new VentaResource($venta),Response::HTTP_CREATED);
    }

    public function show(Venta $venta){
        $venta = $venta->load('venta');
        return new VentaResource($venta);
    }

    public function update(UpdateVentaRequest $request, Venta $venta){
        $venta->update($request->all());
        return response()->json(new VentaResource($venta),Response::HTTP_ACCEPTED);
    }

    public function destroy(Venta $venta){
        $venta -> delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}
