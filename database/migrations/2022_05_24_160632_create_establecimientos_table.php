<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categorias', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });


        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('categoria_id')->constrained();
            $table->string('image_principal');
            $table->string('location');
            $table->string('colonia');
            $table->string('lat');
            $table->string('lng');
            $table->string('phone');
            $table->string('description');
            $table->time('open');
            $table->time('close');
            $table->uuid();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('establecimientos');
    }
};
