<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mazos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nombre");
            $table->string("portada");
            $table->enum("formato", ["Modern", "Commander"]);
            $table->text("descripcion")->nullable();
            $table->enum("estado", ["Publico", "Privado"]);
            $table->integer("visitas")->default("0");
            $table->integer("visitasSemanales")->default("0");
            $table->float("precio");
            $table->foreignId("user_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mazos');
        Schema::enableForeignKeyConstraints();
    }
}
