<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Tiempo;

class ActividadesController extends Controller
{
    public function getActividades($idUser)
    {
        try {

            if ($idUser) {

                $response = array();
                $actividades = Actividad::where('usuario_id', $idUser)->get();

                if (!empty($actividades)) {
                    $response = array('status' => true, 'response' => $actividades);
                } else {
                    $response = array('status' => false, 'response' => 'El usuario no tiene actividades');
                }

                return response()->json($response);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'response' => $th->getMessage()]);
        }
    }

    public function agregarActividad($idUser, Request $request)
    {
        if (isset($request->actividad) && !empty($request->actividad)) {

            $actividad = new Actividad();
            $request->tiempos = json_decode($request->tiempos);

            $actividad->descripcion = $request->all()['actividad'];
            $actividad->usuario_id = $idUser;
            $actividad->save();

            $lastId = $actividad->id;

            if (isset($request->tiempos) && !empty($request->tiempos)) {
                foreach ($request->tiempos as $time) {
                    $tiempo = new Tiempo();
                    $tiempo->fecha = $time->fecha;
                    $tiempo->tiempo = $time->tiempo;
                    $tiempo->actividad_id = $lastId;
                    $tiempo->save();
                }
            }
        }
    }
}
