<?php

namespace App\Http\Controllers;

use App\Models\Trabajo; // ⬅️ ¡IMPORTACIÓN NECESARIA!
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // IMPLEMENTACIÓN DEL LISTADO:
        // Obtiene todos los trabajos de la base de datos (incluye Accessors)
        return response()->json(Trabajo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // IMPLEMENTACIÓN DE CREACIÓN CON VALIDACIÓN:
        $validatedData = $request->validate([
            'id_trabajo' => 'required|string|unique:trabajos,id_trabajo',
            'nombre_cliente' => 'required|string',
            'telefono_cliente' => 'required|string',
            'nombre_trabajo' => 'required|string',
            'cantidad_piezas' => 'nullable|integer',
            'fecha_recepcion' => 'required|date',
            'fecha_entrega_estimada' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'abono_recibido' => 'nullable|numeric|min:0',
            'estado_trabajo' => 'nullable|in:Por Hacer,En Proceso,Terminado',
            'estado_entrega' => 'nullable|boolean',
            'detalle_general' => 'nullable|string',
            'imagen_url' => 'nullable|url',
            'medidas' => 'nullable|array',
        ]);

        $trabajo = Trabajo::create($validatedData);

        return response()->json($trabajo, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        // IMPLEMENTACIÓN DE LECTURA (ya estaba correcta):
        // Retorna el objeto Trabajo. Laravel retorna automáticamente 404 si no lo encuentra.
        return response()->json($trabajo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trabajo $trabajo)
{
    $validatedData = $request->validate([
        'id_trabajo' => 'sometimes|required|string|unique:trabajos,id_trabajo,' . $trabajo->id,
        'nombre_cliente' => 'sometimes|required|string',
        'telefono_cliente' => 'sometimes|required|string',
        'nombre_trabajo' => 'sometimes|required|string',
        'cantidad_piezas' => 'nullable|integer',
        'fecha_recepcion' => 'sometimes|required|date',
        'fecha_entrega_estimada' => 'sometimes|required|date',
        'valor_total' => 'sometimes|required|numeric|min:0',
        'abono_recibido' => 'nullable|numeric|min:0',
        'estado_trabajo' => 'nullable|in:Por Hacer,En Proceso,Terminado',
        'estado_entrega' => 'nullable|boolean',
        'detalle_general' => 'nullable|string',
        'imagen_url' => 'nullable|url',
        'medidas' => 'nullable|array',
    ]);

    $trabajo->update($validatedData);

    return response()->json($trabajo);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        // IMPLEMENTACIÓN DE ELIMINACIÓN (ya estaba correcta):
        $trabajo->delete();

        return response()->json(null, 204); // 204 No Content
    }
}