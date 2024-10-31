<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable =[
        'id',
        'cliente_id',

    ];
    use HasFactory;
    public function ventas(){
        return $this->belongsToMany(Venta::class);
        
    }
    public function clientes()
{
    return $this->belongsTo(Cliente::class);
}
public function productos(): mixed{
    return $this->belongsToMany(Producto::class);
    
}
public function inventario(): mixed{
    return $this->HasMany(Producto::class);
    
}

}
