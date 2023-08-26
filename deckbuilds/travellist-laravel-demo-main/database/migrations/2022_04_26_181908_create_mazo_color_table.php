<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMazoColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mazo_color', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("mazo_id")->constrained("mazos")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId("color_id")->constrained("colors")->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mazo_color');
    }
}
