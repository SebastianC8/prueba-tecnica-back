<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $response = array();

        try {

            $user = Usuario::where([
                ['usuario', $request->username],
                ['contraseña', $request->password]
            ])->select(['id', 'usuario'])->first();

            if (!empty($user)) {
                $response = array('status' => true, 'response' => $user);
            } else {
                $response = array('status' => false, 'response' => 'Este usuario no registra en la base de datos.');
            }

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'response' => $th->getMessage()]);
        }
    }
}
