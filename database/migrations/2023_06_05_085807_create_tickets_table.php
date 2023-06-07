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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ticket_category')->constrained('ticket_categories')->cascadeOnDelete();
            $table->text('problem');
            $table->text('answer_ar')->nullable();
            $table->text('answer_en')->nullable();
            $table->json('attachments')->nullable();
            $table->tinyInteger('status')->default(0)->
            comment(
            '0=>pending
            1=>inprogress
            2=>ended
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
        Schema::dropIfExists('tickets');
    }
};
