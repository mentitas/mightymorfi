<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('horarios')->nullable(); // Horarios del restaurante
            $table->string('telefono')->nullable(); // Teléfono de contacto
            $table->string('logo')->nullable(); // URL del logo
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['horarios', 'telefono', 'logo']);
        });
    }
};
