<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_color', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("carta_id")->constrained("cartas")->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('carta_color');
    }
}
