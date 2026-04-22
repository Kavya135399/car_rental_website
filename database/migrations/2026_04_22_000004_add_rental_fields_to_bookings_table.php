<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_code')->nullable()->after('id');
            $table->foreignId('car_id')->nullable()->after('booking_code')->constrained('cars')->nullOnDelete();
            $table->foreignId('car_unit_id')->nullable()->after('car_id')->constrained('car_units')->nullOnDelete();
            $table->foreignId('driver_id')->nullable()->after('car_unit_id')->constrained('drivers')->nullOnDelete();

            $table->dateTime('pickup_at')->nullable()->after('driver_id');
            $table->dateTime('dropoff_at')->nullable()->after('pickup_at');
            $table->string('pickup_location')->nullable()->after('dropoff_at');
            $table->string('dropoff_location')->nullable()->after('pickup_location');

            $table->string('status')->default('Pending')->after('dropoff_location'); // Pending|Confirmed|In Use|Completed|Cancelled

            $table->index(['car_id', 'pickup_at', 'dropoff_at']);
            $table->index(['driver_id', 'pickup_at', 'dropoff_at']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['car_id', 'pickup_at', 'dropoff_at']);
            $table->dropIndex(['driver_id', 'pickup_at', 'dropoff_at']);
            $table->dropIndex(['status']);

            $table->dropConstrainedForeignId('driver_id');
            $table->dropConstrainedForeignId('car_unit_id');
            $table->dropConstrainedForeignId('car_id');
            $table->dropColumn([
                'booking_code',
                'pickup_at',
                'dropoff_at',
                'pickup_location',
                'dropoff_location',
                'status',
            ]);
        });
    }
};

