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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image');
            $table->double('price',8,3);
            $table->integer('sale')->nullable();
            $table->integer('stock');
            $table->string('type');
            $table->string('type_description');
            $table->string('brand');
            $table->string('age');
            $table->tinyInteger('status')->default(0)->
            comment(
            '0=>false
            1=>true
            ');
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
        Schema::dropIfExists('offers');
    }
};
