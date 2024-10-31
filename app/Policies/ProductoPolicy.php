<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Producto;

class ProductoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Producto $producto)
    {
        return $user->id===$producto->user_id;
    }

    public function delete(User $user, Producto $producto)
    {
        return $user->id===$producto->user_id;
        
    }

}
