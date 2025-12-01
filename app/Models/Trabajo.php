<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Importa Attribute

class Trabajo extends Model
{
    use HasFactory;

    // 1. Asignación Masiva: Permite guardar todos los campos
    protected $fillable = [
        'id_trabajo',
        'nombre_cliente',
        'telefono_cliente',
        'nombre_trabajo',
        'cantidad_piezas',
        'fecha_recepcion',
        'fecha_entrega_estimada',
        'valor_total',
        'abono_recibido',
        'estado_trabajo',
        'estado_entrega',
        'detalle_general',
        'imagen_url',
        'medidas',
    ];

    // 2. Casteo: Indica que 'medidas' es un JSON y fechas son tipo date
    protected $casts = [
        'medidas' => 'array',
        'fecha_recepcion' => 'date',
        'fecha_entrega_estimada' => 'date',
        'estado_entrega' => 'boolean',
    ];

    // 3. ACCESSOR 1: Calcula el valor pendiente
    protected function valorPendiente(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->valor_total - $this->abono_recibido,
        );
    }

    // 4. ACCESSOR 2: Determina el estado de pago
    protected function estadoPago(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->valor_total - $this->abono_recibido) <= 0
                ? 'Pagado'
                : 'Pendiente',
        );
    }
}