<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable =[
        'producto_id',
        'cantidad',

    ];
    use HasFactory;
    public function productos(){
        return $this->belongsToMany(Producto::class);
        
    }
}
