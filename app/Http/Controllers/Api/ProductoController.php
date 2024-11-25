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
    /**
     * @OA\Get(
     * path="/api/productos",
     * summary="Consultar todos los productos",
     * description="Retorna todos los Productos ",
     * tags={"Producto"},
     * security={{"bearer_token":{}}},
     * @OA\Response(
     * response=200,
     * description="Operación exitosa",
     * ),
     * @OA\Response(
     * response=403,
     * description="No autorizado"
     * ),
     * @OA\Response(
     * response=404,
     * description="No se encontraron productos "
     * ),
     * @OA\Response(
     * response=405,
     * description="Método no permitido"
     * )
     * )
     */
    public function index()
    {
        $this->authorize('Ver productos');
        return new ProductoCollection(Producto::all());
    }



    /**
     * @OA\Post(
     * path="/api/productos",
     * summary="Crear Producto ",
     * description="Crear un nuevo Producto ",
     * tags={"Producto"},
     * security={{"bearer_token":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"nombre", "descripcion", "categoria", "precio"},
     * @OA\Property(property="nombre", type="string", example="Libreta del América"),
     * @OA\Property(property="descripcion", type="string", example="Libreta de las águilas del América"),
     * @OA\Property(property="categoria", type="string", example="Cuadernos"),
     * @OA\Property(property="precio", type="integer", example="1000"),
     * )
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Produto creado",
     * ),
     * @OA\Response(
     * response=403,
     * description="No autorizado"
     * )
     * )
     */
    public function store(StoreProductoRequest $request)
    {
        $this->authorize('Crear productos');
        $producto = Producto::create($request->all());
        if ($request->has('productos')) {
            $producto->inventario()->attach(json_decode($request->productos));
        }
        return response()->json(new ProductoResource($producto), Response::HTTP_CREATED);
    }


    /**
     * @OA\Get(
     * path="/api/productos/{producto}",
     * summary="Obtener un producto por su ID",
     * description="Retorna un producto, con su Nombre, descripcion del producto, categoria a la que pertenece y precio ",
     * tags={"Producto"},
     * security={ {"bearer_token": {} }},
     * @OA\Parameter(
     * name="producto",
     * description="ID del producto ",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Producto",
     * ),
     * @OA\Response(
     * response=403,
     * description="No autorizado",
     * )
     * )
     */
    public function show(Producto $producto)
    {
        $this->authorize('Ver productos');
        $producto = $producto->load('inventario');
        return new ProductoResource($producto);
    }



    /**
 * @OA\Put(
 *     path="/api/productos/{producto}",
 *     summary="Actualizar producto",
 *     description="Actualizar un producto por su ID",
 *     tags={"Producto"},
 *     security={{"bearer_token": {}}},
 *     @OA\Parameter(
 *         name="producto",
 *         description="ID del producto",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"nombre", "descripcion", "categoria", "precio"},
 *                 @OA\Property(property="nombre", type="string", example="Libreta Águilas del América"),
 *                 @OA\Property(property="descripcion", type="string", example="libreta del bicampeón"),
 *                 @OA\Property(property="categoria", type="string", example="cuadernos"),
 *                 @OA\Property(property="precio", type="integer", example=100)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="Producto actualizado"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="No autorizado"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Producto no encontrado"
 *     )
 * )
 */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('Editar productos');
        $producto->update($request->all());
        return response()->json(new ProductoResource($producto), Response::HTTP_ACCEPTED);
    }


    /**
     * @OA\Delete(
     * path="/api/productos/{producto}",
     * summary="Eliminar Producto",
     * description="Elimina un producto por su ID.",
     * tags={"Producto"},
     * security={{"bearer_token": {}}},
     * @OA\Parameter(
     * name="producto",
     * description="ID del producto ",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(
     * response=204,
     * description="Producto eliminado con éxito",
     * ),
     * @OA\Response(
     * response=403,
     * description="No autorizado",
     * ),
     * @OA\Response(
     * response=404,
     * description="Producto no encontrado"
     * )
     * )
     */
    public function destroy(Producto $producto)
    {
        $this->authorize('Eliminar productos');
        $producto->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}