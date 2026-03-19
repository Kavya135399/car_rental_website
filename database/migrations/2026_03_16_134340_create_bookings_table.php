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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // Car Details
        $table->string('car');
        $table->decimal('price_per_day', 10, 2)->nullable();
        $table->integer('passengers');

        // Customer Info
        $table->string('name');
        $table->string('phone');
        $table->string('email')->nullable();

        // Trip Details
        $table->string('pickup')->nullable();
        $table->string('drop')->nullable();
        $table->date('date');
        $table->time('pickup_time');
        $table->date('return_date')->nullable();

        // Calculation
        $table->integer('total_days')->nullable();
        $table->decimal('total_amount', 10, 2)->nullable();

        // Payment
        $table->string('payment_method')->nullable();
        $table->string('payment_proof')->nullable();

        // Extra
        $table->text('message')->nullable();

        $table->timestamps();
    });
}
};