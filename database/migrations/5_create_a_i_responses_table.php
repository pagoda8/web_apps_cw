<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('a_i_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('licitation_id');
            $table->text('response');
            $table->timestamps();

            $table->foreign('licitation_id')->references('id')->on('licitations')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_responses');
    }
};
