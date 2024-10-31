<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;


class ClienteController extends Controller
{
    public function index(){
        return new ClienteCollection(Cliente::all());

    }
    public function show(Cliente $cliente){
        return new ClienteResource($cliente);
        
    }
}
