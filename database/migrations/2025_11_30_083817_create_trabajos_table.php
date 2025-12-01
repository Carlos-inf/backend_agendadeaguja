<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('id_trabajo')->unique(); // ID de negocio (T-001)
            $table->string('nombre_cliente');
            $table->string('telefono_cliente');
            $table->string('nombre_trabajo');
            $table->integer('cantidad_piezas')->default(1);
            $table->date('fecha_recepcion');
            $table->date('fecha_entrega_estimada');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('abono_recibido', 10, 2)->default(0);
            $table->enum('estado_trabajo', ['Por Hacer', 'En Proceso', 'Terminado'])->default('Por Hacer');
            $table->boolean('estado_entrega')->default(false);
            $table->text('detalle_general')->nullable();
            $table->text('imagen_url')->nullable();
            $table->json('medidas')->nullable(); // Campo JSON para datos variables
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
