<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRestaurantStructure extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('restaurant');
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable();

            // Añadir la clave foránea
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna `owner_id`
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });

        Schema::table('users', function (Blueprint $table) {
            // Volver a agregar la columna `restaurant`
            $table->string('restaurant')->default('No Data');
        });
    }
}
