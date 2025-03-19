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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id')->index();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignedBigInteger('subcategoria_id')->nullable();
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');

            $table->string('contacto_nombre')->nullable();;
            $table->string('contacto_telefono')->nullable();
            $table->string('contacto_email')->nullable();

            $table->string('nombre')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('horario')->nullable();
            $table->string('horario_fin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('location')->nullable();
            $table->string('location_lat')->nullable();
            $table->string('location_lng')->nullable();
            $table->text('foto1')->nullable();
            $table->text('foto2')->nullable();
            $table->text('foto3')->nullable();
            $table->text('foto4')->nullable();
            $table->text('foto5')->nullable();
            $table->boolean('aprobado')->default(false);
            $table->boolean('activo')->default(true);
            $table->integer('visitas')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
