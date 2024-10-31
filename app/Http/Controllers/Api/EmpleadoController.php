<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EmpleadoResource;


class EmpleadoController extends Controller
{
    public function index(){
        return new EmpleadoCollection(Empleado::all());

    }
    public function show(Empleado $empleado){
        return new EmpleadoResource($empleado);
        
    }
}
