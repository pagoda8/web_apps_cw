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
            $table->unsignedBigInteger('creatorID');
            $table->boolean('active');
            $table->dateTime('end');

            $table->binary('photo');
            $table->string('manufacturer');
            $table->string('model');
            $table->year('year');
            $table->integer('mileage');
            $table->set('fuel', ['Petrol', 'Diesel', 'LPG']);
            $table->double('engineSize', 1, 1);
            $table->integer('horsePower');
            $table->set('transmission', ['Manual', 'Automatic']);
            $table->string('description');

            $table->integer('minBid');
            $table->integer('currentBid');
            $table->unsignedBigInteger('winningBidderID')->nullable();
            $table->integer('buyPrice')->nullable();
            
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
