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
        Schema::create('licitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('end');

            $table->string('photo_path');
            $table->string('manufacturer');
            $table->string('model');
            $table->year('year');
            $table->integer('mileage');
            $table->set('fuel', ['Petrol', 'Diesel']);
            $table->float('engine_size', 2, 1);
            $table->integer('horse_power');
            $table->set('transmission', ['Manual', 'Automatic']);
            $table->string('description');

            $table->integer('min_bid');
            $table->integer('buy_price')->nullable();
            
            $table->integer('views');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitations');
    }
};
