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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('code')->unique();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('estimated_time');
            $table->double('total',8,3);
            $table->dateTime('order_placed');
            $table->dateTime('pending')->nullable();
            $table->dateTime('confirmed')->nullable();
            $table->dateTime('processing')->nullable();
            $table->dateTime('delivered')->nullable();
            $table->tinyInteger('status')->default(0)->
            comment(
            '0=>orderPlaced
            1=>pending
            2=>confirmed
            3=>processing
            4=>delivered
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
        Schema::dropIfExists('orders');
    }
};
