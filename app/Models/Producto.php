<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable =[
        'id',
        'nombre',
        'descripcion',
        'categoria',
        'precio',

    ];
    use HasFactory;
    public function inventario(){
        return $this->belongsToMany(Inventario::class);
        
    }
}
