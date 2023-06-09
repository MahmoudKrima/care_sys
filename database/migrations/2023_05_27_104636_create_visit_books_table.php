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
        Schema::create('visit_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->date('appointments');
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->text('voice_notes')->nullable();
            $table->text('notes')->nullable();
            $table->text('address');
            $table->json('attachments')->nullable();
            $table->tinyInteger('status')->default(0)->
            comment(
            '0=>pending
            1=>InProgress
            2=>Active
            3=>Done
            4=>Refused
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
        Schema::dropIfExists('visit_books');
    }
};
