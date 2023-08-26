<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FavoritosMazoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos_mazos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("mazo_id")->constrained("mazos")->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('favoritos_mazos_usuarios');
        Schema::enableForeignKeyConstraints();
    }
}
