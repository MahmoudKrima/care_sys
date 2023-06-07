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
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('image_ar');
            $table->text('image_en');
            $table->double('price',8,3);
            $table->integer('sale')->nullable();
            $table->integer('stock');
            $table->string('type_ar');
            $table->string('type_en');
            $table->string('type_description_ar');
            $table->string('type_description_en');
            $table->string('brand_ar');
            $table->string('brand_en');
            $table->string('age_ar');
            $table->string('age_en');
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
