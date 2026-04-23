<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $addedUtr = false;
            $addedStatus = false;
            if (!Schema::hasColumn('bookings', 'payment_utr')) {
                $table->string('payment_utr', 64)->nullable()->after('payment_method');
                $addedUtr = true;
            }
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                // Unpaid | UTR Submitted | Paid | Rejected | Cash
                $table->string('payment_status', 32)->default('Unpaid')->after('payment_utr');
                $addedStatus = true;
            }
            if (!Schema::hasColumn('bookings', 'payment_verified_at')) {
                $table->dateTime('payment_verified_at')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('bookings', 'payment_verified_by')) {
                $table->foreignId('payment_verified_by')
                    ->nullable()
                    ->after('payment_verified_at')
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if ($addedStatus) {
                $table->index(['payment_status']);
            }
            if ($addedUtr) {
                $table->index(['payment_utr']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'payment_verified_by')) {
                $table->dropConstrainedForeignId('payment_verified_by');
            }

            $drops = [];
            foreach (['payment_utr', 'payment_status', 'payment_verified_at'] as $col) {
                if (Schema::hasColumn('bookings', $col)) {
                    $drops[] = $col;
                }
            }
            if (!empty($drops)) {
                $table->dropColumn($drops);
            }

            // Index drops are handled automatically by MySQL for dropped columns, but keep safe.
            try {
                $table->dropIndex(['payment_status']);
            } catch (\Throwable $e) {
                // ignore
            }
            try {
                $table->dropIndex(['payment_utr']);
            } catch (\Throwable $e) {
                // ignore
            }
        });
    }
};
