<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    /**
     * Función encargada de realizar login
     * 
     * @param Request $request -> información de la petición
     * 
     * @return JSON
     */
    public function login(Request $request)
    {
        $response = array();

        try {

            /** Se consulta un usuario en la BD con las credenciales ingresadas */
            $user = Usuario::where([
                ['usuario', $request->username],
                ['contraseña', $request->password]
            ])->select(['id', 'usuario'])->first();

            if (!empty($user)) {
                /** Existe usuario */
                $response = array('status' => true, 'response' => $user);
            } else {
                /** No existe usuario */
                $response = array('status' => false, 'response' => 'Este usuario no registra en la base de datos.');
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'response' => $th->getMessage()]);
        }
    }
}
