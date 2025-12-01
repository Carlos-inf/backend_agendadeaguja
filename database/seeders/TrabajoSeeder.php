<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trabajo; // Asegúrate de importar el Modelo
use Illuminate\Support\Facades\File;

class TrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ruta del archivo JSON
        $json = File::get(database_path('data/datos_iniciales.json')); 
        $trabajos = json_decode($json, true); // Decodifica el JSON a un array de PHP

        // 2. Itera sobre cada trabajo en el array
        foreach ($trabajos as $trabajoData) {
            // Preparar los datos para la creación.
            // Es importante que las claves coincidan con los campos de la Migración.
            
            // Mapeo y preparación del campo 'medidas' (que debe ser JSON en la BD)
            // Aunque Laravel lo casteará a JSON, se puede asegurar el formato si es necesario, 
            // pero el cast en el modelo ('medidas' => 'array') es suficiente.
            
            $dataToCreate = [
                'id_trabajo' => $trabajoData['id_trabajo'],
                'nombre_cliente' => $trabajoData['nombre_cliente'],
                'telefono_cliente' => $trabajoData['telefono_cliente'],
                'nombre_trabajo' => $trabajoData['nombre_trabajo'],
                'cantidad_piezas' => $trabajoData['cantidad_piezas'] ?? 1,
                'fecha_recepcion' => $trabajoData['fecha_recepcion'],
                'fecha_entrega_estimada' => $trabajoData['fecha_entrega_estimada'],
                'valor_total' => $trabajoData['valor_total'],
                'abono_recibido' => $trabajoData['abono_recibido'] ?? 0,
                'estado_trabajo' => $trabajoData['estado_trabajo'] ?? 'Por Hacer',
                'estado_entrega' => $trabajoData['estado_entrega'] ?? false,
                'detalle_general' => $trabajoData['detalle_general'] ?? null,
                'imagen_url' => $trabajoData['url_boceto'] ?? null, // Mapea 'url_boceto' a 'imagen_url'
                'medidas' => $trabajoData['medidas'], // Se guarda como JSON gracias al cast en el Modelo
            ];

            // 3. Crea el registro en la base de datos
            Trabajo::create($dataToCreate);
        }
    }
}