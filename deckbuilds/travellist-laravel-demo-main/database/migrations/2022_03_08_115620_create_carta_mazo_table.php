<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaMazoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_mazo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("carta_id")->constrained("cartas")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("mazo_id")->constrained("mazos")->cascadeOnUpdate()->nullOnDelete();
            $table->integer("unidad")->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta_mazo');
    }
}
