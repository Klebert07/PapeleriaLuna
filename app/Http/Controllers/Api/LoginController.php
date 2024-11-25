<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    /**
    * @OA\Post(
    * path="/api/login",
    * summary="Iniciar sesión",
    * description="Inicia sesión para obtener un token Bearer que permita acceder a los recursos
    protegidos.",
    * tags={"Login"},
    * @OA\RequestBody(
    * required=true,
    * @OA\MediaType(
    * mediaType="multipart/form-data",
    * @OA\Schema(
    * required={"correo", "contraseña", "dispositivo"},
    * @OA\Property(property="correo", type="string", format="email",
    example="klebert@admin.com"),
    * @OA\Property(property="contraseña", type="string", format="password",
    example="password"),
    * @OA\Property(property="dispositivo", type="string", example="android")
    * )
    * )
    * ),
    * @OA\Response(
    * response=200,
    * description="Token generado con éxito",
    * @OA\JsonContent(
    * @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5...")
    * )
    * ),
    * @OA\Response(
    * response=401,
    * description="Credenciales inválidas"
    * )
    * )
    */
    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
            'dispositivo' => 'required',
        ]);

        $user = User::where('email', $request->correo)->first();

        if (!$user || !Hash::check($request->contraseña, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales no coinciden con nuestros registros'
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        return response()->json([
            'data' => [
                'atributos' => [
                    'id' => $user->id,
                    'nombre' => $user->name,
                    'correo' => $user->email,
                ],
                'token' => $user->createToken($request->dispositivo)->plainTextToken,
            ],
        ], Response::HTTP_OK); // 200
    }

    // Agreguemos también el método de logout
    /*  public function logout(Request $request)
      {
          $request->user()->currentAccessToken()->delete();
          
          return response()->json([
              'message' => 'Sesión cerrada exitosamente'
          ], Response::HTTP_OK);
      }*/
}