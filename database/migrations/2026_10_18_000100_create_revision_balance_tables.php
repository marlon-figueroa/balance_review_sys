<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodos_revision', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('mes');
            $table->string('estado', 32)->default('borrador');
            $table->foreignId('usuario_creador_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('certificado_por_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('total_activo', 18, 2)->default(0);
            $table->decimal('total_pasivo', 18, 2)->default(0);
            $table->decimal('total_patrimonio', 18, 2)->default(0);
            $table->boolean('integridad_ok')->default(false);
            $table->json('kpis')->nullable();
            $table->text('comentario_rechazo')->nullable();
            $table->timestamp('certificado_at')->nullable();
            $table->timestamps();

            $table->unique(['anio', 'mes']);
        });

        Schema::create('lineas_balanza', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_revision_id')->constrained('periodos_revision')->cascadeOnDelete();
            $table->string('codigo_cuenta', 32);
            $table->string('nombre');
            $table->string('naturaleza', 16);
            $table->decimal('debe', 18, 2)->default(0);
            $table->decimal('haber', 18, 2)->default(0);
            $table->decimal('saldo', 18, 2)->default(0);
            $table->timestamps();

            $table->unique(['periodo_revision_id', 'codigo_cuenta']);
        });

        Schema::create('conciliaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_revision_id')->constrained('periodos_revision')->cascadeOnDelete();
            $table->string('tipo', 32);
            $table->string('referencia');
            $table->decimal('saldo_contable', 18, 2)->default(0);
            $table->decimal('saldo_externo', 18, 2)->default(0);
            $table->decimal('diferencia', 18, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('hallazgos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_revision_id')->constrained('periodos_revision')->cascadeOnDelete();
            $table->string('tipo', 32);
            $table->string('severidad', 16);
            $table->string('codigo_cuenta', 32)->nullable();
            $table->string('titulo');
            $table->text('descripcion');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('ajustes_contables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_revision_id')->constrained('periodos_revision')->cascadeOnDelete();
            $table->foreignId('hallazgo_id')->nullable()->constrained('hallazgos')->nullOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->string('codigo_cuenta', 32);
            $table->decimal('monto', 18, 2);
            $table->string('descripcion');
            $table->string('estado', 16)->default('propuesto');
            $table->timestamps();
        });

        Schema::create('revision_historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_revision_id')->constrained('periodos_revision')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->string('accion', 32);
            $table->string('estado_anterior', 32)->nullable();
            $table->string('estado_nuevo', 32);
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revision_historial');
        Schema::dropIfExists('ajustes_contables');
        Schema::dropIfExists('hallazgos');
        Schema::dropIfExists('conciliaciones');
        Schema::dropIfExists('lineas_balanza');
        Schema::dropIfExists('periodos_revision');
    }
};
