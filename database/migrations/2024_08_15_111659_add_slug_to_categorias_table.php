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
       Schema::table('categorias', function (Blueprint $table) {
            $table->text('slug')->nullable()->after('nombre');
        });
        Schema::table('subcategorias', function (Blueprint $table) {
            $table->text('slug')->nullable()->after('nombre');
        });
        Schema::table('negocios', function (Blueprint $table) {
            $table->text('slug')->nullable()->after('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            //
        });
    }
};
