<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Tiempo;

class ActividadesController extends Controller
{
    /**
     * Función encargada de consultar las actividades de cada usuario
     * 
     * @param $idUser -> usuario en sesión
     * 
     * @return JSON
     */
    public function getActividades($idUser)
    {
        try {

            if ($idUser) {

                $response = array();
                $actividades = Actividad::where('usuario_id', $idUser)->with('tiempos')->get();

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

    /**
     * Función encargada de añadir una actividad para un usuario con sus respectivos tiempos
     * 
     * @param $idUser -> usuario en sesión
     * @param Request $request -> información de la petición
     * 
     * @return JSON
     */
    public function agregarActividad($idUser, Request $request)
    {
        try {
            if (isset($request->actividad) && isset($request->tiempos)) {
    
                /** Se realiza una transacción ya que se va hacer insert en diferentes tablas */
                DB::beginTransaction();

                /** Instancia modelo de actividad */
                $actividad = new Actividad();

                /** Se convierte el string del JSON en un objeto */
                $request->tiempos = json_decode($request->tiempos);
    
                /** Se guarda la actividad */
                $actividad->descripcion = $request->all()['actividad'];
                $actividad->usuario_id = $idUser;
                $actividad->save();
    
                /** Se obtiene el id de la actividad registrada */
                $lastId = $actividad->id;
    
                /** Se iteran los tiempos añadidos para la tarea */
                foreach ($request->tiempos as $time) {
                    /** Instancia modelo de tiempo */
                    $tiempo = new Tiempo();
                    /** Se guarda cada tiempo */
                    $tiempo->fecha = $time->fecha;
                    $tiempo->tiempo = $time->tiempo;
                    $tiempo->actividad_id = $lastId;
                    $tiempo->save();
                }

                DB::commit();
                return response()->json(['status' => true, 'response' => 'Actividad registrada correctamente.']);
            }
        } catch (\Throwable $th) {
            /** Si alguna de las dos inserciones falla, se reversa el proceso en base de datos */
            DB::rollBack();
            return response()->json(['status' => false, 'response' => $th->getMessage()]);
        }
    }
}
