<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $addedReceipt = false;

            if (!Schema::hasColumn('bookings', 'amount_paid')) {
                $table->decimal('amount_paid', 10, 2)->default(0)->after('total_amount');
            }

            if (!Schema::hasColumn('bookings', 'online_payment_terms_accepted_at')) {
                $table->dateTime('online_payment_terms_accepted_at')->nullable()->after('payment_status');
            }

            if (!Schema::hasColumn('bookings', 'receipt_number')) {
                $table->string('receipt_number', 40)->nullable()->after('online_payment_terms_accepted_at');
                $addedReceipt = true;
            }

            if (!Schema::hasColumn('bookings', 'receipt_generated_at')) {
                $table->dateTime('receipt_generated_at')->nullable()->after('receipt_number');
            }

            if ($addedReceipt) {
                $table->unique(['receipt_number']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            try {
                $table->dropUnique(['receipt_number']);
            } catch (\Throwable $e) {
                // ignore
            }

            $drops = [];
            foreach (['amount_paid', 'online_payment_terms_accepted_at', 'receipt_number', 'receipt_generated_at'] as $col) {
                if (Schema::hasColumn('bookings', $col)) {
                    $drops[] = $col;
                }
            }
            if (!empty($drops)) {
                $table->dropColumn($drops);
            }
        });
    }
};

