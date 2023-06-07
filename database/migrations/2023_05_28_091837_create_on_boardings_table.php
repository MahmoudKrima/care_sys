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
        Schema::create('on_boardings', function (Blueprint $table) {
            $table->id();
            $table->text('title_ar');
            $table->text('title_en');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('image_ar');
            $table->text('image_en');
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
        Schema::dropIfExists('on_boardings');
    }
};
